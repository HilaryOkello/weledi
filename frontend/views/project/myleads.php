<?php
use common\models\User;
use frontend\models\Connect;
use frontend\models\Location;
use frontend\models\Project;
use yii\helpers\Url;

 $my_leads = Connect::find()->where(['connect.user_id'=>Yii::$app->user->id])->joinWith('project')->all();


 //var_dump($cus_details); exit();
foreach ($my_leads as $my_lead) {
$proj_location = Location::find()->where(['location_id'=>$my_lead->project->location_id])->one();
$cus_detail = User::find()->where(['id'=>$my_lead->project->user_id])->joinWith('cprofile')->one();
}
?>

<div class="container-fluid col-lg-6 topp">
		<div>
		<h6 class="roboto text-black font-20"> </h6>
		</div>
        <h6 class="roboto center-thing my-3 text-black my-3 ctaction"> My Leads </h6>
        <?php foreach ($my_leads as $my_lead) {?>
        <div class="row border my-2 box-shadow">
            <div class="col-lg-3 my-3">
                <h6 class="roboto text-green font-20"><?= $my_lead->project->project_title?></h6>
            </div>
            <div class="col-lg-3 my-3">
                <h6 class="roboto text-black font-20"><?= $proj_location->location_name?></h6>
            </div>
            <div class="col-lg-3 my-3">
                <h6 class="roboto text-pink font-20" ><?= $cus_detail->cprofile->first_name?> <?= $cus_detail->cprofile->last_name?></h6>
            </div>
            <div class="col-lg-3 my-3" style="float:left">
                <a class="center-thing roboto text-blue font-20" href="<?php echo Url::to(['/project/view', 'id' => $my_lead->project_id]); ?>"><i class="fas fa-angle-double-right  fa-2x"></i></a>
            </div>
        </div>
        <?php }?>

</div>