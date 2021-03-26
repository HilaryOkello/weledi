<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cprofile */

$this->title = 'Create Cprofile';
$this->params['breadcrumbs'][] = ['label' => 'Cprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cprofile-create  container-fluid col-lg-8">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('cprofile', [
        'model' => $model,
    ]) ?>

</div>
