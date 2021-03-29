<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Pprofile;
use frontend\models\PprofileSearch;
use yii2mod\rbac\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use frontend\models\Document;
use frontend\models\Wallet;

/**
 * PprofileController implements the CRUD actions for Pprofile model.
 */
class PprofileController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        		'access' => [
        				'class' => AccessControl::className(),
        				'only' => ['create', 'update', 'index', 'view','saveDocument', 'delete'],
        				'rules' => [
        						[
        								'actions' => ['index'],
        								'allow' => true,
        								'roles' => ['admin'],
        						],
        						[
        								'actions' => ['create', 'update', 'view', 'delete'],
        								'allow' => true,
        								'roles' => ['professional'],
        						],
        						[
        								'actions' => ['view'],
        								'allow' => true,
        								'roles' => ['?', '@'],
        						],
        				],
        		],
	            'verbs' => [
	                'class' => VerbFilter::className(),
	                'actions' => [
	                    'delete' => ['POST'],
	                ],
	            ],
        ];
    }

    /**
     * Lists all Pprofile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PprofileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pprofile model.
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
     * Creates a new Pprofile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$profile_exists = Pprofile::find()->where(['user_id' => Yii::$app->user->id])->one();
        $model = new Pprofile();
        $document = new Document();
        if($profile_exists){
        	return $this->redirect(['view', 'id' => $profile_exists->pprofile_id]);
    	}
    	$model->professional_image = UploadedFile::getInstanceByName('professional_image');
    	
    	if ($model->load(Yii::$app->request->post()) && $model->save()) {
    		//var_dump($_FILES); exit();
    		if($this->saveDocument($model->pprofile_id,Yii::$app->request->post()['Document'])){
    			if($this->createWallet()){
    			return $this->redirect(['view', 'id' => $model->pprofile_id]);
    			}
    		}
    	}
    	
    	return $this->render('create', [
    			'model' => $model,
    			'document'=>$document,
    	]);
    }
    
    /**
     *
     * @param  $pprofile_id
     * @param  $documentdata
     */
    public function saveDocument($pprofile_id, $documentdata){
    	
    	$model = new Document();
    	//var_dump($documentdata);exit();
    	if($model->load(["Document"=>['document_path'=>$documentdata['document_path']]])){
    		//generates images with unique names
    		$document_name = bin2hex(openssl_random_pseudo_bytes(10));
    		$model->document_path = UploadedFile::getInstance($model, 'document_path');
    		//saves file in the root directory
    		$model->document_path->saveAs('frontend/web/storage/pprofile/'.$document_name.'.'.$model->document_path->extension);
    		//save in the db
    		$model->document_path='frontend/web/storage/pprofile/'.$document_name.'.'.$model->document_path->extension;
    		$model->pprofile_id = $pprofile_id;
    		//var_dump($model); exit();
    		
    		if($model->save()){
    			return true;
    		}
    	}
    	return false;
    }
    
    public function createwallet(){
    	$model= new Wallet();
    	$model->userId = Yii::$app->user->id;
    	$model->currencyId = 76;
    	if($model->save()){
    		return true;
    	}
    	return false;
    }

    /**
     * Updates an existing Pprofile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pprofile_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pprofile model.
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
     * Finds the Pprofile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pprofile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pprofile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
