<?php
    /**
     * Threader Class
     * @author R.SkuLL
     * 10 April 2012
    **/
    
    require_once 'Twitter.php';
    
    class Threader {
        
        //続いた会話を終わるまで抽出
        public function Detection () {
            $stid = $this->getQuery('stid');
            if (!empty($stid)) {
            
                $Twitter = new Twitter($stid);
                $profile = $Twitter->getUserProfile();
                $repid = $profile->ReplyId;
                $thread = array();
                $thread[] = $this->SetThreadArray($profile);
                
                while (!empty($repid)) {
                    $Twitter = new Twitter($repid);
                    $profile = $Twitter->getUserProfile();
                    $repid = $profile->ReplyId;
                    $thread[] = $this->SetThreadArray($profile);
                }
                //逆順にして出力
                $this->JsonPrint(array_reverse($thread));
            }
            else {
                echo '{"error":"No status found."}';
            }
            
        }
        
        //時間を形成
        private function FormatDate ($date) {
            $date = new DateTime($date);
            $date->setTimezone(new DateTimeZone('Asia/Tokyo'));
            return $date->format('D M j G:i:s T Y');
        }
        
        //必要項目を配列化する
        private function SetThreadArray ($obj) {
            return array(
                'sname' => $obj->Sname,
                'name'  => $obj->Name,
                'id'    => $obj->UserId,
                'text'  => $obj->Text,
                'stid'  => $obj->StId,
                'date'  => $this->FormatDate($obj->CreateDate),
                'repid' => $obj->ReplyId
            );
        }
        
        //JSONに形成し出力
        private function JsonPrint ($obj) {
            //$json = json_encode($obj);
            $json = $obj;
            $callback = $this->getQuery('callback');
            if (!empty($callback)) {
                echo $callback.'('.$json.');';
            } else {
                print_r($json);
            }
        }
        
        //GETリクエスト取得
        private function getQuery ($name = null) {
            if (!$name) {
                return $_GET;
            } else {
                return $_GET[$name];
            }
        }
    
    }
