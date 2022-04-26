<?php
    use yii\bootstrap4\ActiveForm;
    use yii\bootstrap4\Html;
    $this->title = 'LogIn';
?>
<div id = 'build' class = 'login_poll'>
    <div  class = 'login_wall'>
        <form accept-charset=utf8>
            <img src = 'https://www.tum.ac.ke/content/core/tum-logo.png' id = 'login_img'>
            <div id = 'internal-div-login'>
                <p id = 'login_email' class = 'legend' >Student Email/Telephone</p>
                <input placeholder = 'Student Email/Telephone' through = 'Login_email' carry = '#login_email' id = 'login_fake'>
                <p id = 'feedback'></p>
            </div>
            <div id = 'internal-div-login'>
                <p id = 'login_password' class = 'legend' >Password</p>
                <input placeholder = 'Password' through = 'Login_password' carry = '#login_password' id = 'login_fake'>
                <p id = 'feedback'></p>
            </div>
        </form>
        <?php $form = ActiveForm::begin([
            'id' => 'login_student',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                'inputOptions' => ['class' => 'col-lg-3 form-control'],
                'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
            ],
        ]); ?>
        <?= $form->field($model, 'student_email')->textInput(['id' => 'Login_email', 'type' => 'hidden'])->label(false) ?>
        <?= $form->field($model, 'password')->textInput(['id' => 'Login_password', 'type' => 'hidden'])->label(false) ?>
        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'button-login', 'name' => 'login', 'id' => 'login']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>