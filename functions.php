<?php
    // 設定の読み込み
    require_once("./settings/main.php");
    // cookieを読み込む
    function check_cookie(){
        // gizoucookieもしくはgizouOKnameが設定されていなかったら終了
        if ($AS["gizoucookie"] == "" || $AS["gizouOKname"] == ""){
            error_log("cookieの値が設定されていません！終了します。");
            http_response_code(500);
            echo("error while checking.");
        }
        // cookieを取得
        $cookie_input = $_COOKIE[$AS["gizoucookie"]];
        if ($cookie_input == "" || $cookie_input == null || $cookie_input != "gizouOKname"){
            // リダイレクト処理、またいつか書く

        } else {
            return true;
        }
    }