<?php
/**
 * Template Name: Sign in
 */

global $user_ID;
global $wpdb;

if (!$user_ID) {
    if ($_POST) {
        $username = $wpdb->escape($_POST["username"]);
        $password = $wpdb->escape($_POST["password"]);

        $login_array = [];
        $login_array['user_login'] = $username;
        $login_array['user_password'] = $password;

        $verify_user = wp_signon($login_array, true);
        if (!is_wp_error($verify_user)) {
            echo "<script>window.location = '" . site_url() . "'</script>";
        } else {
            echo "<p>Invalid credentials</p>";
        }
    } else {
        //user in logged out state
        get_header();
        ?>
        <form method="post">
            <p>
                <label for="username"><b>Username</b></label>
                <input type="text" id="username" placeholder="Enter Username" name="username" required>
            </p>
            <p>
                <label for="password"><b>Password</b></label>
                <input type="password" id="password" placeholder="Enter Password" name="password" required>
                <button type="submit" name="btn_submit">Log In</button>
            </p>
        </form>
        <?php
        get_footer();
    }
} else {
    // user is logged in
}

?>