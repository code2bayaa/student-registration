<?php
    use yii\bootstrap4\ActiveForm;
    use yii\bootstrap4\Html;
    $this->title = 'Registration';
?>

<div id = 'build' class = 'wall'>
    <?php if($window === 1){ ?>
        <div id = 'registration_wall'>
            <img src = 'https://www.tum.ac.ke/content/core/tum-logo.png'>
            <form accept-charset=utf8 id = 'fake_form'>
                <div id = 'internal-frame'>
                    <div id = 'internal-div-frame'>
                        <p id = 'reg_first_name' class = 'legend'>First Name</p>
                        <input placeholder = 'First Name' through = 'Registration_name' carry = '#reg_first_name' loop = '0' id = 'fake'>
                    </div>

                    <div id = 'internal-div-frame'>
                        <p id = 'reg_middle_name' class = 'legend' >Middle Name</p>
                        <input placeholder = 'Middle Name' through = 'Registration_name' carry = '#reg_middle_name' loop = '1' id = 'fake'>
                    </div>

                    <div id = 'internal-div-frame'>
                        <p id = 'reg_last_name' class = 'legend' >Last Name</p>
                        <input placeholder = 'Last Name' through = 'Registration_name' carry = '#reg_last_name' loop = '2' id = 'fake'>
                    </div>
                </div>
                    <p id = 'feedback'></p>
                    <p id = 'feedback'></p>
                    <p id = 'feedback'></p>
                <div id = 'internal-div'>
                    <p id = 'reg_number' class = 'legend' >Student ID</p>
                    <input placeholder = 'Student ID' through = 'Registration_number' carry = '#reg_number' id = 'fake'>
                    <p id = 'feedback'></p>
                </div>
                <div id = 'internal-div'>
                    <p id = 'reg_email' class = 'legend' >Student Email</p>
                    <input placeholder = 'Student Email' through = 'Registration_email' carry = '#reg_email' id = 'fake'>
                    <p id = 'feedback'></p>
                </div>
                <div id = 'internal-div'>
                    <p id = 'reg_personal_email' class = 'legend' >Personal Email</p>
                    <input placeholder = 'Personal Email' through = 'Registration_personal_email' carry = '#reg_personal_email' id = 'fake'>
                    <p id = 'feedback'></p>
                </div>
                <div id = 'internal-div'>
                    <p id = 'reg_personal_id' class = 'legend' >National ID/Passport</p>
                    <input placeholder = 'National ID/Passport' through = 'Registration_personal_id' carry = '#reg_personal_id' id = 'fake'>
                    <p id = 'feedback'></p>
                </div>
                <div id = 'internal-div'>
                    <p id = 'reg_mobile' class = 'legend' >Mobile Number</p>
                    <input place = 'Mobile Number' through = 'Registration_mobile' carry = '#reg_mobile' id = 'fake' class = 'mobile_flag'>
                    <p id = 'feedback'></p>
                </div>
                <div id = 'internal-div'>
                    <p id = 'reg_age'>Age</p>
                    <input placeholder = 'Age' through = 'Registration_age' carry = '#reg_age' type = 'date' id = 'fake'>
                    <p id = 'feedback'></p>
                </div>
                <div id = 'internal-div'>
                    <p id = 'reg_gender'>Gender</p>
                    <select placeholder = 'Gender' through = 'Registration_gender' carry = '#reg_gender' id = 'fake'>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    <p id = 'feedback'></p>
                </div>
                <div id = 'internal-div'>
                    <p id = 'reg_campus'>Campus</p>
                    <select placeholder = 'Campus' through = 'Registration_campus' carry = '#reg_campus' id = 'fake'>
                        <option>Main</option>
                        <option>Kwale</option>
                        <option>Lamu</option>
                    </select>
                    <p id = 'feedback'></p>
                </div>
                <button id = 'prev_data' type = 'submit'>Preview</button>
            </form>
            <?php $form = ActiveForm::begin([
                'id' => 'confirm_student',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>
            <?= $form->field($model, 'student_id')->textInput(['type' => 'hidden', 'id' => 'Registration_number'])->label(false) ?>
            <?= $form->field($model, 'student_email')->textInput(['id' => 'Registration_email', 'type' => 'hidden'])->label(false) ?>
            <?= $form->field($model, 'name')->textInput(['id' => 'Registration_name', 'type' => 'hidden'])->label(false) ?>
            <?= $form->field($model, 'age')->textInput(['id' => 'Registration_age', 'type' => 'hidden'])->label(false) ?>
            <?= $form->field($model, 'personal_id')->textInput(['id' => 'Registration_personal_id', 'type' => 'hidden'])->label(false) ?>
            <?= $form->field($model, 'mobile')->textInput(['id' => 'Registration_mobile', 'type' => 'hidden'])->label(false) ?>
            <?= $form->field($model, 'gender')->textInput(['id' => 'Registration_gender', 'type' => 'hidden'])->label(false) ?>
            <?= $form->field($model, 'campus')->textInput(['id' => 'Registration_campus', 'type' => 'hidden'])->label(false) ?>
            <?= $form->field($model, 'personal_email')->textInput(['id' => 'Registration_personal_email', 'type' => 'hidden'])->label(false) ?>

            <div class="form-group">
                <div class="offset-lg-1 col-lg-11">
                    <?= Html::submitButton('Register Student', ['class' => 'button-send', 'name' => 'register', 'id' => 'register']) ?>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
    <?php } ?>
    <?php if($window === 2){ ?>
        <script>
            const runTimer = () => {
                let interval = 0
                Timer = setInterval(function(){
                    let sec = document.getElementById('timer_sec').innerHTML
                    let min = document.getElementById('timer_min').innerHTML
                    if(sec === "00"){
                        sec = 59
                        min = (Number(min) - 1)
                    }else
                        sec = (Number(sec) - 1)
                    if(sec === 0)
                        sec = "00"
                    document.getElementById('timer_sec').innerHTML = sec
                    document.getElementById('timer_min').innerHTML = min
                    interval++
                    if(interval == 600)
                        stopTimer()
                },1000)

            }
            const stopTimer = () => {
                $('#otp_expire').html('Time expired')
                clearInterval(Timer)
            }
            runTimer()
        </script>
        <div class = 'otp_form'>
            <form accept-charset=utf8>
                <div id = 'otp_wrap'>
                    <input id = 'otpOne' class = 'otp' autofocus required/>
                    <input id = 'otpTwo' class = 'otp' required/>
                    <input id = 'otpThree' class = 'otp' required/>
                    <input id = 'otpFour' class = 'otp' required/>
                </div>
                <span id = 'otp_expire'>
                    <span id = 'timer_min'>10</span>:<span id = 'timer_sec'>00</span>
                </span>
            </form>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'confirm_otp',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                'inputOptions' => ['class' => 'col-lg-3 form-control'],
                'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
            ],
        ]); ?>

        <?= $form->field($model, 'token')->textInput(['type' => 'hidden', 'id' => 'otp_id'])->label(false) ?>
        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Check', ['name' => 'otp_accept', 'id' => 'otp_send']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    <?php } ?>
    <?php if($window === 3){ ?>
        <div class = 'return_modal'>
            <video autoplay="" class="fp-engine" preload="none" webkit-playsinline="true" playsinline="true" src="https://v.moele.me/v/13778/13768656_a-01.webm" x-webkit-airplay="allow"></video>
            <h4><?= $message; ?></h4>
            <a href = 'http://localhost:8080/students/registration/'>OK</a>
        </div>
    <?php } ?>
</div>