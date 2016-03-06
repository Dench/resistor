<?php

namespace backend\controllers;

use common\models\Lang;
use common\models\ViewLang;
use Yii;
use common\models\View;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ViewController implements the CRUD actions for View model.
 */
class ViewController extends Controller
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

    /**
     * Lists all View models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => View::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single View model.
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
     * Creates a new View model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new View();
        for ($i = 1; $i <= Lang::find()->count(); $i++) {
            $model_content[$i] = new ViewLang();
            $model_content[$i]['lang_id'] = $i;
            $model_content[$i]['id'] = 0;
        }

        if (Model::loadMultiple($model_content, Yii::$app->request->post()) &&
            Model::validateMultiple($model_content) &&
            $model->save())
        {
            foreach ($model_content as $key => $content) {
                $content->id = $model->id;
                $content->lang_id = $key;
                $content->save(false);
            }
            return $this->redirect(['/view']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model_content' => $model_content,
            ]);
        }
    }

    /**
     * Updates an existing View model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        for ($i = 1; $i <= Lang::find()->count(); $i++) {
            $model_content[$i] = ViewLang::findOne(['id' => $id, 'lang_id' => $i]);
        }
        if (Model::loadMultiple($model_content, Yii::$app->request->post()) &&
            Model::validateMultiple($model_content))
        {
            foreach ($model_content as $key => $content) {
                $content->save(false);
            }
            return $this->redirect(['/view']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_content' => $model_content,
            ]);
        }
    }

    /**
     * Deletes an existing View model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/view']);
    }

    /**
     * Finds the View model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return View the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = View::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
