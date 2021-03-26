<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Deposit;
use common\xyz\MpesaApi;
use frontend\models\DepositSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Mpesastkrequests;

/**
 * DepositController implements the CRUD actions for Deposit model.
 */
class DepositController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Deposit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepositSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Deposit model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Deposit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionDeposit()
    {
    	$model = new \frontend\models\Deposit();
    	
    	if (\Yii::$app->request->post()) {
    		$response = $this->pay(\Yii::$app->request->post()['Deposit']);
    		$this->processRespose($response,\Yii::$app->request->post());
    	}
    	
    	return $this->renderAjax('deposit', [
    			'model' => $model,
    	]);
    }
    
    public function pay($postData){
    	$mpesa_api = new MpesaApi();
    	// var_dump($postData); exit();
    	$TransactionType = 'CustomerPayBillOnline';
    	$Amount = $postData['transAmount'];
    	$PhoneNumber = $postData['phoneCode'].$postData['mpesaNumber'];
    	$PartyA = $postData['phoneCode'].$postData['mpesaNumber'];
    	$PartyB = 174379;
    	//   $UserId = $postData['userId'];
    	$CallBackURL = "https://5dbf04d17a7c.ngrok.io/weledi/xyz/confirm?token=KUstudents51234567qwerty";
    	$AccountReference =  $postData['details'];
    	$TransactionDesc = $postData['details'];
    	
    	
    	
    	$configs = array(
    			'AccessToken' => $this->generateToken(),
    			'Environment' => 'sandbox',
    			'Content-Type' => 'application/json',
    			'Verbose' => 'true',
    	);
    	
    	$api = 'stk_push';
    	$LipaNaMpesaPasskey= 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    	$timestamp ='20'.date("ymdhis");
    	$BusinessShortCode = 174379;
    	
    	$parameters = array(
    			'BusinessShortCode' => $BusinessShortCode,
    			'Password' => base64_encode($BusinessShortCode.$LipaNaMpesaPasskey.$timestamp),
    			'Timestamp' => $timestamp,
    			'TransactionType' => $TransactionType,
    			'Amount' => $Amount,
    			'PartyA' => $PartyA,
    			'PartyB' => $PartyB,
    			'PhoneNumber' =>$PhoneNumber,
    			'CallBackURL' => $CallBackURL,
    			'AccountReference' => $AccountReference,
    			'TransactionDesc' => $TransactionDesc,
    	);
    	
    	$response = $mpesa_api->call($api, $configs, $parameters);
    	return $response;
    }
    
    public function processRespose($response,$postData) {
    	$model = new \frontend\models\Deposit();
    	
    	if (array_key_exists('errorCode', $response['Response'])) {
    		
    		$model->load($postData);
    		$model->save();
    		$Msg = '<div class="alert alert-danger alert-dismissable" role="alert">
					<h3>THE FOLLOWING ERROR HAS ACCURED WHILE TRYING TO PROCESS YOUR REQUEST</h3>
					 <h5> ERROR CODE: '.$response['Response']['errorCode'].'</h5>
					 <h6>'.$response['Response']['errorMessage'].'</h6><h6>For more information Please Contact Support Via: 0718304785</h6>
					</div>';
    		\Yii::$app->session->setFlash('error', $Msg);
    		$this->redirect(['site/index']);
    	}else{
    		$model->load($postData);
    		if (array_key_exists('MerchantRequestID', $response['Response'])) {
    			$model->MerchantRequestId = $response['Response']['MerchantRequestID'];
    			
    			$this->saveRequestData($response,$postData['Deposit']['walletId']);
    			
    			$Msg = '<div class="alert alert-success alert-dismissable" role="alert">
						  	<h5> '.$response['Response']['CustomerMessage'].'</h5>
						  </div>';
    			\Yii::$app->session->setFlash('success', $Msg);
    		}
    		$model->save();
    		$this->redirect(['site/index']);
    	}
    	
    }
    
    public function saveRequestData($response,$walletId){
    	
    	$model = new Mpesastkrequests();
    	
    	$model->amount = $response['Parameters']['Amount'];
    	$model->phone = $response['Parameters']['PhoneNumber'];
    	$model->reference = $response['Parameters']['AccountReference'];
    	$model->description = $response['Parameters']['TransactionDesc'];
    	$model->CheckoutRequestID = $response['Response']['CheckoutRequestID'];
    	$model->MerchantRequestID = $response['Response']['MerchantRequestID'];
    	$model->walletId = $walletId;
    	$model->userId = \yii::$app->user->Id;
    	
    	$model->save();
    	
    	return $model;
    	
    }
    
    private function generateToken(){
    	
    	$mpesa_api = new MpesaApi();
    	
    	$configs = array(
    			'Environment' => 'sandbox',
    			'Content-Type' => 'application/json',
    			'Verbose' => '',
    	);
    	
    	$api = 'generate_token';
    	
    	$parameters = array(
    			'ConsumerKey' => 'GqLqQNDloUvQIkXy1nBlXEDtg5ZPbXmd',
    			'ConsumerSecret' => 'hUxG3O6v0eU9Q9OG',
    	);
    	
    	$response = $mpesa_api->call($api, $configs, $parameters);
    	return $response['Response']['access_token'];
    	
    }

    /**
     * Updates an existing Deposit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->transId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Deposit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Deposit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Deposit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deposit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
