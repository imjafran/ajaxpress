<?php

namespace ReturnXero\AjaxPress;

class Functions
{
    function _register_hooks()
    {
        add_action('admin_menu', [$this,            'customAdminMenu']);
        add_action('admin_enqueue_scripts', [$this,            'enqueueAdminScripts']);
        add_action('wp_enqueue_scripts', [$this,            'enqueueWpScripts']);
        add_action('wp_ajax_ap_save_settings', [$this,            'saveOptions']);
        add_action('wp_head', [$this,            'addSettingsScriptHeader']);
        add_action('wp_footer', [$this,            'addContainerFooter']);
    }

    function getOptionsList()
    {
        return [
            [
                'name' => 'ap_enable',
                'default' => true,
                'args' => [
                    'type' => 'boolean',
                ]
            ],
            [
                'name' => 'ap_selector',
                'default' => '#main',
                'args' => [
                    'type' => 'string',
                ]
            ],
            [
                'name' => 'ap_theme',
                'default' => 'default',
                'args' => [
                    'type' => 'string',
                ]
            ],
            [
                'name' => 'ap_loading',
                'default' => 'Please wait..',
                'args' => [
                    'type' => 'string',
                ]
            ],
            [
                'name' => 'ap_search',
                'default' => true,
                'args' => [
                    'type' => 'boolean',
                ]
            ],
            [
                'name' => 'ap_comment',
                'default' => false,
                'args' => [
                    'type' => 'boolean',
                ]
            ]
        ];
    }

    function registerOptions()
    {
        $options = $this->getOptionsList();
        foreach ($options as $option) {
            add_option($option['name']);
            register_setting('ap_options_group', $option, $option['args']);
        }
    }

    function resetOptions()
    {
        $options = $this->getOptionsList();
        foreach ($options as $option) {
            update_option($option['name'], $option['default']);
        }
    }

    function saveOptions()
    {
        $options = $this->getOptionsList();
        $fields = [];
        foreach ($options as $option) {
            $optionTemp = $_REQUEST[$option['name']] ?? false;
            $fields[$option['name']] = $optionTemp == 'on' ? true : $optionTemp;
            update_option($option['name'], $fields[$option['name']]);
        }

        wp_send_json_success($fields);
    }

    function customAdminMenu()
    {
        add_options_page('AjaxPress Settings', 'AjaxPress', 'manage_options', 'ajaxpress', function () {
            include_once __DIR__ . '/../page/settings-page.php';
        });
    }

    function enqueueAdminScripts()
    {
        wp_enqueue_style('ajaxpress', plugin_dir_url(_AjaxPress) . '/assets/css/admin.min.css', false, null);

        wp_enqueue_script('swal', 'https://cdn.jsdelivr.net/npm/sweetalert2@10', ['jquery'], false, true);
        wp_enqueue_script('ajaxpress', plugin_dir_url(_AjaxPress) . '/assets/js/admin.js', false, true);
    }
    function enqueueWpScripts()
    {
        wp_enqueue_style('ajaxpress', plugin_dir_url(_AjaxPress) . '/assets/css/ajaxpress.min.css', false, null);

        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.5.1.min.js', [], false, false);
        wp_enqueue_script('ajaxpress', plugin_dir_url(_AjaxPress) . '/assets/js/ajaxpress.js', false, true);
    }

    function getThemes()
    {
        return [
            'none' => 'None',
            'default' => 'Default',
            'dark-ocean' => 'Dark Ocen',
            'ultra-violate' => 'Ultra Violate',
            'azur' => 'Azur',
        ];
    }

    function addSettingsScriptHeader()
    {
?>
        <script>
            const _ajaxPress = {
                enable: true,
                selector: '#main',
                theme: true,
                loading: true,
                search: true,
                comment: true,
            }
        </script>
        <?php
    }

    function addContainerFooter()
    {
        if (get_option('ap_enable')) :
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
            }
        }
