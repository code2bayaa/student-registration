<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Emails\EmailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emails-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Emails', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'email_id:email',
            'receiver_name',
            'receiver_email:email',
            'subject',
            'content:ntext',
            //'attatchment',
            //'time',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Emails $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'email_id' => $model->email_id]);
                 }
            ],
        ],
    ]); ?>


</div>
