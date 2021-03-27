<?php

use frontend\models\Wallet;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Countries;

/* @var $this yii\web\View */
/* @var $model frontend\models\Deposit */
/* @var $form yii\widgets\ActiveForm */

$wallet = Wallet::find()->where(['userId' => yii::$app->user->id]) ->one();
?>

<div class="deposit-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'walletId')->hiddenInput(['value'=> $wallet->walletId])->label(false)?>

    <?= $form->field($model, 'transAmount')->textInput() ?>
    
    <?= $form->field($model, 'phoneCode')->dropDownList(ArrayHelper::map(Countries::find()->all(), 'couPhoneCode','countryName'))?>
    
    <?= $form->field($model, 'mpesaNumber')->textInput() ?>
    
    <?= $form->field($model, 'details')->hiddenInput(['value'=> 'buy credits'])->label(false)?>

    <?= $form->field($model, 'createdBy')->hiddenInput(['value'=> yii::$app->user->id])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
