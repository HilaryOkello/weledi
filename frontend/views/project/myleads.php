<?php
use common\models\User;
use frontend\models\Connect;
use frontend\models\Location;
use frontend\models\Project;
use yii\helpers\Url;

 $my_leads = Connect::find()->where(['user_id'=>Yii::$app->user->id])->all();
 foreach ($my_leads as $my_lead) {
 $details = Project::find()->where(['project_id'=>$my_lead->project_id])->joinWith('user')->all();
 }
 foreach ($details as $detail) {
 $cus_details = User:: find()->where(['id'=>$detail->user_id])->joinWith('cprofile')->all();
 }
 //var_dump($cus_details); exit();
 $proj_location = Location::find()->where(['location_id'=>$detail->location_id])->one();
?>

<div class="container-fluid col-lg-6 topp">
        <h6 class="roboto center-thing my-3 text-black my-3 ctaction"> My Leads </h6>
        <?php foreach ($details as $detail) {?>
        <?php foreach ($cus_details as $cus_detail) {?>
        <div class="row border my-2 box-shadow">
            <div class="col-lg-3 my-3">
                <h6 class="roboto text-green font-20"><?= $detail->project_title?>  </h6>
            </div>
            <div class="col-lg-3 my-3">
                <h6 class="roboto text-black font-20"><?= $proj_location->location_name?> </h6>
            </div>
            <div class="col-lg-3 my-3">
                <h6 class="roboto text-pink font-20" ><?= $cus_detail->cprofile->first_name?> <?= $cus_detail->cprofile->last_name?></h6>
            </div>
            <div class="col-lg-3 my-3" style="float:left">
                <a class="center-thing roboto text-blue font-20" href="<?php echo Url::to(['/project/view', 'id' => $detail->project_id]); ?>"><i class="fas fa-angle-double-right  fa-2x"></i></a>
            </div>
        </div>
        <?php }?>
        <?php }?>
</div>