<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 24.3.2020 г.
 * Time: 14:28
 */

function wordpress_custom_registration_form($first_name, $last_name, $username, $password, $confirm_password, $email)
{
    global $username, $password, $email, $first_name, $last_name;
    echo '
    <div class="register-container">
    <h3>Register account</h3>
    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
        <div>
            <label for="fname">First Name :</label> 
            <input type="text" class="cr-form-input" name="fname" value="' . (isset($_POST['fname']) ? $first_name : null) . '">
        </div>
        <div>
            <label for="lname">Last Name :</label>
            <input type="text"  class="cr-form-input" name="lname" value="' . (isset($_POST['lname']) ? $last_name : null) . '">
        </div>
        <div>
            <label for="username">Username: <strong>*</strong></label>
            <input type="text" class="cr-form-input" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
        </div>
        <div>
            <label for="password">Password: <strong>*</strong></label>
            <input type="password" class="cr-form-input" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
        </div>
        <div>
            <label for="cpassword">Confirm password: <strong>*</strong></label>
            <input type="password" class="cr-form-input" name="cpassword" value="' . (isset($_POST['cpassword']) ? $confirm_password : null) . '">
        </div>
        <div>
            <label for="email">Email: <strong>*</strong></label>
            <input type="text" class="cr-form-input" name="email" value="' . (isset($_POST['email']) ? $email : null) . '">
        </div>
       <input type="submit" class="btn button-primary" name="submit" value="Register"/>
    </form>
    </div>
    ';
}

function wp_reg_form_valid($username, $password, $confirm_password, $email)
{
    global $customize_error_validation;
    $customize_error_validation = new WP_Error;

    if (empty($username) || empty($password) || empty($email)) {
        $customize_error_validation->add('field', ' Please Fill the filed of WordPress registration form');
    }

    if (username_exists($username)) {
        $customize_error_validation->add('user_name', ' User Already Exist');
    }

    if ($password !== $confirm_password) {
        $customize_error_validation->add('password error', ' Password and Confirm password field are different');
    }

    if (is_wp_error($customize_error_validation)) {
        foreach ($customize_error_validation->get_error_messages() as $error) {
            echo '<strong>Hold</strong>:';
            echo $error . '<br/>';
        }
    }
}

function wordpress_user_registration_form_completion()
{
    global $customize_error_validation, $username, $password, $email, $first_name, $last_name;
    if (1 > count($customize_error_validation->get_error_messages())) {
        $userdata = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'user_login' => $username,
            'user_email' => $email,
            'user_pass' => $password,

        );

        $userId = wp_insert_user($userdata);

        if (!isset($_SESSION['register'])) {
            $_SESSION['register'] = 'Successful registration!';
        }

        wp_redirect(home_url('/login'));
        exit();
    }
}

function wordpress_custom_registration_form_function()
{
    global $first_name, $last_name, $username, $password, $confirm_password, $email;

    if (isset($_POST['submit'])) {
        wp_reg_form_valid(
            $_POST['username'],
            $_POST['password'],
            $_POST['cpassword'],
            $_POST['email'],
            $_POST['fname'],
            $_POST['lname']
        );

        $username = sanitize_user($_POST['username']);
        $password = esc_attr($_POST['password']);
        $email = sanitize_email($_POST['email']);
        $first_name = sanitize_text_field($_POST['fname']);
        $last_name = sanitize_text_field($_POST['lname']);
        wordpress_user_registration_form_completion(
            $username,
            $password,
            $email,
            $first_name,
            $last_name
        );
    }

    wordpress_custom_registration_form(
        $username,
        $password,
        $email,
        $first_name,
        $confirm_password,
        $last_name
    );
}
