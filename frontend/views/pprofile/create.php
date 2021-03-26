<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pprofile */
/* @var $document frontend\models\Document */


$this->title = 'Create Profile';
?>
<div class=" container-fluid col-lg-8 pprofile-create">

    <h4 class="my-3"><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    	'document'=>$document,
    ]) ?>

</div>
