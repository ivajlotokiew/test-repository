<?php
/*
Template Name: Register

*/
get_header();

global $wpdb;

if ($_POST) {

    $username = $wpdb->escape($_POST['txtUsername']);
    $email = $wpdb->escape($_POST['txtEmail']);
    $password = $wpdb->escape($_POST['txtPassword']);
    $ConfPassword = $wpdb->escape($_POST['txtConfirmPassword']);

    $error = array();
    if (strpos($username, ' ') !== FALSE) {
        $error['username_space'] = "Username has Space";
    }

    if (empty($username)) {
        $error['username_empty'] = "Needed Username must";
    }

    if (username_exists($username)) {
        $error['username_exists'] = "Username already exists";
    }

    if (!is_email($email)) {
        $error['email_valid'] = "Email has no valid value";
    }

    if (email_exists($email)) {
        $error['email_existence'] = "Email already exists";
    }

    if (strcmp($password, $ConfPassword) !== 0) {
        $error['password'] = "Password didn't match";
    }

    if (count($error) == 0) {

        wp_create_user($username, $password, $email);
        echo "User Created Successfully";
        exit();
    } else {

        print_r($error);

    }
}
?>
<div class="form-container">
    <form method="post">
        <div>
            <div>
                <label for="txtUsername">Username
                    <input id="txtUsername" name="txtUsername" placeholder="Username"/>
                </label>
            </div>
            <div>
                <label for="txtEmail">Email
                    <input id="txtEmail" name="txtEmail" placeholder="Email"/>
                </label>
            </div>
            <div>
                <label for="txtPassword">Password
                    <input type="password" id="txtPassword" name="txtPassword" placeholder="Password"/>
                </label>
            </div>
            <div>
                <label for="txtConfirmPassword">Confirm password
                    <input type="password" id="txtConfirmPassword" name="txtConfirmPassword"
                           placeholder="Confirm password"/>
                </label>
            </div>
        </div>
        <input type="submit" name="btnSubmit"/>
    </form>
</div>
