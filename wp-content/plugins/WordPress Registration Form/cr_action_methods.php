<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 24.3.2020 г.
 * Time: 13:40
 */

//add_filter('registration_errors', 'custom_validation_error_method', 10, 3);
function custom_validation_error_method($errors, $lname, $lastName)
{
    if (empty($_POST['fname']) || (!empty($_POST['fname']) && trim($_POST['fname']) == '')) {
        $errors->add('fname_error', __('<strong>Error</strong>: Enter Your First Name.'));
    }

    if (empty($_POST['lname']) || (!empty($_POST['lname']) && trim($_POST['lname']) == '')) {
        $errors->add('lname_error', __('<strong>Error</strong>: Enter Your Last Name.'));
    }

    return $errors;
}


//add_filter('send_email_new_user', 'send_welcome_mail', 10, 1);
function send_welcome_mail($user_id) {
    $user = get_userdata( $user_id );

    $user_login = stripslashes($user->user_login);
    $user_email = stripslashes($user->user_email);

    // The blogname option is escaped with esc_html on the way into the database in sanitize_option
    // we want to reverse this for the plain text arena of emails.
    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

    $message  = sprintf(__('New user registration on your site %s:'), $blogname) . "\r\n\r\n";
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

    @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), $blogname), $message);

    if ( empty($plaintext_pass) )
        return;

    $message  = sprintf(__('Username: %s'), $user_login) . "\r\n";
    $message .= sprintf(__('Password: %s'), $plaintext_pass) . "\r\n";
    $message .= wp_login_url() . "\r\n";

    wp_mail($user_email, sprintf(__('[%s] Your username and password'), $blogname), $message);
}