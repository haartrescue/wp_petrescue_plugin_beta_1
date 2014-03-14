<?php
/*
Plugin Name: PetRescue.com.au Wordpress Plugin
Plugin URI: http://www.haart.org.au/plugins/petrescue
Description: Creates the "Find a Pet" functionality that uses PetRescue (AU) as a base for all animals.
Version: 1.0
Author: Dave Forster & Greg Tangey
Author URI: http://www.haart.org.au
License: GPL2
*/
/*
Copyright 2014  Dave Forster  (email : dave@haart.org.au)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('WP_PetRescue_Plugin'))
{
  class WP_PetRescue_Plugin
  {
    const PETRESCUE_BASE_URL = "http://www.petrescue.com.au/";
    const PETRESCUE_API_URL = "http://www.petrescue.com.au/api/listings/";

    public $api_key = "";
    public $group_id = "";
    public $page_id = "";
    public $page_relative = "";

    public $request_page_id = "";
    public $request_page_name = "";

    public function __construct()
    {
      // Initialize Settings
      require_once(sprintf("%s/settings.php", dirname(__FILE__)));
      $WP_PetRescue_Plugin_Settings = new WP_PetRescue_Plugin_Settings();

      $plugin = plugin_basename(__FILE__);
      add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
      add_filter('plugin_row_meta', array( $this, 'donate_meta' ));

      add_shortcode('petrescue_find_a_pet', array(&$this,'find_a_pet_shortcode') );
      add_shortcode('petrescue_pet_info', array(&$this,'pet_info_shortcode') );

      $this->api_key = get_option('wp_petrescue_plugin-api_key');
      $this->group_id = get_option('wp_petrescue_plugin-group_id');
      $this->page_id = get_option('wp_petrescue_plugin-page_id');

      if(get_option('permalink_structure')) {
        add_filter('rewrite_rules_array', array(&$this,'insert_rules'));
        add_filter('request', array(&$this, 'request'));
      }

      add_filter('query_vars', array(&$this,'add_query_vars'));
    }

    public static function activate() {}

    public static function deactivate() {}

    public function request($query_vars) {
      return $query_vars;
    }

    function get_display_template($file)
    {
      if (file_exists(TEMPLATEPATH . '/'.$file)) {
          return TEMPLATEPATH . '/'.$file;
      } else {
          return dirname(__FILE__).'/public_templates/'.$file;
      }
    }

    function add_query_vars( $vars ){
      $vars[] = "petid";
      return $vars;
    }

    function insert_rules($rules) {

        $newrules = array();
        $page = get_post($this->page_id);
        $slug = $page->post_name;

        $newrules[$slug.'/([^/]+)/?$'] = 'index.php?pagename='.$slug.'&petid=$matches[1]';
        return $newrules + $rules;
    }

    // Add the settings link to the plugins page
    function plugin_settings_link($links)
    {
      $settings_link = '<a href="options-general.php?page=WP_PetRescue_Plugin">PetRescue Settings</a>';
      array_unshift($links, $settings_link);
      return $links;
    }
    // Add the donate links to the plugins page
    function donate_meta($links)
    {
      $haart_donate = '<a href="https://www.haart.org.au/donate" target=_blank>Donate to HAART</a>';
	  $petrescue_donate = '<a href="https://secure4.everydayhero.com.au/event/petrescuedonation/donate" target=_blank>Donate to PetRescue</a>';
      array_push($links, $haart_donate, $petrescue_donate);
      return $links;
    }

    function pet_info_shortcode($atts, $content=null) {
      extract (
        shortcode_atts (
          array (
            'petid' => 0,
          ), $atts
        )
      );

      if($petid == 0)
        $petid = (get_query_var('petid')) ? get_query_var('petid') : 0;
      return $this->pet_info($petid);
    }

    function find_a_pet_shortcode($atts, $content=null) {
      extract (
        shortcode_atts (
          array (
            'category' => '',
          ), $atts
        )
      );

      return $this->find_a_pet($category);
    }

    function pet_info($petid) {
      $url=WP_PetRescue_Plugin::PETRESCUE_API_URL.$petid."?token=".$this->api_key;
      // // set URL and other appropriate options
      $headers = array(
        'Accept: application/json',
        'Authorization: Token token="'.$this->api_key.'"',
      );

      // grab URL and pass it to the browser
      $results = wp_remote_get( $url, array( 'timeout' => 10, 'headers' => $headers) );

      if($results['response']['code'] == 200) {
        $json = json_decode($results['body'], true);
        $desexed= ($json['desexed']) ? 'Yes' : 'No';
        $photo_featured=$json['photos'][0]['large_340'];
        $petrescue_url = PETRESCUE_BASE_URL."listings/".$json['id'];

        ob_start();
        include $this->get_display_template("pet_info.php");
        return ob_get_clean();
      }
      else {
        return "Err";
      }
    }

    function find_a_pet($category) {
      $url=WP_PetRescue_Plugin::PETRESCUE_API_URL."?token=".$this->api_key."&group_id=".$this->group_id."&species=".$category;

      $headers = array(
        'Accept: application/json',
        'Authorization: Token token="'.$this->api_key.'"',
      );

      $results = wp_remote_get($url, array('timeout' => 30, 'headers' => $headers) );
      if($results['response']['code'] == 200) {

        // grab URL and pass it to the browser
        $json = json_decode($results['body'], true);
        // close cURL resource, and free up system resources
        ob_start();
        ?><ul class="pet_listing"><?php
        foreach($json['listings'] as $listing)
        {
          $short_personality=substr($listing['personality'],0,200);

          $petinfo_permalink = get_permalink($this->page_id);

          if ( get_option('permalink_structure') )
            $peturl=$petinfo_permalink.$listing['id'];
          else
            $peturl=add_query_arg("petid",$listing['id'],$petinfo_permalink);

          $medium_photo=$listing['photos'][0]['medium_130'];

          include $this->get_display_template("find_a_pet.php");
        }
        ?>
        </ul>
        <?php
        return ob_get_clean();
      }
      else {
        echo "err";
      }
    }

  }
}

if(class_exists('WP_PetRescue_Plugin'))
{
  // Installation and uninstallation hooks
  register_activation_hook(__FILE__, array('WP_PetRescue_Plugin', 'activate'));
  register_deactivation_hook(__FILE__, array('WP_PetRescue_Plugin', 'deactivate'));

  // instantiate so we can use get_permalink
  $wp_rewrite = new WP_Rewrite();
  $wp_petrescue_plugin = new WP_PetRescue_Plugin();
}

add_action( 'wp_enqueue_scripts', 'wp_petrescue_stylesheet' );

function wp_petrescue_stylesheet() {
  wp_register_style( 'wp-petrescue-style', plugins_url('css/wp_petrescue_style.css',basename(dirname(__FILE__))."/nothing") );
  wp_enqueue_style( 'wp-petrescue-style' );
}