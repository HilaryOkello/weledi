<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ProSignupForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

?>
<div class="container site-signup topp">
    <h1 class="roboto text-pink center-thing">Sign up</h1>

    <p class="roboto text-black font-20 center-thing my-3">Please fill out the following fields to signup:</p>

    <div class="center-thing container-fluid col-lg-4">
        <div class="text-black font-15 roboto center-things ">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Professional name') ?>

                <?= $form->field($model, 'email') ?>
                
                <?= $form->field($model, 'user_type')->hiddenInput(['value'=> 'professional'])->label(false); ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-blue text-white my-3', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

