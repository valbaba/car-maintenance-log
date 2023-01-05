<?php
/*
 * Copyright (c) 2023. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

class PHPConfig{


    function setSessionsLife(){
        ini_set('session.gc_maxlifetime', 7200);
    }

    function setCookiesLife(){
        session_set_cookie_params(7200);
    }

    function createSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } else {
            echo "aled";
        }
    }

    function isSessionActive()
    {
        if (session_status() == PHP_SESSION_NONE) {
            return false;
        } else {
            return true;
        }
    }


}