<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Emails\Emails */

$this->title = 'Update Emails: ' . $model->email_id;
$this->params['breadcrumbs'][] = ['label' => 'Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email_id, 'url' => ['view', 'email_id' => $model->email_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="emails-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
