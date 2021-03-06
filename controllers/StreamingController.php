<?php

namespace app\controllers;

use Yii;
use app\models\Streaming;
use app\models\StreamingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StreamingController implements the CRUD actions for Streaming model.
 */
class StreamingController extends Controller
{
<<<<<<< HEAD
    public $layout = "adminLTE/main";
=======
    
    public $layout = 'adminLTE/main';
>>>>>>> fbb4f925194172539c2c0b43a9309233977d9bc3
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Streaming models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StreamingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Streaming model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Streaming model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Streaming();

        if ($model->load(Yii::$app->request->post())) {
            
            if ( $model->save() ) {
                Yii::$app->session->setFlash('success', 'Streaming created successfully');
            } else {
                $errors = '';
                foreach ($model->getErrors() as $key => $value) {
                    foreach ($value as $row => $field) {
                        //Yii::$app->session->setFlash("danger", $field);
                        $errors .= $field . "<br>";
                    }
                }
                
                //print_r($errors);exit;
                Yii::$app->session->setFlash("danger", $errors);
            }
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Streaming model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            if ( $model->save() ) {
                Yii::$app->session->setFlash('success', 'Streaming updated successfully');
            }  else {
                $errors = '';
                foreach ($model->getErrors() as $key => $value) {
                    foreach ($value as $row => $field) {
                        //Yii::$app->session->setFlash("danger", $field);
                        $errors .= $field . "<br>";
                    }
                }
                
                //print_r($errors);exit;
                Yii::$app->session->setFlash("danger", $errors);
            }
            
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Streaming model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Streaming model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Streaming the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Streaming::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
