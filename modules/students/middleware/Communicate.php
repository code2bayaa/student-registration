<?php
namespace app\modules\students\middleware;

use Yii;
use app\modules\students\models\Info\Register;
use app\modules\students\models\Info\Info;

class Communicate
{
    protected $attempts;
    protected $channel_data;

    function __construct(){
        $this->attempts = 0;
    }
    public static function sendText($channel){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.africastalking.com/version1/messaging');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'apiKey' => '0526c93de4f5f0770f24943b060307a49bbc5df9e2cf3373f8d326f9fc6d98be',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=sandbox&to=".$channel['to'].",&message=".$channel['message']."&from=46862");

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        return true;
        /*
        if($response->SMSMessageData->Recipients[0]->statusCode == 101)
            return true;
        else{
             //Create three attempts before failure
            if((int)$this->attempts < 4){
                self::sendText($channel);
                $this->attempts++;
            }else
                return true;
        }*/
    }
    public function sendEmail($sets){

        $user = Info::findOne([
            'student_email' => $sets['to']
        ]);
        return Yii::$app
            ->mailer
            ->compose()
            ->setFrom([Yii::$app->params['adminEmail'] => 'TUM'])
            ->setTo($sets['to'])
            ->setCc($sets['cc'])
            ->setSubject($sets['subject'])
            ->setHtmlbody($sets['body'])
            ->send();
    }
}
?>