<div class="wrap">
    <h2>WP PetRescue Plugin</h2>

    <form method="post" action="options.php">
        <?php settings_fields( 'wp_petrescue_plugin' ); ?>
        <?php do_settings_sections('wp_petrescue_plugin'); ?>

        <?php submit_button(); ?>
    </form>
</div>