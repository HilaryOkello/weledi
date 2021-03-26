<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Connect */
/* @var $form ActiveForm */
?>
<div class="connect">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'project_id') ?>
        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'created_at') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- connect -->
