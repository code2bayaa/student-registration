<?php

namespace app\modules\students\middleware;

use Yii;
use app\modules\students\models\Info\Register;
use app\modules\students\middleware\ConfirmStudent;

class Token
{

    const long_string = "poiuztrewqasdfghjklmnbvcxy1234567890";
    const short_string = "1234567890";

    public function generateToken($token_data){

        $track = self::short_string;
        if($token_data['token'])
            $track = self::long_string;

        $token = str_shuffle($track);
        $token = substr($token, 0, $token_data['length']);

        if(self::checkToken(['raw' => $token, 'table' => $token_data['db'], 'token' => $token_data['token'], 'length' => $token_data['length']]) == true)
            return $token;
    }
    private function checkToken($raw_token){
        $data = [
            'column' => '*',
            'table' => $raw_token['table'],
            'query' => ['token' => $raw_token['raw']],
            'limit' => 1
        ];
        $condition = ConfirmStudent::returnStudent($data);
        if($condition)
            return self::generateToken(['db' => $raw_token['table'], 'token' => $raw_token['token'], 'length' => $raw_token['length']]);
        else
            return true;
    }
    public function limitToken($user){

         $expired = date('Y-m-d H:i',strtotime($user['token']));
         $expiredd = date_create_from_format('Y-m-d H:i',$expired);
         date_add($expiredd,date_interval_create_from_date_string("10 minutes"));
         $expire =  date_format($expiredd,'Y-m-d H:i');
         $recent = date("Y-m-d H:i");
         if($recent < $expire)
             return ConfirmStudent::UpdateStudent("UPDATE info SET token = '".$user['status']."', expire = '".user['expire']."', status = '".$user['level']."' WHERE student_email = '".$user['student']."'");
         return false;
    }
}
?>