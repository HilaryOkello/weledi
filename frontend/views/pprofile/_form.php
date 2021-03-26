<?php

use frontend\models\Countries;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;



/* @var $this yii\web\View */
/* @var $model frontend\models\Pprofile */
/* @var $document frontend\models\Document */
/* @var $form ActiveForm */

\frontend\assets\TagsInputAsset::register($this);
\frontend\assets\MultipleAsset::register($this);



?>

    <div class="">
        <div class="stepwizard center-thing">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-1" type="button" class="roboto text-black btn btn-pink btn-circle">1</a>
                    <p><small>Tell us more about yourself/business</small></p>
                </div>
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-2" type="button" class="roboto text-black btn btn-green btn-circle">2</a>
                    <p><small>Detials about your craft</small></p>
                </div>
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-3" type="button" class="roboto text-black btn btn-green btn-circle">3</a>
                    <p><small>Some more details about your craft</small></p>
                </div>
            </div>
        </div>
    	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    	    <?php echo $form->errorSummary($model) ?>
    	
            <div class="panel panel-primary setup-content border border-secondary rounded my-2" id="step-1">
                <div class="border-bottom border-secondary">
                     <h3 class="roboto center-thing my-2 text-pink font-20">Tell us more about yourself/business</h3>
                </div>
                <div class="container-fluid text-black font-15 col-lg-6 panel-body">
                        <?= $form->field($model, 'user_id')->hiddenInput(['value'=> yii::$app->user->id])->label(false) ?>

    					<?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    					<?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    					<?= $form->field($model, 'phone_code')->dropDownList(ArrayHelper::map(Countries::find()->all(), 'couPhoneCode','countryName'))?>

    					<?= $form->field($model, 'phone_number')->textInput() ?>

    					<?= $form->field($model, 'id_number')->textInput() ?>

						<div class="mb-3">
        				<label><?php echo $model->getAttributeLabel('profile_image') ?></label>
						  <input class="form-control-file btn btn-blue" type="file" id="professional_image" name="professional_image">
						</div>    					
	                     <button class="btn btn-blue nextBtn mr-auto mb-5" type="button">Next</button>
                </div> 
             </div>
            
             <div class="panel panel-primary setup-content border border-secondary rounded my-5" id="step-2">
                <div class="border-bottom border-secondary">
                     <h3 class="roboto center-thing my-2 text-pink font-20">Detials about your craft</h3>
                </div>
                <div class="container-fluid text-black font-15 col-lg-8 panel-body">
                        <?= $form->field($model, 'introduction')->textarea(['rows' => 4]) ?>

    					<?= $form->field($model, 'about', [
                'inputOptions' => ['data-role' => 'tagsinput']])->textarea(['rows' => 4]) ?>

	                    <?= $form->field($model, 'specialty')->textInput(['row' => 2])?>
	                    
    					<?= $form->field($model, 'tags', [
                'inputOptions' => ['data-role' => 'tagsinput']])->textInput(['maxlength' => true]) ?>
                     <button class="btn btn-blue nextBtn mb-5" type="button">Next</button>
                </div> 
             </div>
            
             <div class="panel panel-primary setup-content border border-secondary rounded my-5" id="step-3">
                <div class="border-bottom border-secondary">
                     <h3 class="roboto center-thing my-2 text-pink font-20">Some more details about your craft</h3>
                </div>
                <div class="container-fluid text-black font-15 col-lg-8 my-5 panel-body">
				    <!--  <div class="my-5">
				       <label>Select payment method</label>
				        <?php
				      /*   echo Select2::widget([
				        	'bsVersion' => '4.x',
				        	'model' => $model,				        		
				            'name' => 'payment',
				        	'attribute' => 'payment',
				            'data' => $payment,
				            'options' => ['placeholder' => 'Select payment method', 'multiple' => true, 'autocomplete' => 'off'],
				            'pluginOptions' => [
				                'allowClear' => true
				            ],
				        ]); */
				        ?>
				    </div>	
			<div class="form-group">
			    <label for="payment">Select your prefered payment methods</label>
				<select id="choices-multiple-remove-button payment" name="payment" placeholder="Payment methods" multiple>
		            <option value="MPESA">MPESA</option>
		            <option value="Jquery">Cash</option>
		            <option value="Bank transfer">Bank transfer</option>
		            <option value="Cheque">Cheque</option>
		            <option value="Paypal">Paypal</option>
		           
		        </select> 
		      </div>
		      <div class="form-group">
		      	<label for="location">Select locations you serve</label>
				<select id="choices-multiple-remove-button" placeholder="Select locations you serve" multiple>
		            <option value="Mombasa">Mombasa</option>
		            <option value="Kwale">Kwale</option>
		            <option value="Kilifi">Kilifi</option>
		            <option value="Tana River">Tana River</option>
		            <option value="Lamu">Lamu</option>
		            <option value="Taita-Taveta">Taita-Taveta</option>
		            <option value="Garissa">Garissa</option>
		            <option value="wajir">wajir</option>
		            <option value="Mandera">Mandera</option>
		            <option value="Marsabit">Marsabit</option>
		            <option value="Isiolo">Isiolo</option>
		            <option value="Meru">Meru</option>
		            <option value="Tharaka-Nithi">Tharaka-Nithi</option>
		            <option value="Embu">Embu</option>
		            <option value="Kitui">Kitui</option>
		            <option value="Machakos">Machakos</option>
		            <option value="Makueni">Makueni</option>
		            <option value="Nyandarua">Nyandarua</option>
		            <option value="Nyeri">Nyeri</option>
		            <option value="Kirinyaga">Kirinyaga</option>
		            <option value="Murang'a">Murang'a</option>
		            <option value="Kiambu">Kiambu</option>
		            <option value="Turkana">Turkana</option>
		            <option value="West Pokot">West Pokot</option>
		            <option value="Samburu">Samburu</option>
		            <option value="Trans-Nzoia">Trans-Nzoia</option>
		            <option value="Uasin-Gishu">Uasin-Gishu</option>
		            <option value="Elgeyo-Marakwet">Elgeyo-Marakwet</option>
		            <option value="Nandi">Nandi</option>
		            <option value="Baringo">Baringo</option>
		            <option value="Laikipia">Laikipia</option>
		            <option value="Nakuru">Nakuru</option>
		            <option value="Narok">Narok</option>
		            <option value="Kajiado">Kajiado</option>
		            <option value="Kericho">Kericho</option>
		            <option value="Bomet">Bomet</option>
		            <option value="Kakamega">Kakamega</option>
		            <option value="Vihiga">Vihiga</option>
		            <option value="Bungoma">Bungoma</option>
		            <option value="Busia">Busia</option>
		            <option value="Siaya">Siaya</option>
		            <option value="Kisumu">Kisumu</option>
		            <option value="Homa Bay">Homa Bay</option>
		            <option value="Migori">Migori</option>
		            <option value="Kisii">Kisii</option>
		            <option value="Nyamira">Nyamira</option>
		            <option value="Nairobi">Nairobi</option>
		           
		        </select> 
		      </div>-->
		      	
		            <?= $form->field($model, 'payment')->textInput(['maxlength' => true]) ?>
		      
					<?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
								      		
				    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
				    
			     	<?= $form->field($document, 'document_path')->fileInput(['class' => 'btn btn-blue text-white']) ?>
			     	
				
				<div class="form-group">
			        <?= Html::submitButton('Finish', ['class' => 'btn btn-blue text-white']) ?>
			    </div>
                </div> 
             </div>
      <?php ActiveForm::end(); ?>
    </div>
    
    <?php
        Modal::begin([
            'id'=>'addspecialty',
            'size'=>'modal-lg'
            ]);

        echo "<div id='addspecialtyContent'></div>";
        Modal::end();
       
        ?>