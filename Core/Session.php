<?php

namespace Core;

/**
 * SessionControler Class
 *
 * @category  Session Controler
 * @package   Session
 * @author    Sadiq <sadiq.com.bd@gmail.com>
 * @copyright Copyright (c) 2022
 * @version   1.0.3
 * @package   SessionControler
 */

class Session {


    /**
     * starts a session if not started
     * @return void
     */
    public static function init() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }


    /**
     * @param $key
     * @param mixed $value
     */
    public static function set(string $key, $value, bool $merge_recursive = false) {
        self::init();

        if ($merge_recursive) {
            $_SESSION = array_merge_recursive($_SESSION, array(
                $key => $value
            ));
        } else {
            $_SESSION = array_merge($_SESSION, array(
                $key => $value
            ));
        }

    }


    /**
     * @param $key
     * @return mixed
     */
    public static function get($key) {
        self::init();

        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } 
            
        return null;

    }


    /**
     * @param string $key
     */
    public static function is_exist(string $key) {
        self::init();
        return self::get($key) !== null;
    }


    /**
     * unsets a session or all sessions
     * @param string $key
     */
    public static function unset($key = null) {
        self::init();
        if ($key === null) {
            
            self::destroy();
            return true;

        } else {
            
            unset($_SESSION[$key]);

        }
    }

    /**
     * destroys the session
     */
    public static function destroy() {
        self::init();
        session_unset();
        session_destroy();
    }
}


