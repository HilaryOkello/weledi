<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Project;
use frontend\models\Connect;
use frontend\models\ProjectDocs;
use frontend\models\Wallet;
use frontend\models\projectSearch;
use yii2mod\rbac\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        		'access' => [
        				'class' => AccessControl::className(),
        				'only' => ['create', 'update', 'index', 'view'],
        				'rules' => [
        						[
        								'actions' => ['index', 'view'],
        								'allow' => true,
        								'roles' => ['admin'],
        						],
        						[
        								'actions' => ['create', 'update', 'view'],
        								'allow' => true,
        								'roles' => ['customer','professional'],
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new projectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionMyleads()
    {
    	
    	return $this->render('myleads');
    }

    /**
     * Displays a single Project model.
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
    
    public function actionSeecontacts($connect_id, $id){
    	$model = $this->findModel($id);
    	$credit = Wallet::find()->where(['user_id'=> Yii::$app->user->id])->one();
    	if ($credit>=1){
    	$command = \Yii::$app->db->createCommand('UPDATE connect SET status=1 WHERE connect_id='.$connect_id);
    	$command->execute();
    	return $this->redirect(['view','id' => $model->project_id,
    			
    	]);}
    	return false;
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($user_id, $username)
    {
        $model = new Project();
        $project_docs = new ProjectDocs();
        $connect = new Connect();
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	if($this->saveProjectDocs($model->project_id,Yii::$app->request->post()['ProjectDocs'])){
        		if($this->actionConnect($model->project_id, $user_id)){
        		return $this->redirect(['view', 'id' => $model->project_id]);
        		}
        	}
        }

        return $this->render('create', [
            'model' => $model,
        	'project_docs'=>$project_docs,
        	'username'=> $username,
        	'connect'=>$connect,
        ]);
    }

    
    /**
     *
     * @param  $project_id
     * @param  $project_docsdata
     */
    public function saveProjectDocs($project_id, $project_docsdata){
    	
    	$model = new ProjectDocs();
    	//var_dump($project_docsdata); exit();
    	if($model->load(["ProjectDocs"=>['project_docs_path'=>$project_docsdata['project_docs_path']]])){
    		//generates images with unique names
    		$project_docs_name = bin2hex(openssl_random_pseudo_bytes(10));
    		$model->project_docs_path = UploadedFile::getInstances($model, 'project_docs_path');
    		foreach ($model->project_docs_path as $file){
    		//saves file in the root directory
    		$file->saveAs('frontend/web/storage/project/'.$project_docs_name.'.'.$file->extension);
    		
    		//save in the db
    		$model->project_docs_path='frontend/web/storage/project/'.$project_docs_name.'.'.$file->extension;
    		
    		}
    		$model->project_id = $project_id;
    		//var_dump($model);
    		
    		if($model->save()){
    			return true;
    		}
    	}
    	return false;
    }
    
    public function actionConnect($project_id, $user_id)
    {
    	$model = new Connect();
    	$model->project_id=$project_id;
    	$model->user_id=$user_id;
    	$check=Connect::find()->where(['user_id'=> $user_id])->andWhere(['project_id'=>$project_id])->all();
    	if(empty($check)){
    		if($model->save()){
    			return true;
    		}
    
    	}
    	return false;
    }
    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->project_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
