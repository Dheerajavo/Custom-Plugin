<?php
/*
Plugin Name: Custom Form
Description: Custom Form for login and registration.
Author: Dheeraj Singh
Version: 1.0
*/
if (!defined('ABSPATH')) {
  exit;
}
require_once(__DIR__ . '/register-form/custom-register-form.php');
require_once(__DIR__ . '/login-form/custom-login-form.php');



// for styling
add_action('wp_enqueue_scripts', 'custom_form_css');
function custom_form_css()
{
  wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'css/custom-form.css', array(), '1.0', 'all');
}


//for error in redirect
add_filter('template_redirect', function () {
  ob_start(null, 0, 0);
});


//for admin menu
add_action('admin_menu', 'custom_form_menu');
function custom_form_menu()
{
  add_menu_page(
    'Custom Form',
    'Custom Form',
    'manage_options',
    'custom-form',
    'custom_form_menu_page',
     'dashicons-smiley',
    28
  );
}
function custom_form_menu_page()
{ ?>
  <h1>Instructions</h1>
  <h2>Use this Shortcodes -> </h2>
  <h3>
    <pre>
    For Login Form    : [custom_login_form] 
    For Register Form : [custom_register_form]   
    </pre>
    <h3>

      <?php
}
