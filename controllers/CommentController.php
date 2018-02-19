<?php

namespace app\controllers;

use Yii;
use app\models\Comment;
use app\models\CommentSearch;
use app\models\Security;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
{
    public $layout = "adminLTE/main";
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['index', 'view', 'create', 'delete','update', 'approve'],
                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['index'],
//                        'roles' => ['?'],
//                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'index-ajax','view', 'create', 'delete','update', 'approve'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'adminLTE/main';
        
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $pending = Comment::find()->where(['status' => 0])->count();

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'pending'       => $pending,
        ]);
    }
    
    public function actionIndexAjax()
    {
//        $this->layout = 'adminLTE/main';
        
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $pending = Comment::find('status = 0')->count();

        return $this->renderAjax('_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pending'       => $pending,
        ]);
    }

    /**
     * Displays a single Comment model.
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
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate()
    {
        if (!\Yii::$app->user->can("create-comment")) {
            throw new ForbiddenHttpException("Access denied");
        }
        
        $model = new Comment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    */

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->email = trim(Security::decrypt($model->email));

        if ($model->load(Yii::$app->request->post())) {
            
            $model->email         = Security::mcrypt($model->email);
            
            if ($model->save()) {
                Yii::$app->session->setFlash("success", "Comentario actualizado exitosamente!");
            } else {
                Yii::$app->session->setFlash("error", "Ocurrió un error al actualizar el comentario!");
            }

            return $this->redirect(['index']);
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionApprove($id){
        $comment = Comment::findOne($id);
        $comment->status = Comment::STATUS_ACTIVE;
        
        if ($comment->save()) {
          Yii::$app->session->setFlash("success", "Comentario aprobado exitosamente!");
        } else {
            $errors = '';
            foreach ($comment->getErrors() as $key => $value) {
                foreach ($value as $row => $field) {
                    //Yii::$app->session->setFlash("danger", $field);
                    $errors .= $field . "<br>";
                }
            }
                    
            //print_r($errors);exit;
            Yii::$app->session->setFlash("danger", $errors);
        }

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
          Yii::$app->session->setFlash("success", "Comentario borrado exitosamente!");
        } else {
          Yii::$app->session->setFlash("error", "Ocurrió un error al borrar el comentario!");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
