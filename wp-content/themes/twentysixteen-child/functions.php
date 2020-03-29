<?php

function session_flash_messages()
{
    if (!session_id()) {
        session_start();
    }
}

add_action('init', 'session_flash_messages', 1);

function enqueue_parent_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'enqueue_parent_styles');


function my_custom_login_stylesheet()
{
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/style-login.css');
}

//This loads the function above on the login page
add_action('login_enqueue_scripts', 'my_custom_login_stylesheet');

function login_error_override()
{
    return 'Incorrect login details.';
}

add_filter('login_errors', 'login_error_override');


function admin_login_redirect($redirect_to, $request, $user)
{
    global $user;

    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array("administrator", $user->roles)) {
            return $redirect_to;
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}

add_filter("login_redirect", "admin_login_redirect", 10, 3);


function add_loginout_link($items, $args)
{
    if (is_user_logged_in() && $args->theme_location == 'primary') {
        $items .= '<li><a href="' . wp_logout_url() . '">Log Out</a></li>';
    } elseif (!is_user_logged_in() && $args->theme_location == 'primary') {
        $items .= '<li><a href="' . site_url('wp-login.php') . '">Log In</a></li>';
    }

    return $items;
}

add_filter('wp_nav_menu_items', 'add_loginout_link', 10, 2);


// Redirect Registration Page
function my_registration_page_redirect()
{
    global $pagenow;
    if ((strtolower($pagenow) == 'wp-login.php') && (strtolower($_GET['action']) == 'register')) {
        wp_redirect(home_url('/register'));
    }
}

add_filter('init', 'my_registration_page_redirect');


// theme's functions.php or plugin file
function my_new_menu_conditions($conditions)
{
    $conditions[] = array(
        'id' => 'register-page',                                 // unique ID for the rule
        'name' => __('is register page', 'test.local/register'),   // name of the rule
        'condition' => function ($item) {                                // callback - must return Boolean
            return is_page('80');
        }
    );

    return $conditions;
}

add_filter('if_menu_conditions', 'my_new_menu_conditions');


// Disable plugin update notification. In this case akismet plugin update notification is disabled.
function filter_plugin_updates($value)
{
    unset($value->response['akismet/akismet.php']);
    return $value;
}

add_filter('site_transient_update_plugins', 'filter_plugin_updates');


function do_output_buffer()
{
    ob_start();
}

add_action('get_header', 'do_output_buffer');


//if user is logged and trying to access register page
function redirect_logged_user()
{
    if (is_user_logged_in() && is_page('80')) {
        wp_redirect(home_url());
        exit();
    }
}

add_action('get_header', 'redirect_logged_user');


function registration_success_message()
{
    if (isset($_SESSION['register'])) {
        ?>
            <script>jQuery("#loginform").prepend("<div>Successful registration!</div>")</script>
        <?php
        unset($_SESSION['register']);
    }
}

add_action('login_form', 'registration_success_message');


function redirect_non_logged_users_to_specific_page()
{
    if ( (is_page('55') || is_page('/home-page')) && !is_user_logged_in()) {
        wp_redirect(site_url('/welcome-page', 301));
        die();
    }
}

add_action('template_redirect', 'redirect_non_logged_users_to_specific_page');