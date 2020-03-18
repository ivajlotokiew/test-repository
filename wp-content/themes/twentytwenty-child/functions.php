<?php

function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );


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


