<?php

use frontend\models\Pprofile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pprofile */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Pprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$pusername = Pprofile::find()->where(['user_id'=> $model->user_id])->joinWith('user')->one();

\yii\web\YiiAsset::register($this);
?>
<!-- <div class="pprofile-view topp">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pprofile_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pprofile_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pprofile_id',
            'user_id',
            'first_name',
            'last_name',
            'phone_code',
            'phone_number',
            'id_number',
            'profile_image',
            'introduction:ntext',
            'about:ntext',
            'specialty',
            'payment',
            'location',
            'address',
            'tags',
        ],
    ]) ?> 

</div>-->

    <div class="container-fluid col-lg-8 topp border">
            <div class="row border-bottom">
                <div class="col-lg-3">
                        <img src="<?php echo $model->profile_image?>" class="rounded ml-2" alt="logo" width="200" height="200">
                </div>
                <div class="col-lg-6 col-sm-12 left-thing">
                    <a class="roboto text-pink font-20" aria-current="page" href="pro_details.html"><?php echo $pusername->user->username ?> </a>
                    <h6 class="roboto font-15 text-green">Verified</h6>
                    <h6 class="roboto font-15">Serves the <?php echo $model->location ?> area</h6>
                    <h6 class="roboto font-15">Prefered payment methods: <?php echo $model->payment ?></h6>
                    <h6 class="roboto font-15"><?php echo $model->first_name ?> <?php echo $model->last_name ?></h6>
                    <h6 class="roboto font-15">+<?php echo $model->phone_code?> <?php echo $model->phone_number?></h6>
                    <h6 class="roboto font-15">Address: <?php echo $model->address ?></h6>
                    <h6 class="roboto font-15">Keywords: <?php echo $model->tags ?></h6>

                </div>
            	<div class="col-lg-3">
            		<?php if(Yii::$app->user->can('customer')): ?>
                	<a class="text-black btn btn-sm btn-green btn-sm roboto font-15 my-3 w-100" aria-current="page" href="<?php echo Url::to(['/project/create', 'user_id'=>$model->user->id, 'username'=>$pusername->user->username])?>">Connect with Pro</a>
                	<a class="text-black btn btn-sm btn-blue btn-sm roboto font-15 my-3 w-100" aria-current="page" href="#">Get a quote</a>
                	<?php else: ?>
       					 <!-- <?= Html::a('Update', ['update', 'id' => $model->pprofile_id], ['class' => 'btn btn-blue']) ?>
       					 <?= Html::a('Delete', ['delete', 'id' => $model->pprofile_id], [
            							'class' => 'btn btn-pink',
            							'data' => [
              								  'confirm' => 'Are you sure you want to delete this item?',
              								  'method' => 'post',
            								],
       								]) ?>-->
       				<?php endif; ?>				
            </div> 
         	</div>
            <div class="row">
            <div class="col-lg-10">
            <div class="border-botom">
            <div>
                <h6 class="roboto font-20 text-pink ml-3 mt-3">About</h6>
                <P class="roboto font-15 text-black ml-3"><?php echo $model->about ?></P>
            </div>
            <div>
                <h6 class="roboto font-20 text-pink ml-3 mt-3">Introduction</h6>
                <P class="roboto font-15 text-black ml-3"><?php echo $model->introduction ?></P>
            </div>
            <div>
                <h6 class="roboto font-20 text-pink ml-3 mt-3">Specialty</h6>
                <P class="roboto font-15 text-black ml-3"><?php echo $model->specialty ?></P>
            </div>
            </div>  
            <div>
                <h6 class="roboto font-20 text-pink ml-3 mt-3">Reviews</h6>
                <div class="border-bottom mt-2">
                    <h6 class="roboto font-20 text-black ml-3">John Doe</h6>
                    <h6 class="roboto font-20 ml-3">
                        <span class="fa fa-star fa-sm checked"></span>
                        <span class="fa fa-star fa-sm checked"></span>
                        <span class="fa fa-star fa-sm checked"></span>
                        <span class="fa fa-star fa-sm"></span>
                        <span class="fa fa-star fa-sm"></span> 3/5
                    </h6>
                    <P class="roboto font-15 text-black ml-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget tempor purus. 
                        Phasellus sed fringilla tortor. 
                    </P>
                </div>
                <div class="border-bottom mt-2">
                    <h6 class="roboto font-20 text-black ml-3">John Doe</h6>
                    <h6 class="roboto font-20 ml-3">
                        <span class="fa fa-star fa-sm checked"></span>
                        <span class="fa fa-star fa-sm checked"></span>
                        <span class="fa fa-star fa-sm checked"></span>
                        <span class="fa fa-star fa-sm"></span>
                        <span class="fa fa-star fa-sm"></span> 3/5
                    </h6>
                    <P class="roboto font-15 text-black ml-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget tempor purus. 
                        Phasellus sed fringilla tortor. 
                    </P>
                </div>
                <div class="border-bottom mt-2">
                    <h6 class="roboto font-20 text-black ml-3">John Doe</h6>
                    <h6 class="roboto font-20 ml-3">
                        <span class="fa fa-star fa-sm checked"></span>
                        <span class="fa fa-star fa-sm checked"></span>
                        <span class="fa fa-star fa-sm checked"></span>
                        <span class="fa fa-star fa-sm checked"></span>
                        <span class="fa fa-star fa-sm"></span> 4/5
                    </h6>
                    <P class="roboto font-15 text-black ml-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget tempor purus. 
                        Phasellus sed fringilla tortor. 
                    </P>
                </div>
            </div>
            </div>
            <div class="col-lg-2"></div> 
            </div>
        
    </div>
