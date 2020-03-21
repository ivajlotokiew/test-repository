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
                <label for="txtUsername" class="com-label-indent col-sm-2">Username</label>
                <input type="text" class="com-input-fields" name="txtUsername" id="txtUsername" value=""
                       autocapitalize="off" placeholder="Username"/>
            </div>
            <div>
                <label for="txtEmail" class="com-label-indent col-sm-2">Email</label>
                <input type="text" class="com-input-fields" name="txtEmail" id="txtEmail" value="" autocapitalize="off"
                       placeholder="Email"/>
            </div>
            <div>
                <label for="txtPassword" class="com-label-indent col-sm-2">Password</label>
                <input type="password" class="com-input-fields" name="txtPassword" id="txtPassword" value=""
                       autocapitalize="off" placeholder="Password"/>
            </div>
            <div>
                <label for="txtConfirmPassword" class="com-label-indent col-sm-2">Confirm password</label>
                <input type="password" class="com-input-fields" name="txtConfirmPassword" id="txtConfirmPassword"
                       value="" autocapitalize="off" placeholder="Confirm password"/>
            </div>
        </div>
        <div class="com-btn-container">
            <input type="submit" class="com-btn" name="btnSubmit" value="Register"/>
        </div>
    </form>
</div>



