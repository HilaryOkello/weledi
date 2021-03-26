<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Project */
/* @var $username frontend\models\Project */
/* @var $project_docs frontend\models\ProjectDocs */


$this->title = 'Create Project';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create center-thing">

    <h4 class="text-pink my-3" > Connect with <?= $username ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    	'username' => $username,
    	'project_docs'=>$project_docs,
    ]) ?>

</div>
