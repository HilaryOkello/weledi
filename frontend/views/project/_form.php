<?php

use frontend\models\Location;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use buibr\datepicker\DatePicker;


/* @var $this yii\web\View */
/* @var $model frontend\models\Project */
/* @var $project_docs frontend\models\ProjectDocs */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="project-form">

<div class="col-lg-4 roboto text-black font-15 center-thing">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	
	<?= $form->field($model, 'project_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value'=> yii::$app->user->id])->label(false)?>

    <?= $form->field($model, 'brief')->textarea(['rows' => 4])->label('Give a brief description of your project')  ?>

    <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->all(), 'location_id','location_name'))->label('What is your project location')  ?>

    <?= $form->field($model, 'duration')->textInput(['maxlength' => true])->label('Approximate time to complete project in hours/days') ?>

    <?= $form->field($model, 'date')->widget(
    DatePicker::className(), [
        'addon' => false,
        'size' => 'sm',
        'clientOptions' => [
            'format' => 'L',
            'stepping' => 30,
        ],
    ])->label('When is your project due to start')  ?>
    
    <?= $form->field($project_docs, 'project_docs_path[]')->fileInput(['multiple' => true,'class' => 'btn btn-blue text-white']) ->label('Upload relevant documents/images e.g sketches') ?>

   <!-- <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-blue text-white']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

    

</div>
