  <?php 
  
  use yii\helpers\Url;

?>
   
    <!-- Call to action section-->
    <div>
    <div class="painting-img">
      <div class="container">
				<p class="landing-slogan text-white">When you want to realize your project,<br>
        Weledi is always there  <br>
				to give you a hand.</p>
        <p class="ctaction text-white">Find professionals in your area now</p>
      </div>

      	<!--  Search Bar -->	
      <section class="search-sec sticky-top center-thing">
        <div class="container col-lg-6">
            <form action="<?php echo Url::to(['/site/search'])?>" method="GET" novalidate="novalidate">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-7 col-md-6 col-sm-12 p-0">
                                <input type="search" class="form-control search-slt" placeholder="What service do you need" name="keyword" value="<?php echo Yii::$app->request->get('keyword') ?>">
                            </div>
                            <div class="col-lg-3 col-md-2 col-sm-12 p-0">
                                <input type="text" class="form-control search-slt" name="location" placeholder="location" value="<?php echo Yii::$app->request->get('location') ?>">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <button type="submit" class="btn roboto font-20 wrn-btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <div class="container center-thing">
      <p class="landing-slogan text-white">Join us today</p>
      <a class=" roboto font-20 text-black btn btn-green btn-sm center-thing" style="width:10%" aria-current="page" href="sign_up.html">Sign Up</a>
    </div>
    </div>

    <!-- End Call to action section-->


    <!-- What we do section -->
    <div class="container-fluid col-lg-10" style="padding-bottom: 100px; padding-top: -500px;">
      <div>
          <p class="ctaction text-black">Popular Services in your area</p>
        </div>
      <div class="row services-l">
        <div class="col-lg-3 col-sm-3 center-thing">
          <img class="img-size" src="<?php echo Url::base();?>/css/images/cleaning.svg" alt="Card image cap">
          <div class="explore-cust">
          <a href="listing.html" class="text-black landing-slogan">Cleaning</a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-3 center-thing">
          <img class="img-size" src="<?php echo Url::base();?>/css/images/photographer.svg" alt="Card image cap">
          <div class="explore-cust">
          <a href="listing.html" class="text-black landing-slogan">Photography</a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-3 center-thing">
          <img class="img-size" src="<?php echo Url::base();?>/css/images/repair.svg" alt="Card image cap">
          <div class="explore-cust">
          <a href="listing.html" class="text-black landing-slogan">Home repair</a>
          </div>
        </div>
        <div class="col-lg-3 col-sm-3 center-thing">
          <img class="img-size" src="<?php echo Url::base();?>/css/images/videographer.svg" alt="Card image cap">
          <div class="explore-cust">
          <a href="listing.html" class="text-black landing-slogan">Videographer</a>
          </div>
        </div>
      </div>
      </div>
    </div>