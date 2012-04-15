<?php
    /**
     * Twitter Class
     * @author R.SkuLL
     * 10 April 2012
    **/
    class Twitter {
    
        public $show;
        
        public function __construct ($stid) {
            $api = "https://api.twitter.com/1/statuses/show/{$stid}.json";
            $json = @file_get_contents($api);
            $this->show = json_decode($json);
            if ($http_response_header[0] == 'HTTP/1.0 404 Not Found') {
                die('{"error":"No status found."}');
            }
        }
        
        public function ReplyId () {
            $json = $this->show;
            return $json->in_reply_to_status_id_str;
        }
        
        public function Sname () {
            $json = $this->show;
            return $json->user->screen_name;
        }
        
        public function Name () {
            $json = $this->show;
            return $json->user->name;
        }
        
        public function UserId () {
            $json = $this->show;
            return $json->user->id_str;
        }
        
        public function  Text () {
            $json = $this->show;
            return $json->text;
        }
        
        public function StId () {
            $json = $this->show;
            return $json->id_str;
        }
        
        public function CreateDate () {
            $json = $this->show;
            return $json->created_at;
        }
        
    }
