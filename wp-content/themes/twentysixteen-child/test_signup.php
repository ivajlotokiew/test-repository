<?php

get_header();

if ($_POST) {

    $username = esc_sql($_POST['txtUsername']);
    $email = esc_sql($_POST['txtEmail']);
    $password = esc_sql($_POST['txtPassword']);
    $ConfPassword = esc_sql($_POST['txtConfirmPassword']);

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
        $userdata = array(
            'user_login' => $username,
            'user_email' => $email,
            'user_pass' => $password
        );

        wp_create_user($username, $password, $email);
        wp_redirect(home_url() . '/login');
        die();
    }
}


?>

<div class="form-container">
    <form method="post">
        <div style="max-width: 400px;">
            <h2 class="form-signin-heading">
                Registration</h2>
            <label for="txtUsername">
                Username</label>
            <input name="txtUsername" type="text" id="txtUsername" class="form-control" placeholder="Enter Username"
                   required oninvalid="this.setCustomValidity('Enter your User Name Here')"
                   oninput="this.setCustomValidity('')"/>
            <br/>
            <label for="txtPassword">
                Password</label>
            <input name="txtPassword" type="password" id="txtPassword"
                   class="form-control" placeholder="Enter Password" required/>
            <br/>
            <label for="txtConfirmPassword">
                Confirm Password</label>
            <input name="txtConfirmPassword" type="password" id="txtConfirmPassword" class="form-control"
                   placeholder="Confirm Password"/>
            <br/>
            <label for="txtEmail">
                Email</label>
            <input name="txtEmail" id="txtEmail" class="form-control" placeholder="Enter Email"
                   required type="email"/>
            <hr/>
            <input type="submit" name="btnSignup" value="Sign up" id="btnSignup" class="btn btn-primary"/>
        </div>
    </form>
</div>
<script type="text/javascript">
    let registerErrors = '';
    jQuery(window).on('load', function () {
        let txtPassword = document.getElementById("txtPassword");
        let txtConfirmPassword = document.getElementById("txtConfirmPassword");
        let testId = jQuery("#txtPassword");
        txtPassword.onchange = ConfirmPassword;
        txtConfirmPassword.onkeyup = ConfirmPassword;
        if (registerErrors !== "") {
            console.log(JSON.parse(registerErrors));
        }

        function ConfirmPassword() {
            txtConfirmPassword.setCustomValidity("");
            if (txtPassword.value != txtConfirmPassword.value) {
                txtConfirmPassword.setCustomValidity("Passwords do not match.");
            }
        }

        function DisplayErrors(errors) {
            jQuery("<div>", {
                    'class': "test class",
                    'text': 'HERE AM I'
                }
            ).appendTo(testId);
        }
    })
</script>
