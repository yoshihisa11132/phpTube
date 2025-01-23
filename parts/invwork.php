<?php
    // 設定の読み込み
    require_once("./settings/main.php");
    require_once("./parts/functions.php");
    class inv{
        private $domaininv;
        public function __construct(){
            if ($GLOBALS["AS"]["invidious"] == "" || $GLOBALS["AS"]["invidious"] == null){
                // inivdiousが取れなかったら終了
                error_log("invidiousの値が設定されていません！終了します。");
                http_response_code(500);
                echo("error while checking.");
                die();
            }
            $this->domaininv = $GLOBALS["AS"]["invidious"];
        }
        public function fetchurls(string $url, array $params, string $domain = null){
            if ($domain === null) {
                $domain = $this->domaininv;
            }
            // まずはコマンドを組み立てる
            $cmd = "curl -m 5 -G ";
            foreach ($params as $param => $data) {
                $cmd .= "-d ".$param."=".escapeshellarg($data)." ";
            }
            $out = null;
            $retcode = null;
            $cmd .= escapeshellarg($domain.$url);
            // 取ってくる
            exec($cmd, $out, $retcode);
            // エラーが出たら負の値を出す
            if ($retcode == "-1" || $out == null){
                return false;
            }
            // デコードする
            $out = json_decode($out[0], true);
            if ($out == null){
                // 空っぽだったらfalse
                return false;
            }
            return $out;
        }
    }