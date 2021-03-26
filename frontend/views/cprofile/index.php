<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CprofileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cprofiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cprofile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cprofile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cprofile_id',
            'user_id',
            'first_name',
            'last_name',
            'phone_code',
            //'phone_number',
            //'id_number',
            //'created_at',
            //'cprofile_image',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
