<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PprofileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pprofiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pprofile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pprofile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pprofile_id',
            'user_id',
            'first_name',
            'last_name',
            'phone_code',
            //'phone_number',
            //'id_number',
            //'profile_image',
            //'introduction:ntext',
            //'about:ntext',
            //'specialty_id',
            //'payment_id',
            //'location_id',
            //'address',
            //'tags',
            //'identity_doc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
