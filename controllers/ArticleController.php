<?php

namespace app\controllers;

use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\db\Exception;
use yii\filters\AccessControl;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    //public $layout = "xero/main";
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
                        'actions' => ['index', 'view', 'create', 'delete'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $article = Article::findOne(Yii::$app->request->get());
                            return $article->created_by == \Yii::$app->user->id ? true : false;
                        }
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {

//        $this->layout = 'adminLTE/main';
//        $this->layout = "xero/main";
        
        if (!Yii::$app->user->can('list-articles')) {
            throw new ForbiddenHttpException("Access denied");
        }

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can("create-article")) {
            throw new ForbiddenHttpException("Access denied");
        }
        
        $model = new Article();
//        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post())) {

            $transaction = Article::getDb()->beginTransaction();
//            $transaction = Yii::$app->db->beginTransaction();

            try {
                
//                setlocale(LC_ALL,"es_CO");
                
//                $query = "SET lc_time_names = 'es_CO';";
//                $stmt = $this->connexion->query($query);
                
                $model->detail = html_entity_decode($model->detail);
                
                $model->updated_by = Yii::$app->user->id;
                $model->updated_at = new \yii\db\Expression('NOW()');
                
                if ($model->save()) {
                    Yii::$app->session->setFlash("success","Article created successfully!");
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
                
                $transaction->commit();
//                return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can("update-article")) {
            throw new ForbiddenHttpException("Access denied");
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $transaction = \Yii::$app->db->beginTransaction();
            
            try {
                setlocale(LC_ALL,"es_CO");
            
                $connection = \Yii::$app->db;
                $query = $connection->createCommand("SET lc_time_names = 'es_CO';");
                $query->execute();

                $model->detail = html_entity_decode($model->detail);
                
                if ($model->save()) {
                    $transaction->commit();
                    Yii::$app->session->setFlash("success", "Article updated successfully");
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
            } catch (Exception $ex) {
                $transaction->rollBack();
                
                Yii::$app->session->setFlash("error", $ex->getMessage());
            }
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can("delete-article")) {
            throw new ForbiddenHttpException("Access denied");
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
