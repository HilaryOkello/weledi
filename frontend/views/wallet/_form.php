<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wallet */
/* @var $form yii\bootstrap4\\ActiveForm */
?>

<div class="wallet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->hiddenInput(['value'=> yii::$app->user->id])->label(false)?>

    <?= $form->field($model, 'currencyId')->hiddenInput(['value'=>76])->label(false)?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
