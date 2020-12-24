<?php

/**
 * Plugin Name:       AjaxPress
 * Plugin URI:        https://github.com/iamjafran/Ajaxpress
 * Description:       AjaxPress is an WordPress plugin for loading self pages, posts, products and contents without reloading the page. It allowed users to submit comments and search using without reloading the page. 
 * Version:           2.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Jafran Hasan
 * Author URI:        https://github.com/iamjafran
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ajaxpress
 **/


//  defining root of the plugin
defined('ABSPATH') or die('Direct Script not Allowed');
define('_AjaxPress', __FILE__);

require_once __DIR__ . '/inc/load.php';
