<?php
    /**
     * Twitter Class
     * @author R.SkuLL
     * 10 April 2012
    **/
    class Twitter {
    
        public $show;
        public $profile;
        public $ReplyId;
        public $Sname;
        public $Name;
        public $UserId;
        public $Text;
        public $StId;
        public $CreateDate;
        
        public function __construct ($stid) {
            $api = "https://api.twitter.com/1/statuses/show/{$stid}.json";
            $json = @file_get_contents($api);
            $this->show = json_decode($json);
            if ($http_response_header[0] == 'HTTP/1.0 404 Not Found') {
                die('{"error":"No status found."}');
            }
        }
        
        public function getUserProfile () {
            $json = $this->show;
            $this->profile->ReplyId = $json->in_reply_to_status_id_str;
            $this->profile->Sname = $json->user->screen_name;
            $this->profile->Name = $json->user->name;
            $this->profile->UserId = $json->user->id_str;
            $this->profile->Text = $json->text;
            $this->profile->StId = $json->id_str;
            $this->profile->CreateDate = $json->created_at;
            
            return $this->profile;
        }
        
    }
