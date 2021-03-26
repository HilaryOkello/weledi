<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Cprofile;
use frontend\models\CprofileSearch;
use yii2mod\rbac\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * CprofileController implements the CRUD actions for Cprofile model.
 */
class CprofileController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        		'access' => [
        				'class' => AccessControl::className(),
        				'only' => ['create', 'update', 'index'],
        				'rules' => [
        						[
        								'actions' => ['index'],
        								'allow' => true,
        								'roles' => ['admin'],
        						],
        						[
        								'actions' => ['create', 'update'],
        								'allow' => true,
        								'roles' => ['customer'],
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
     * Lists all Cprofile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CprofileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cprofile model.
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
     * Creates a new Cprofile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cprofile();
        $model->customer_image = UploadedFile::getInstanceByName('customer_image');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cprofile_id]);
        }

        return $this->render('cprofile', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cprofile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->customer_image = UploadedFile::getInstanceByName('customer_image');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cprofile_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cprofile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['site/index']);
    }

    /**
     * Finds the Cprofile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cprofile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cprofile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
