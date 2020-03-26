<?php

namespace Src;

class AuthorizationShortcodes
{
    /**
     * Shortcode bowling_login_form
     * @see BaseShortcodeRegisterer::queueAuthorizationShortcodes()* @return string
     */
    public static function bowlingLoginForm()
    {
        $viewPath = locate_template('login-form.php');
        return ViewReader::readExternalView($viewPath);
    }

    /**
     * Shortcode bowling_register_form
     * @see BaseShortcodeRegisterer::queueAuthorizationShortcodes()
     * @return string
     */
    public static function bowlingRegisterForm() {
        $viewPath = locate_template('register-form.php');
        return ViewReader::readExternalView($viewPath);
    }

    /**
     * Shortcode bowling_lost_password_form
     * @see BaseShortcodeRegisterer::queueAuthorizationShortcodes()
     * @return string
     */
    public static function bowlingLostPasswordForm() {
        $viewPath = locate_template('lostpassword-form.php');
        return ViewReader::readExternalView($viewPath);
    }

    /**
     * Shortcode bowling_reset_password_form
     * @see BaseShortcodeRegisterer::queueAuthorizationShortcodes()
     * @return string
     */
    public static function bowlingResetPasswordForm() {
        $viewPath = locate_template('resetpass-form.php');
        return ViewReader::readExternalView($viewPath);
    }

    /**
     * Shortcode GUEST
     * @see BaseShortcodeRegisterer::queueAuthorizationShortcodes()
     * @param array $attributes
     * @param null|string $content
     * @return string
     */
    public static function showGuestContent($attributes, $content = null)
    {
        if (!is_user_logged_in()) {
            return do_shortcode($content);
        }
        return "";
    }

    /**
     * Shortcode PLAYER
     * @see BaseShortcodeRegisterer::queueAuthorizationShortcodes()
     * @param array $attributes
     * @param null|string $content
     * @return string
     */
    public static function showPlayerContent($attributes, $content = null)
    {
        if (!is_user_logged_in()) {
            return self::renderLoginRedirect();
        }
        return do_shortcode($content);
    }

    /**
     * Shortcode ORGANIZER
     * @see BaseShortcodeRegisterer::queueAuthorizationShortcodes()
     * @param array $attributes
     * @param null|string $content
     * @return string
     */
    public static function showOrganizerContent($attributes, $content = null)
    {
        $user = wp_get_current_user();
        $loggedIn = is_user_logged_in();
        if ($loggedIn && (in_array("organizer", (array)$user->roles) || in_array("administrator", (array)$user->roles))) {
            return do_shortcode($content);
        } else if($loggedIn){
            return self::renderAccessDeniedPage();
        } else {
            return self::renderLoginRedirect();
        }
    }

    /**
     * Shortcode ADMIN
     * @see BaseShortcodeRegisterer::queueAuthorizationShortcodes()
     * @param array $attributes
     * @param null|string $content
     * @return string
     */
    public static function showAdminContent($attributes, $content = null)
    {
        $user = wp_get_current_user();
        $loggedIn = is_user_logged_in();
        if ($loggedIn && in_array("administrator", (array)$user->roles)) {
            return do_shortcode($content);
        } else if($loggedIn){
            return self::renderAccessDeniedPage();
        } else {
            return self::renderLoginRedirect();
        }
    }

    protected static function renderLoginRedirect() {
        $viewPath = Constants::BASE_VIEWS_PATH . 'redirect.phtml';
        $redirectTo = 'login';
        return ViewReader::readExternalView($viewPath, $redirectTo);
    }

    protected static function renderAccessDeniedPage() {
        $viewPath = Constants::BASE_VIEWS_PATH . '403.phtml';
        return ViewReader::readExternalView($viewPath);
    }
}