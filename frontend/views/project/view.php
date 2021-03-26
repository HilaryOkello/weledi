<?php

use common\models\User;
use frontend\models\Connect;
use frontend\models\Cprofile;
use frontend\models\Location;
use frontend\models\Project;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use frontend\models\ProjectDocs;
use frontend\models\Pprofile;

/* @var $this yii\web\View */
/* @var $model frontend\models\Project */
/* @var $connect frontend\models\Connect*/

$proj_details = Connect::find()->where(['project_id'=>$model->project_id])->joinWith('user')->all();
$proj_location = Location::find()->where(['location_id'=>$model->location_id])->one();
$proj_docs = ProjectDocs::find()->where(['project_id'=>$model->project_id])->all();
$cus_contacts = User::find()->where(['id'=>$model->user_id])->joinWith('pprofile')->one();
$cus_phone = Cprofile::find()->where(['user_id'=>$cus_contacts->id])->one();
$con_check= Connect::find()->where(['status'=>1])->andWhere(['project_id'=>$model->project_id])->one();
//var_dump($cus_phone); exit();

$this->title = $model->project_id;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<!--  <div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->project_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->project_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_id',
        	'project_title',
            'user_id',
            'brief:ntext',
            'location_id',
            'duration',
            'date',
            'created_at',
            'status',
        ],
    ]) ?>

</div>-->
    <div class="container-fluid col-lg-6 topp">
        <div class="row border my-2 box-shadow">
            <div class="col-lg-7">
            <div class="row">
                <div class="col-lg-6 my-2">
                    <h6 class="ml-3 roboto text-pink font-20"><?= $model->project_title?></h6>
                </div>
                <div class="col-lg-6 my-2">
                    <h6 class="ml-3 roboto text-black font-20"><?= $proj_location->location_name?> </h6>
                </div>
             </div>
             <div>
             	<div>
                    <h6 class="roboto font-20 text-blue ml-3 mt-3">Customer</h6>
                    <P class="roboto font-20 text-black ml-3"><?= $cus_contacts->username?>  
                    </P>
                </div>
                <div>
                    <h6 class="roboto font-20 text-blue ml-3 mt-3">Project Description</h6>
                    <P class="roboto font-20 text-black ml-3"><?= $model->brief?>  
                    </P>
                </div>
                <div class="">
                    <h6 class="ml-3 text-black roboto font-20">Due date:<?= $model->date?></h6>
                    <h6 class="ml-3 text-blue roboto font-20">Uploaded Documents/Images:</h6>
                    <?php foreach ($proj_docs as $proj_doc) {?>
                    <a class="ml-3 text-black roboto font-20 mb-2" href="<?= $proj_doc->project_docs_path?>">servicesplan.pdf</a></br>
                    <?php }?>
                </div>
             </div>
             </div>
             
             <div class="col-lg-5 my-2">
               <?php if (Yii::$app->user->can('customer')):?>
               <div>
                    <?= Html::a('Update', ['update', 'id' => $model->project_id], ['class' => 'btn btn-blue text-white']) ?>
			        <?= Html::a('Delete', ['delete', 'id' => $model->project_id], [
			            'class' => 'btn btn-pink text-white',
			            'data' => [
			                'confirm' => 'Are you sure you want to delete this item?',
			                'method' => 'post',
			            ],
			        ]) ?>
			   </div>
			   <?php elseif (Yii::$app->user->can('professional')):?>
			   <div>
			   		<button type="button" class=" my-2 text-white btn btn-pink" data-toggle="modal" data-target="#exampleModal">Get customer contacts</button>
			   		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Get customer contacts</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <h6 class=" text-black roboto font-20">Getting customer contacts will cost you 1 credit</h6>
					      </div>
					      <?php foreach ($proj_details as $proj_detail) {?>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
					        <a class="text-white my-1 btn btn-sm btn-pink roboto font-20" href="<?php echo Url::to(['/project/seecontacts','connect_id' => $proj_detail->connect_id, 'id' =>$model->project_id]) ?>">Get customer contacts</a>
					      </div>
					      <?php }?>
					    </div>
					  </div>
					</div>
                   
			   </div>
			   <?php endif; ?>
			   <?php if (!empty($con_check)):?>
			    <div>
                    <h6 class="text-blue roboto font-20">Phone number:</h6>
                    <h6 class="text-black roboto font-20">+<?= $cus_phone->phone_code?><?= $cus_phone->phone_number?></h6>
                    <h6 class="text-blue roboto font-20">Email:</h6>
                    <h6 class="text-black roboto font-20"><?= $cus_contacts->email?></h6>
                 </div>
              <?php endif; ?>
              <?php if (Yii::$app->user->can('customer')):?> 
              <div class="">
                    <h6 class=" text-black roboto font-20">Share this project with other Pros</h6>
                    <a class="text-white my-1 w-75 btn btn-sm btn-green roboto font-15" href="#">Share with other Pros</a></br>
              </div>
              <?php endif; ?>
           </div>
            </div> 
       <?php if (Yii::$app->user->can('customer')):?>                
        <div>
        <div class="my-1">
            <h6 class="roboto font-20 text-pink ml-3 mt-3">Connections on this project</h6>
        </div>
        <?php foreach ($proj_details as $proj_detail) {?>
        <div class="row border my-2 box-shadow">
            <div class="col-lg-4 my-2">
                <h6 class="ml-3 roboto text-green font-20"><?= $proj_detail->user->username?> </h6>
            </div>
            <div class="col-lg-4 my-2">
                <h6 class="ml-3 roboto text-black font-20">Juja, Kiambu </h6>
            </div>
            <div class="col-lg-4 my-2" style="float:left">
                <a class="ml-5 center-thing roboto text-blue font-20" href="connect_details.html"><i class="fas fa-angle-double-right  fa-lg"></i></a>
            </div> 
        </div>
        <?php }?>
        </div>

        <div class="my-1">
            <h6 class="roboto font-20 text-pink ml-3 mt-3">Quotes on this project</h6>
        </div>
        <div class="row border my-2 box-shadow">
            <div class="col-lg-4 my-2">
                <h6 class="ml-3 roboto text-green font-20">Wambugu plumbers </h6>
            </div>
            <div class="col-lg-4 my-2">
                <h6 class="ml-3 roboto text-black font-20">Ksh. 250,000 </h6>
            </div>
            <div class="col-lg-4 my-2" style="float:left">
                <a class="ml-5 center-thing roboto text-blue font-20" href="connect_details.html"><i class="fas fa-angle-double-right  fa-lg"></i></a>
            </div>
       	<?php elseif (Yii::$app->user->can('professional')):?>
        </div>
                <div class="container-fluid col-lg-6 my-3">
            <h6 class="mx-2 roboto font-20"> Chat with <?= $cus_contacts->username?></h6>
        </div>
        <div class="container-fluid col-lg-6 chat-box my-3 border rounded box-shadow">  
            <div class="inbox-people overflow-auto mx-2 my-3 msg_history">
              <div class="incoming_msg">
                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="received_msg">
                  <div class="received_withd_msg">
                    <p>Test which is a new approach to have all
                      solutions</p>
                    <span class="time_date"> 11:01 AM    |    June 9</span></div>
                </div>
              </div>
              <div class="outgoing_msg">
                <div class="sent_msg">
                  <p>Test which is a new approach to have all
                    solutions</p>
                  <span class="time_date"> 11:01 AM    |    June 9</span> </div>
              </div>
              <div class="incoming_msg">
                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="received_msg">
                  <div class="received_withd_msg">
                    <p>Test, which is a new approach to have</p>
                    <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
                </div>
              </div>
              <div class="outgoing_msg">
                <div class="sent_msg">
                  <p>I just wanted someone to come fix it</p>
                  <span class="time_date"> 11:01 AM    |    Today</span> </div>
              </div>
              <div class="incoming_msg">
                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="received_msg">
                  <div class="received_withd_msg">
                    <p>We work directly with our designers and suppliers,
                      and sell direct to you, which means quality, exclusive
                      products, at a price anyone can afford.</p>
                    <span class="time_date"> 11:01 AM    |    Today</span></div>
                </div>
              </div>
              <div class="outgoing_msg">
                <div class="sent_msg">
                  <p>Test which is a new approach to have all
                    solutions</p>
                  <span class="time_date"> 11:01 AM    |    June 9</span> </div>
              </div>
              <div class="incoming_msg">
                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="received_msg">
                  <div class="received_withd_msg">
                    <p>Test, which is a new approach to have</p>
                    <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
                </div>
              </div>
              <div class="outgoing_msg">
                <div class="sent_msg">
                  <p>I just wanted someone to come fix it</p>
                  <span class="time_date"> 11:01 AM    |    Today</span> </div>
              </div>
              <div class="incoming_msg">
                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="received_msg">
                  <div class="received_withd_msg">
                    <p>We work directly with our designers and suppliers,
                      and sell direct to you, which means quality, exclusive
                      products, at a price anyone can afford.</p>
                    <span class="time_date"> 11:01 AM    |    Today</span></div>
                </div>
            </div>
            </div>
            <div class="mx-2 my-2 type_msg">
              <div class="input_msg_write">
                <input type="text" class="write_msg" placeholder="Type a message" />
                <button class="msg_send_btn btn-green mx-5" type="button"><i class="fas fa-paperclip" aria-hidden="true"></i></button>
                <button class="msg_send_btn" type="button"><i class="far fa-paper-plane" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
          <?php endif; ?>
    </div>