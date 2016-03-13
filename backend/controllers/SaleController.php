<?php

namespace backend\controllers;

use common\models\Lang;
use common\models\SaleLang;
use common\models\SalePhoto;
use frontend\models\SaleSearch;
use Yii;
use common\models\Sale;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\helpers\BaseFileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            if (Yii::$app->user->identity->group_id != 1) {
                                Yii::$app->user->logout();
                                return $this->goHome();
                            }
                            return true;
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

    public function init()
    {
        Yii::$app->view->registerJsFile('http://maps.googleapis.com/maps/api/js',['position' => \yii\web\View::POS_HEAD]);
        Yii::$app->view->registerJsFile('/js/gapi.js', ['depends' => 'yii\web\JqueryAsset']);
    }

    /**
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SaleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sale model.
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
     * Creates a new Sale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sale();
        $model->status = 1;

        for ($i = 1; $i <= Lang::find()->count(); $i++) {
            $model_content[$i] = new SaleLang();
            $model_content[$i]['lang_id'] = $i;
            $model_content[$i]['id'] = 0;
        }

        if ($model->load(Yii::$app->request->post()) &&
            Model::loadMultiple($model_content, Yii::$app->request->post()) &&
            Model::validateMultiple($model_content) &&
            $model->save())
        {
            foreach ($model_content as $key => $content) {
                $content->id = $model->id;
                $content->lang_id = $key;
                $content->save(false);
            }
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model_content' => $model_content,
            ]);
        }
    }

    /**
     * Updates an existing Sale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        for ($i = 1; $i <= Lang::find()->count(); $i++) {
            $model_content[$i] = SaleLang::findOne(['id' => $id, 'lang_id' => $i]);
        }

        if ($model->load(Yii::$app->request->post()) &&
            Model::loadMultiple($model_content, Yii::$app->request->post()) &&
            Model::validateMultiple($model_content) &&
            $model->save())
        {
            foreach ($model_content as $key => $content) {
                $content->save(false);
            }
            return $this->redirect(['/sale']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_content' => $model_content,
            ]);
        }
    }

    /**
     * Deletes an existing Sale model.
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
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sale::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeletePhoto()
    {
        $id = Yii::$app->request->post('key');
        $model = SalePhoto::findOne($id);
        if ($model ->delete())
            return true;
        return false;
    }

    public function actionUploadPhoto()
    {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('sale_id');
            $path = Yii::$app->params['uploadSalePath'].DIRECTORY_SEPARATOR.$id;
            BaseFileHelper::createDirectory($path);
            $file = UploadedFile::getInstanceByName('photos');
            $model = new SalePhoto();
            $model->sale_id = $id;
            if ($model->save()) {
                $model->sort = $model->id;
                $name = $model->id.'.jpg';
                if ($model->save()) {
                    if (!$file->saveAs($path.DIRECTORY_SEPARATOR.$name)) {
                        $model->delete();
                    }
                }
            }
            sleep(1);
            return true;
        }
        return false;
    }
}
