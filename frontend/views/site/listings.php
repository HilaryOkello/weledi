<?php 
use yii\helpers\Url;

/** @var $dataProvider \yii\data\ActiveDataProvider */


?>

    <div class="container-fluid row col-lg-10 topp center-thing">
            <nav id="" class=" col-lg-3 d-md-block bg-light sidebar collapse show">
                <button class="btn btn-pink roboto text-white font-20 w-100" data-toggle="collapse" data-target="#demo" >Filter By:</button>
                <div id="demo" class="collapse">
                <form>
                    <select class="form-control search-slt roboto font-20" id="exampleFormControlSelect1">
                        <option>Property Type</option>
                        <option>Single family home</option>
                        <option>Apartment building</option>
                        <option>Commercial building</option>
                        <option>Institutional building</option>
                    </select>
                    <select class="form-control search-slt roboto font-20" id="exampleFormControlSelect1">
                        <option>Experience</option>
                        <option>Less than 2yrs</option>
                        <option>2yrs-5yrs</option>
                        <option>5yrs-10yrs</option>
                        <option>More than 10 yrs</option>
                        <option>No experience</option>
                    </select>
                <div class="">
                    <button class="btn btn-green roboto font-20 w-100">Filter</button>
                </div>
                <div class="">
                    <button class="btn btn-blue roboto font-20 w-100">Reset</button>
                </div>
                </form>
                </div>
            </nav>
        
        <div class="col-lg-9">
            <?php foreach ($dataProvider->models as $listing) {?>
            <div class="row border rounded box-shadow my-1">
                <div class="row col-lg-9 col-sm-12">
                    <div class="col-lg-3">
                          <img src="<?= $listing->profile_image ?>" class="rounded" alt="logo" width="150" height="150">
                    </div>
                    <div class="col-lg-9 col-sm-12 left-thing">
                        <a class="roboto text-pink font-20" aria-current="page" href="<?php echo Url::to(['/pprofile/view', 'id' => $listing->pprofile_id]) ?>"><?= $listing->user->username?></a>
                        <h6 class="roboto font-15 text-green">Verified</h6>
                        <h6 class="roboto font-15">Serves the <?= $listing->location?> area</h6>
                        <h6 class="roboto font-15">50 projects completed</h6>
                        <h6 class="roboto font-15">Preferred payment methods: <?= $listing->payment?></h6>

                    </div>
                </div>
                <div class="col-lg-3">
                    <a class="text-white btn btn-sm btn-green btn-sm roboto font-15 my-3 w-100" aria-current="page" href="<?= Url::to(['/project/create', 'user_id'=>$listing->user->id, 'username'=>$listing->user->username])?>" data-method="post">Connect with Pro</a>
                    <a class="text-white btn btn-sm btn-blue btn-sm roboto font-15 my-3 w-100" aria-current="page" href="<?= Url::to(['/project/get_quote'])?>">Get a quote</a>
                </div>
                
            </div>
            <?php }?>
        </div>
        </div>