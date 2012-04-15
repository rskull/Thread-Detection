<?php
    /**
     * スレッドを検出するAPI
     * 指定したツイートから続いた会話をJSONで出力
     * クロスドメイン制約は無理矢理回避
     * @author R.SkuLL
     * 10 April 2012
    **/
    header("Content-Type: text/javascript; charset=utf-8");
    header("Access-Control-Allow-Origin: *");
    require_once 'class/Threader.php';
    date_default_timezone_set('Asia/Tokyo');
    
    $thread = new Threader;
    $thread->Detection();
