<?php
// enqueue scripts frontend
add_action('wp_enqueue_scripts', function () {
    wp_deregister_script('jquery');
    wp_enqueue_style('ajaxpress', AjaxPress . '/assets/css/ajaxpress.min.css', false, null);
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', false, false, false);

    wp_enqueue_script('ajaxpress', AjaxPress . '/assets/js/ajaxpress.js', false, true);
});


// enqueue scripts admin panel
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('ajaxpress', AjaxPress . '/assets/css/admin.min.css', false, null);
    wp_enqueue_script('ajaxpress', AjaxPress . '/assets/js/admin.js', false, true);
});


// setting default options into database
add_action('admin_init', function () {
    add_option('ap_container_selector', '#main');
    add_option('ap_theme', 'default');
    add_option('ap_loading_message', 'Loading...');
    add_option('ap_enable', 'on');
    register_setting('ajaxpress_options_group', 'ap_container_selector', false);
    register_setting('ajaxpress_options_group', 'ap_theme', false);
    register_setting('ajaxpress_options_group', 'ap_loading_message', false);
    register_setting('ajaxpress_options_group', 'ap_enable', false);
});


// plugin admin panel 
add_action('admin_menu', function () {
    // adding new admin option page under #Settings#
    add_options_page('AjaxPress', 'AjaxPress', 'manage_options', 'ajaxpress', function () {
?>
        <div class="ap_settings_form">
            <?php screen_icon(); ?>
            <h2>AjaxPress Settings</h2>
            <form method="post" action="options.php">
                <?php settings_fields('ajaxpress_options_group'); ?>

                <div class="form-group">
                    <label for="ap_enable">Enable AjaxPress</label>
                    <input type="checkbox" id="ap_enable" name="ap_enable" <?php echo get_option('ap_enable') == 'on' ? 'checked' : ''; ?> />
                </div>

                <div class="form-group">
                    <label for="ap_container_selector">HTML Selector</label>
                    <input placeholder="Wrapper Selector" type="text" id="ap_container_selector" name="ap_container_selector" value="<?php echo get_option('ap_container_selector'); ?>" />
                </div>


                <?php
                // available themes
                $themes = [
                    'none' => 'None',
                    'default' => 'Default',
                    'dark-ocean' => 'Dark Ocen',
                    'ultra-violate' => 'Ultra Violate',
                    'azur' => 'Azur',
                ]; ?>

                <div class="form-group">
                    <label for="ap_theme">Select Theme</label>
                    <select name="ap_theme" id="ap_theme">
                        <?php foreach ($themes as $theme => $name) : ?>
                            <option value="<?= $theme ?>" <?= $theme == get_option('ap_theme') ? 'selected' : false; ?>><?= $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ap_loading_message">Loading Message</label>
                    <textarea name="ap_loading_message" placeholder="Type message while loading the page" id="ap_loading_message" rows="3"><?php echo get_option('ap_loading_message'); ?></textarea>

                </div>

                <div class="ap_button">
                    <button type="submit">Update</button>
                </div>
            </form>

            <!-- about the developer -->
            <div class="center">Simplest and Lightweight Ajax Page Loading Plugin for WordPress, developed by <a href="https://facebook.com/IamJafran" target="_blank">Jafran Hasan</a>
            </div>

            <div class="icons">
                <a href="https://github.com/imjafran" target="_blank"><img src="https://www.flaticon.com/svg/static/icons/svg/25/25231.svg" alt=""></a>
                <a href="https://facebook.com/iamjafran" target="_blank"><img src="https://blog-assets.hootsuite.com/wp-content/uploads/2018/09/f-ogo_RGB_HEX-58.png" alt=""></a>
                <a href="https://linkedin.com/iamjafran" target="_blank"><img src="https://blog-assets.hootsuite.com/wp-content/uploads/2018/09/In-2C-54px-R.png" alt=""></a>
            </div>
        </div>
    <?php
    });
});





// adding ajaxpress constant wp_head 
add_action('wp_head', function () {
    if (get_option('ap_enable') == 'on') :
        echo '<script> const _ap = { selector : "' . get_option('ap_container_selector') . '", hostname : "' . home_url() . '", theme : "' . get_option('ap_theme') . '", loading : "' . get_option('ap_loading_message') . '" }; </script>';
    endif;
});


// adding loading content code in footer
add_action('wp_footer', function () {
    if (get_option('ap_enable') == 'on') :
    ?><div class="ap_container" style="display: none">
            <h4>Loading..</h4>
            <div class="loading">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div><?php
            endif;
        });
