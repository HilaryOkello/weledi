<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cprofile */

$this->title = 'Update Profile: ' . $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Cprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cprofile_id, 'url' => ['view', 'id' => $model->cprofile_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cprofile-update center-thing">

    <h3 class="text-green roboto mt-5"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('cprofile', [
        'model' => $model,
    ]) ?>

</div>
