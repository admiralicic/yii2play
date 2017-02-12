<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\ArrayHelper;
use \common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearchfr */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'username',
            [
                'attribute' => 'email',
                'format' => 'email',
                'enableSorting' => true
            ],
            'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model, $index, $widget) {
                    return Html::checkbox('status', $model->status, ['value' => $index, 'disabled' => false]);
                }
            ],
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::activeDropDownList($model, 'username',
                        ArrayHelper::map(User::find()->all(), 'username', 'username'),
                        [
                            'class' => 'form-control',
                            'onchange' => 'alert("change ' . $model->username . '")',


                        ]);
                },
                'filter' => ArrayHelper::map(User::find()->all(), 'username', 'username')

            ],
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'created_at:datetime',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'layout' => '{summary}{items}{pager}'
    ]); ?>

</div>
