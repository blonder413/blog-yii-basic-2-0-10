<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Helper;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $this->layout = "AdminLTE/main";
        
        if (!Yii::$app->user->can('list-categories')) {
            throw new ForbiddenHttpException("Access denied");
        }
        
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('create-category')) {
            throw new ForbiddenHttpException("Access denied");
        }
        
        $model = new Category(['scenario' => 'create']);
        
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            
            $model->image = Helper::limpiaUrl($model->category . '.' . $model->file->extension);
            
            if ( $model->save() ) {
                $model->file->saveAs( 'web/img/categories/' . $model->image);
                Yii::$app->session->setFlash('success', 'Category created successfully');
            } else {
                $errors = '<ul>';
                foreach ($model->getErrors() as $key => $value) {
                    foreach ($value as $row => $field) {
                        //Yii::$app->session->setFlash("danger", $field);
                        $errors .= "<li>" . $field . "</li>";
                    }
                }
                $errors .= '</li>';
                
                //print_r($errors);exit;
                Yii::$app->session->setFlash("danger", $errors);
            }
            
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can('update-category')) {
            throw new ForbiddenHttpException("Access denied");
        }
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $model->file = UploadedFile::getInstance($model, 'file');
            
            if ( $model->save() ) {
                
                if ( isset($model->file) ) {
                    $model->image = Helper::limpiaUrl($model->category . '.' . $model->file->extension);
                    $model->file->saveAs( 'web/img/categories/' . $model->image);
                }
                
                Yii::$app->session->setFlash('success', 'Category created successfully');
            } else {
                $errors = '<ul>';
                foreach ($model->getErrors() as $key => $value) {
                    foreach ($value as $row => $field) {
                        //Yii::$app->session->setFlash("danger", $field);
                        $errors .= "<li>" . $field . "</li>";
                    }
                }
                $errors .= '</li>';
                
                //print_r($errors);exit;
                Yii::$app->session->setFlash("danger", $errors);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('delete-category')) {
            throw new ForbiddenHttpException("Access denied");
        }
        
        $this->findModel($id)->delete();
        
        Yii::$app->session->setFlash('success', 'Category deleted successfully');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
