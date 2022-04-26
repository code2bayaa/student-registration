<?php

namespace app\modules\students\controllers;

use Yii;
use yii\web\Controller;
use app\modules\students\middleware\ConfirmStudent;
use app\modules\students\middleware\InsertStudent;
use app\modules\students\middleware\Communicate;
use app\modules\students\middleware\Token;
use app\modules\students\models\Info\Info;

class RegistrationController extends Controller
{
    public function actionIndex(){

        $model = new Info();
        $virtual = 1;
        $message = false;
        if ($this->request->isPost) { //insert register
            if ($model->load($this->request->post()) && ($model->student_id)) {
               // all inputs are valid
                if ($model->validate()) {
                    //Check whether he/she is a student
                    $data = [
                        'db' => false,
                        'table' => 'tblSTUDENTS',
                        'query' => [':id' => $model->student_id, ':email' => $model->student_email],
                        'sql' => "RegStud_No_PK =:id or RegStud_Email =:email",
                        'column' => '*',
                        'limit' => 1,
                        'order' => 'RegStud_No_PK DESC, RegStud_Email DESC'
                    ];
                    $connect = ConfirmStudent::fetchStudent($data);
                    //If user is a student
                    $message = "You are not a student at TUM";
                    if(gettype($connect) !== "boolean"){
                        //Check if student is in the database
                        $data = [
                            'db' => true,
                            'table' => 'info',
                            'query' => [':id' => $model->student_id, ':email' => $model->student_email, ':status' => 1 ],
                            'sql' => "student_id =:id and token =:status or student_email =:email and token =:status",
                            'column' => '*',
                            'limit' => 1,
                            'order' => 'student_id DESC'
                        ];
                        $connect = ConfirmStudent::fetchStudent($data);
                        $virtual = 3;
                        //If user has cleared the tokens
                        if(gettype($connect) !== "boolean")
                            $message = "You already have an account";
                        else{ //If user has not cleared the tokens or is new user
                            //generate Token
                            $OTP = Token::generateToken(['db' => 'info', 'token' => false, 'length' => 4]);
                            //send sms
                            $sms = Communicate::sendText([
                                'to' => $model->token,
                                'message' => "Your OTP confirmation is $OTP"
                            ]);

                            $message = "There was an error sending the message";
                            if($sms){ //sms is sent successfully
                                $model->token = $OTP;
                                $model->status = 'sms';
                                $model->password = md5($model->personal_id);
                                $model->expire = date("Y-m-d H:i");
                                $finish_sms = $model->save();
                                $message = "There was an error saving the register";
                                if($finish_sms){
                                    $virtual = 2;
                                    $model = new Info();
                                    $message = "Success!";
                                }
                            }
                        }
                    }
                } else {
                    // validation failed: $errors is an array containing error messages
                    $message = $model->errors;
                }
            }else{ //confirm otp and send email
                $data = [
                    'column' => '*',
                    'table' => 'info',
                    'query' => [':token' => $model->token],
                    'limit' => 1,
                    'sql' => 'token = :token',
                    'order' => '',
                    'db' => true
                ];
                //otp confirmed
                $validity = ConfirmStudent::fetchStudent($data);
                $virtual = 3;
                if(gettype($validity) !== 'boolean'){

                    //generate email token
                    $email_token = Token::generateToken(['db' => 'info', 'token' => true, 'length' => 6]);
                    //$email_token = '9889';
                    $group = [
                        'token' => $validity[0]['expire'],
                        'student' => $validity[0]['student_email'],
                        'status' => $email_token,
                        'level' => 'email',
                        'expire' => date("Y-m-d H:i")
                    ];

                     //send email
                    $subject = "Confirm student detail registration";
                    $msg = "
                            <div style = '@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@500&display=swap');font-family: 'Nunito', sans-serif;height:100%;width:100%;background-image:linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5),rgba(0,0,0,0.7)),url(https://www.tum.ac.ke/content/banners/5c6hpunyzppyjc6m6.png);
                                                                     -webkit-background-size:cover;
                                                                     background-size:cover;
                                                                     background-repeat:no-repeat;
                                                                     background-position:center;'>
                                <div style = 'background:rgba(255,255,255,0.8);height:98%;width:80%;margin:1%;margin-left:10%;text-align:center;'>
                                    <img src = 'https://www.tum.ac.ke/content/core/tum-logo.png'>
                                    <h3>Student Detail Registration Confirmation</h4>
                                    <p>Please click below to finalize your registration<p>
                                    <a href = 'http://localhost:8080/students/registration/valid?id=$email_token' style = 'text-decoration:underline;height:40px;color:#fff;background:#0d8767;border:none;width:40%;display:inline-block;text-align:center;'>Click Here</a>
                                </div>
                            </div>
                            ";
                    $e_text = Communicate::sendEmail(['to' => $validity[0]['student_email'],'name' => $validity[0]['name'], 'cc' => $validity[0]['personal_email'], 'bc' => false, 'image_url' => false, 'image_name' => false, 'subject' => $subject, 'body' => $msg, 'text' => false]);

                    if(gettype($e_text) == 'boolean'){
                        if($e_text){
                            //If token is true update new email token
                            //email token set
                            $authenticate = Token::limitToken($group);
                            if($authenticate){
                                $model = new Info();
                                $message = "An email has been sent to your email please click on the link to finalise registration";
                            }
                        }else
                            $message = "Email Could Not Be Sent";

                    }else
                        $message = $e_text['Error'];
                }else
                    $message = "Invalid token. Please resend";
            }
        }
        return $this->render('index',[
            'model' => $model,
            'window' => $virtual,
            'message' => $message
        ]);
    }
    public function actionLogin(){
        $model = new Info();
        return $this->render('login',[
            'model' => $model
        ]);
    }
    public function actionTest(){
        $data = [
            'db' => false,
            'table' => 'tblSTUDENTS',
            'query' => [],
            'sql' => "",
            'column' => 'RegStud_No_PK,RegStud_Email',
            'limit' => 200,
            'order' => 'RegStud_No_PK DESC, RegStud_Email DESC'
        ];
        $connect = ConfirmStudent::fetchStudent($data);
        print_r(json_encode($connect));
    }
    public function actionValid($id){
        $data = [
            'db' => true,
            'table' => 'info',
            'query' => [':token' => $id],
            'sql' => "token =:token",
            'column' => '*',
            'limit' => 1,
            'order' => ''
        ];
        $validity = ConfirmStudent::fetchStudent($data);
        $approve = [
            'img' => '/img/error.svg',
            'message' => 'There was an error. Create another register'
        ];
        if(gettype($validity) !== 'boolean'){
            $group = [
                'token' => $validity[0]['expire'],
                'student' => $validity[0]['student_email'],
                'status' => true,
                'level' => true,
                'expire' => '0000-00-00 00:00:00'
            ];
            $authenticate = Token::limitToken($group);
            $approve = [
                'img' => '/img/success.svg',
                'message' => 'Account Created Successfully. Use your ID as first time login password'
            ];
        }
        return $this->render('valid',[
            'id' => $id,
            'approve' => $approve
        ]);
    }
}
?>