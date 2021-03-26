<?php
/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use frontend\models\Cprofile;
use frontend\models\Pprofile;
use frontend\models\Wallet;
use yii\bootstrap4\Alert;
use yii\bootstrap4\Modal;

$pprofile= Pprofile::find()->where(['user_id'=>Yii::$app->user->id])->one();
$pprofile= Cprofile::find()->where(['user_id'=>Yii::$app->user->id])->one();
$wallet = Wallet::find()->where(['userId' => yii::$app->user->id]) ->one();
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- my custom CSS -->	
    <link rel="stylesheet" href="custom.css">
    <!-- Fontawesome cdn -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid col-lg-10"> 
        <a class="navbar-brand" href="<?php echo Url::base();?>/index.php"><img src="<?php echo Url::base();?>/css/images/weledi.svg" alt="weledi" width="100" height="40"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <?php if(Yii::$app->user->isGuest): ?>
        <div class="collapse navbar-collapse" id="navbarNav">
        <form action="<?php echo Url::to(['/site/search'])?>" method="GET" novalidate="novalidate" class="mx-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12 p-0">
                            <input type="text" class="form-control" placeholder="What service do you need" name="keyword" value="<?php echo Yii::$app->request->get('keyword') ?>">
                        </div>
                        <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                            <input type="text" class="form-control" placeholder="Location" name="location" value="<?php echo Yii::$app->request->get('location') ?>">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                            <button type="submit" class="btn btn-blue text-white roboto">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link nav-text roboto font-20 btn btn-green btn-sm" aria-current="page" href="<?php echo Url::to(['/site/pro-signup']) ?>">Join as Pro</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link nav-text roboto font-20" href="<?php echo Url::to(['/site/signup']) ?>">Sign Up</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link nav-text roboto font-20" href="<?php echo Url::to(['/site/login']) ?>">Sign in</a>
            </li>            
        </ul>
        </div>
        <?php elseif (Yii::$app->user->can('customer')):?>
        <div class="collapse navbar-collapse" id="navbarNav">
        <form action="<?php echo Url::to(['/site/search'])?>" method="GET" novalidate="novalidate" class="mx-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12 p-0">
                            <input type="text" class="form-control" placeholder="What service do you need" name="keyword" value="<?php echo Yii::$app->request->get('keyword') ?>">
                        </div>
                        <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                            <input type="text" class="form-control" placeholder="Location" name="location" value="<?php echo Yii::$app->request->get('location') ?>">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                            <button type="submit" class="btn btn-blue text-white roboto">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link nav-text btn btn-green btn-sm roboto font-20" aria-current="page" href="my_projects.html">My projects</a>
            </li>
            <li class="nav-item active dropdown mx-3">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell fa-2x"></i></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Message 1</a>
                    <a class="dropdown-item" href="#">Message 2</a>
                    <a class="dropdown-item" href="#">Message 3</a>
                  </div>
            </li>
            <li class="nav-item active dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-user-circle fa-2x"></i></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="<?php 
                  if(empty($cprofile)){
                  	echo "#";
                  } else { echo Url::to(['/cprofile/view', 'id' => $cprofile->cprofile_id]);} ?>">Profile</a>
                  <a class="dropdown-item" data-method="POST" href="<?php echo Url::to(['/site/logout']) ?>">Log out</a>
                </div>          
            </li>
        </ul>
        </div>
        <?php elseif (Yii::$app->user->can('professional')):?>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto mx-2">
            <li class="nav-item active mx-2">
                <button class="nav-link nav-text roboto font-20 btn btn-green btn-sm text-white deposit" baseUrl="<?= Yii::$app->request->baseUrl?>" type="button">Buy credits</button>
            </li>
            <li class="nav-item active mx-2">
                <a class="nav-link nav-text roboto font-20 btn btn-blue btn-sm text-white" aria-current="page" href="#"><?php echo $wallet->balance ?> credits</a>
            </li>
           
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link nav-text roboto font-20 btn btn-green btn-sm" aria-current="page" href="<?php echo Url::to(['/project/myleads']) ?>">My Leads</a>
            </li>
            <li class="nav-item active dropdown mx-3">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell fa-2x"></i></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Message 1</a>
                    <a class="dropdown-item" href="#">Message 2</a>
                    <a class="dropdown-item" href="#">Message 3</a>
                  </div>
            </li>
            <li class="nav-item active dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-user-circle fa-2x"></i></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="<?php 
                  if(empty($pprofile)){
                  	echo "#";
                  } else { echo Url::to(['/pprofile/view', 'id' => $pprofile->pprofile_id]);} ?>">Profile</a>
                  <a class="dropdown-item" data-method="POST" href="<?php echo Url::to(['/site/logout']) ?>">Log out</a>
                </div>          
            </li>
        </ul>
        </div>
        <?php endif; ?>
    </div>
  </nav>
 

    <div class="topp">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
	<div class="container-fluid col-lg-10 row" style="display: flexbox; justify-content:center; margin:auto;">
				<div class="col-lg-3 col-md-3 col-sm-12">                   
          <a href="index.html" class="Header-logo"> <img src="<?php echo Url::base();?>/css/images/weledi.svg" alt="weledi"></a>
          <h6>is a leading online service</br> that connects customers with professionals </br>for their projects</h6>
        </div>
				<div class="col-lg-3 col-md-3 col-sm-12">
					<ul>
					<li><a class="text-black" href="story.html">Our story</a></li>
					<li><a class="text-black" href="media.html">Media</a></li>
          <li><a class="text-black" href="sustainability.html">Sustainability</a></li>
					<li><a class="text-black" href="faqs.html">FAQS</a></li>

					</ul>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12">
					<ul>
          <li><a class="text-black" href="support.html">Weledi Support</a></li>
					<li><a class="text-black" href="tou.html">Term of use</a></li>
					<li><a class="text-black" href="policy.html">Privacy policy</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12">				
					<ul>
          <li><h6>Social media</h6></li>
          <li><a class="text-black" href="https://facebook.com"><i class="fab fa-facebook-square"></i> Facebook</a></li>
          <li><a class="text-black" href="https://instagram.com"><i class="fab fa-instagram"></i> Instagram</a></li>
          <li><a class="text-black" href="https://twitter.com"><i class="fab fa-twitter-square"></i> Twitter</a></li>
					</ul>
				</div>
				<br>
				<div style="display: flexbox; justify-content:center; margin:auto; text-align:center;padding-top:10px;"><p>© Hilary Onyango Okello 2021 All rights reserved</p></div>
	</div>
</footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    
    <?php Modal::begin([
            'id'=>'deposit',
            'size'=>'modal-lg'
            ]);

        echo "<div id='depositContent'></div>";
        Modal::end(); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php Modal::begin([
            'id'=>'deposit',
            'size'=>'modal-lg'
            ]);

        echo "<div id='depositContent'></div>";
        Modal::end(); ?>
