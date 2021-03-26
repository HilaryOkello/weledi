<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cprofile */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Cprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid col-lg-6 cprofile-view">

    <h3 class="text-pink roboto my-3"> Hello, <?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cprofile_id], ['class' => 'btn btn-blue text-white']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cprofile_id], [
            'class' => 'btn btn-pink text-white',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'cprofile_id',
            //'user_id',
            'first_name',
            'last_name',
            'phone_code',
            'phone_number',
            'id_number',
            //'created_at',
        		[
        				
        				'attribute' => 'has_thumbnail',
        				
        				'label' => 'Photo',
        				'format' => ['image',['width'=>'250','height'=>'200','align'=>'left']],
        				'value' => $model->cprofile_image,
        				
        				],
        ],
    ]) ?>

</div>
