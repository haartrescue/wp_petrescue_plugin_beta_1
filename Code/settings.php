<?php
if(!class_exists('WP_PetRescue_Plugin_Settings'))
{
  class WP_PetRescue_Plugin_Settings
  {

    public function __construct()
    {
      add_action('admin_init', array(&$this, 'admin_init'));
      add_action('admin_menu', array(&$this, 'add_menu'));
    }

        public function admin_init()
        {

          // add your settings section
          add_settings_section(
            'wp_plugin_template-section',
            'WP PetRescue Plugin Settings',
            array(&$this, 'settings_section_wp_petrescue_plugin'),
            'wp_petrescue_plugin'
          );

          // add your setting's fields
          add_settings_field(
            'wp_wp_petrescue_plugin-api_key',
            'PetRescue API Key',
            array(&$this, 'settings_field_input_text_api_key'),
            'wp_petrescue_plugin',
            'wp_plugin_template-section'
          );
          add_settings_field(
            'wp_wp_petrescue_plugin-group_id',
            'PetRescue Group ID',
            array(&$this, 'settings_field_input_text_group_id'),
            'wp_petrescue_plugin',
            'wp_plugin_template-section'
          );
          add_settings_field(
            'wp_petrescue_plugin-page_id',
            'PetRescue Pet Info Page',
            array(&$this, 'settings_field_page_selector'),
            'wp_petrescue_plugin',
            'wp_plugin_template-section'
          );

          // register your plugin's settings
          register_setting('wp_petrescue_plugin','wp_petrescue_plugin-api_key');
          register_setting('wp_petrescue_plugin','wp_petrescue_plugin-group_id');
          register_setting('wp_petrescue_plugin','wp_petrescue_plugin-page_id');
        }

        public function settings_section_wp_petrescue_plugin()
        {
          echo 'These are the only paramaters needed to get the PetRescue API Functionality to work';
        }

        public function settings_field_page_selector()
        {
          $value = get_option('wp_petrescue_plugin-page_id');
          $pages = get_pages();
          ob_start('settings_field_ob');
          ?>
          <select name="wp_petrescue_plugin-page_id" id="wp_petrescue_plugin-page_id">
          <?php
          foreach($pages as $page)
          {
            $selected="";
            if($page->ID == $value)
              $selected=" SELECTED"
            ?>
            <option value="<?php echo $page->ID; ?>"<?php echo $selected;?>><?php echo $page->post_title; ?></option>
            <?php
          }
          ?>
          </select>
          <?
          return ob_get_clean();
        }

        public function settings_field_input_text_group_id()
        {
          $this->settings_field_input_text(array('field' => 'group_id'));
        }

        public function settings_field_input_text_api_key() {
          $this->settings_field_input_text(array('field' => 'api_key'));
        }

        public function settings_field_input_text($args)
        {
          // Get the field name from the $args array
          $field = $args['field'];

          // Get the value of this setting
          $value = get_option('wp_petrescue_plugin-'.$field);

          // echo a proper input type="text"
          echo sprintf('<input type="text" name="wp_petrescue_plugin-%s" id="wp_petrescue_plugin-%s" value="%s" />', $field, $field, $value);
        }

        public function add_menu()
        {
          // Add a page to manage this plugin's settings
          add_options_page(
            'WP PetRescue Plugin Settings',
            'WP PetRescue Plugin',
            'manage_options',
            'wp_petrescue_plugin',
            array(&$this, 'plugin_settings_page')
          );
        }

        public function plugin_settings_page()
        {
          if(!current_user_can('manage_options'))
          {
            wp_die(__('You do not have sufficient permissions to access this page.'));
          }

          // Render the settings template
          include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        }
    }
}
