<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 25.3.2020 г.
 * Time: 13:18
 */

//add_shortcode('ADMIN', 'showAdminContent');
function showAdminContent($attributes, $content = null)
{
    $user = wp_get_current_user();
    $loggedIn = is_user_logged_in();
    if ($loggedIn && in_array("administrator", (array)$user->roles)) {
        return do_shortcode($content);
    } else if($loggedIn){
        return renderAccessDeniedPage();
    } else {
        return renderLoginRedirect();
    }
}

function renderLoginRedirect() {
    $viewPath = dirname(__FILE__) . '/../views/redirect.phtml';
    $redirectTo = 'login';
    return combat_render_view($viewPath, $redirectTo);
}

function renderAccessDeniedPage() {
    $viewPath = dirname(__FILE__) . '/../views/403.phtml';
    return combat_render_view($viewPath);
}