<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Specialty */
/* @var $form yii\bootstrap4\ActiveForm */
?>
<div class="brand">

    <?php $form = ActiveForm::begin([
            'action' =>['pprofile/addspecialty'],
            'method'=>'post',
            'id'=>'adda'
        ]); ?>

        <?= $form->field($model, 'specialty_name') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Add', ['class' => 'btn btn-blue text-white btn-sm']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- addbrand -->