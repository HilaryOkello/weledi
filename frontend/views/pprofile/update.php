<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pprofile */

$this->title = 'Update Pprofile: ' . $model->pprofile_id;
$this->params['breadcrumbs'][] = ['label' => 'Pprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pprofile_id, 'url' => ['view', 'id' => $model->pprofile_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pprofile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
