<?php

namespace ReturnXero;

defined('ABSPATH') or die('Direct Script not Allowed');

// requiring files 
require_once __DIR__ . '/class/functions.php';

class AjaxPress
{
    public $functions = false;

    function __construct()
    {
        $this->functions = new \ReturnXero\AjaxPress\Functions();
        $this->functions->_register_hooks();
    }

    function activate()
    {
        $this->functions->registerOptions();
        $this->functions->resetOptions();
        flush_rewrite_rules();
    }

    function deactivate()
    {
        flush_rewrite_rules();
    }
}


$_ajaxpress = new \ReturnXero\AjaxPress();

register_activation_hook(_AjaxPress, [$_ajaxpress, 'activate']);
register_deactivation_hook(_AjaxPress, [$_ajaxpress, 'deactivate']);
