<?php

use frontend\models\Countries;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use frontend\models\Cprofile;


$model= new Cprofile();
/* @var $this yii\web\View */
/* @var $model frontend\models\Cprofile */
/* @var $form ActiveForm */
?>
<div class="container-fluid cprofile topp">

<h4 class="roboto text-pink center-thing my-2">Set up your profile</h4>

	<div class="col-lg-4 roboto text-black font-15 center-thing">
    <?php $form = ActiveForm::begin([
    		'options' => ['enctype' => 'multipart/form-data']
    ]);?> 
    
    <?php echo $form->errorSummary($model) ?>

        <?= $form->field($model, 'user_id')->hiddenInput(['value'=> yii::$app->user->id])->label(false) ?>
        <?= $form->field($model, 'first_name') ?>
        <?= $form->field($model, 'last_name') ?>
        <?= $form->field($model, 'phone_code')->dropDownList(ArrayHelper::map(Countries::find()->all(), 'couPhoneCode','countryName'))?>
        <div>
        <label for="floatingInput">Phone number</label>
        </div>
        <?= $form->field($model, 'phone_number')->textInput(['placeholder' => "7XX XXX XXX"])->label(false); ?>
        <?= $form->field($model, 'id_number') ?>
		<div class="form-group">
        <label><?php echo $model->getAttributeLabel('customer_image') ?></label>
        <div class="custom-file">
            <input type="file" class="custom-file-input"
                   id="customer_image" name="customer_image">
            <label class="custom-file-label" for="customer_image">Choose picture</label>
        </div>
     </div>	    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-blue text-white']) ?>
        </div>
    <?php ActiveForm::end(); ?>
	</div>
</div><!-- cprofile -->
