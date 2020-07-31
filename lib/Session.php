<?php
/**
 * Session Class
 */
 

class Session
{
    public static function init()
    {
        session_start();
        ob_start();
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }


    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }




    public static function checkSession()
    {
        if (self::get("cuslogin") == true) {
            echo '<script type="text/javascript">
            window.location.href = "/";
            </script>';
        }
    }

    // Funkcija za vracanje na home
    public function home()
    {
        $url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return $url;
    }

    public function adminUrl()
    {
        $url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/admin';
        return $url;
    }


    public static function checkAdmin()
    {
        self::init();
        if (self::get("is_admin") != 1) { // !* Ako nije admin
            self::destroy();
        }
    }
   


    public static function destroy()
    {
        session_destroy();
        echo '<script type="text/javascript">
            window.location.href = "/";
            </script>';
    }
}


$session = new Session();
