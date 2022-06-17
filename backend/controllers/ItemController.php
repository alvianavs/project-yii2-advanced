<?php

namespace backend\controllers;

use Yii;
use backend\models\Item;
use backend\models\ItemCategory;
use backend\models\ItemSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    // public $defaultAction = 'create';
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'roles' => ['?'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index', 'create', 'update', 'delete'],
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Item models.
     *
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->recordStatistic->trigger(\backend\components\RecordStatistic::EVENT_AFTER_SOMETHING);
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $userIP = Yii::$app->request->userIP;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userIP' => $userIP
        ]);
    }

    /**
     * Displays a single Item model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        Yii::$app->recordStatistic->trigger(\backend\components\RecordStatistic::EVENT_AFTER_SOMETHING);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Item();
        $modelCategory = new ItemCategory();

        $model->file_img = UploadedFile::getInstance($model, 'file_img');
        if ($this->request->isPost && $model->file_img) {
            $imgName = uniqid('img-', true);
            $model->img = $imgName.'.'.$model->file_img->extension;
            $model->file_img->saveAs(
                Url::to('@frontend/web/img/'.$imgName.'.'.$model->file_img->extension)
            );
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelCategory' => $modelCategory,
        ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $old_img = $model->img;

            $model->file_img = UploadedFile::getInstance($model, 'file_img');
            if ($model->file_img != "") {
                $imgName = uniqid('img-', true);
                $model->img = $imgName.'.'.$model->file_img->extension;
                unlink(Url::to('@frontend/web/img/'.$old_img));
                $model->save();
                $model->file_img->saveAs(
                    Url::to('@frontend/web/img/'.$imgName.'.'.$model->file_img->extension)
                );
            } else {
                $model->save();
            }
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        unlink(Url::to('@frontend/web/img/'.$model->img));

        return $this->redirect(['index']);
    }
    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}