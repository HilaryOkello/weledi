<?php
use frontend\models\Location;
use frontend\models\Project;
use yii\helpers\Url;

 $my_projects = Project::find()->where(['project.user_id'=>Yii::$app->user->id])->all();


 //var_dump($cus_details); exit();
foreach ($my_projects as $my_project) {
$proj_location = Location::find()->where(['location_id'=>$my_project->location_id])->one();
}
?>

<div class="container-fluid col-lg-6 topp">
		<div>
		<h6 class="roboto text-black font-20"> </h6>
		</div>
        <h6 class="roboto center-thing my-3 text-black my-3 ctaction"> My Projects </h6>
        <?php foreach ($my_projects as $my_project) {?>
        <div class="row border my-2 box-shadow">
            <div class="col-lg-3 my-3">
                <h6 class="roboto text-green font-20"><?= $my_project->project_title?></h6>
            </div>
            <div class="col-lg-3 my-3">
                <h6 class="roboto text-black font-20"><?= $proj_location->location_name?></h6>
            </div>
            <div class="col-lg-3 my-3">
                <h6 class="roboto text-pink font-20" ><?= $my_project->date ?></h6>
            </div>
            <div class="col-lg-3 my-3" style="float:left">
                <a class="center-thing roboto text-blue font-20" href="<?php echo Url::to(['/project/view', 'id' => $my_project->project_id]); ?>"><i class="fas fa-angle-double-right  fa-2x"></i></a>
            </div>
        </div>
        <?php }?>

</div>