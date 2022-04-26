<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'User Test';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model,'name')->textInput(['autofocus' => true]); ?>
<?= $form->field($model,'email'); ?>

<div class="form-group">
    <div class="offset-lg-1 col-lg-11">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>