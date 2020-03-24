<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 24.3.2020 г.
 * Time: 13:40
 */

//add_filter('registration_errors', 'custom_validation_error_method', 10, 3);
function custom_validation_error_method($errors, $lname, $last_name)
{
    if (empty($_POST['fname']) || (!empty($_POST['fname']) && trim($_POST['fname']) == '')) {
        $errors->add('fname_error', __('<strong>Error</strong>: Enter Your First Name.'));
    }

    if (empty($_POST['lname']) || (!empty($_POST['lname']) && trim($_POST['lname']) == '')) {
        $errors->add('lname_error', __('<strong>Error</strong>: Enter Your Last Name.'));
    }

    return $errors;
}
