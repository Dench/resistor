<?php

namespace backend\controllers;

use backend\models\ModelMultiple;
use common\models\OfferItem;
use common\models\OfferPhoto;
use Exception;
use Yii;
use common\models\Offer;
use backend\models\OfferSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * OfferController implements the CRUD actions for Offer model.
 */
class OfferController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Offer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OfferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Offer model.
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
     * Creates a new Offer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Offer();
        $items = [new OfferItem()];

        if ($model->load(Yii::$app->request->post())) {

            $temp = Yii::$app->request->post('FileId');
            $fileIDs = [];
            $fileIDs2 = [];
            if (!empty($temp)) {
                foreach ($temp as $k => $item) {
                    foreach ($item as $i) {
                        $fileIDs[$k][$i] = $i;
                        $fileIDs2[$i] = $i;
                    }
                }
            }

            $items = ModelMultiple::createMultiple(OfferItem::className());
            ModelMultiple::loadMultiple($items, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($items),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = ModelMultiple::validateMultiple($items) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($items as $i => $item) {
                            /** @var OfferItem $item */
                            $item->group_id = $model->id;
                            if (! ($flag = $item->save(false))) {
                                $transaction->rollBack();
                                break;
                            } else {
                                if (isset($fileIDs[$i])) {
                                    foreach ($fileIDs[$i] as $fid) {
                                        $file = OfferPhoto::findOne($fid);
                                        $file->item_id = $item->id;
                                        $file->save();
                                        $file->rename();
                                    }
                                }
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        $deletedIDs3 = OfferPhoto::findAll(['item_id' => null]);
                        foreach ($deletedIDs3 as $del) {
                            $del->delete();
                        }
                        Yii::$app->session->setFlash('success', Yii::t('app', 'Information saved'), true);
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'items' => (empty($items)) ? [new OfferItem()] : $items,
        ]);
    }

    /**
     * Updates an existing Offer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $items = $model->items;

        if ($model->load(Yii::$app->request->post())) {

            $temp = Yii::$app->request->post('FileId');
            $fileIDs = [];
            $fileIDs2 = [];
            if (!empty($temp)) {
                foreach ($temp as $k => $item) {
                    foreach ($item as $i) {
                        $fileIDs[$k][$i] = $i;
                        $fileIDs2[$i] = $i;
                    }
                }
            }

            $oldIDs = ArrayHelper::map($items, 'id', 'id');
            $items = ModelMultiple::createMultiple(OfferItem::className(), $items);
            ModelMultiple::loadMultiple($items, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($items, 'id', 'id')));

            
            
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($items),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = ModelMultiple::validateMultiple($items) && $valid;

            foreach ($model->items as $item) {
                foreach ($item->photos as $photo) {
                    if (!isset($fileIDs2[$photo->id])) {
                        $deletedIDs2[$photo->id] = $photo->id;
                    }
                }
            }

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs2)) {
                            foreach ($deletedIDs2 as $del) {
                                $ph = OfferPhoto::findOne($del);
                                $ph->delete();
                            }
                        }
                        if (!empty($deletedIDs)) {
                            OfferItem::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($items as $i => $item) {
                            $item->group_id = $model->id;
                            if (!($flag = $item->save(false))) {
                                $transaction->rollBack();
                                break;
                            } else {
                                if (isset($fileIDs[$i])) {
                                    foreach ($fileIDs[$i] as $fid) {
                                        $file = OfferPhoto::findOne($fid);
                                        $file->item_id = $item->id;
                                        $file->save();
                                        $file->rename();
                                    }
                                }
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        $deletedIDs3 = OfferPhoto::findAll(['item_id' => null]);
                        foreach ($deletedIDs3 as $del) {
                            $del->delete();
                        }
                        Yii::$app->session->setFlash('success', Yii::t('app', 'Information saved'), true);
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'items' => (empty($items)) ? [new OfferItem()] : $items
        ]);
    }

    /**
     * Deletes an existing Offer model.
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
     * Finds the Offer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Offer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Offer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeletePhoto()
    {
        return true;
    }

    public function actionUploadPhoto()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {

            $at = ['name', 'tmp_name', 'type', 'size', 'error'];
            $files = [];
            $index = key($_FILES['Files'][$at[0]]);
            foreach ($at as $a) {
                $f = array_shift($_FILES['Files'][$a]);
                $files[$a] = $f['file'];
            }
            $_FILES = [];
            $_FILES['upload'] = $files;

            //Yii::info(print_r($_FILES, true));

            $path = Yii::$app->params['uploadOfferPath'].DIRECTORY_SEPARATOR.'temp';
            $file = UploadedFile::getInstanceByName('upload');
            if (!$file) return false;
            $model = new OfferPhoto();
            if ($model->save()) {
                $model->sort = $model->id;
                $name = $model->id.'.jpg';
                if ($model->save()) {
                    if (!$file->saveAs($path.DIRECTORY_SEPARATOR.$name)) {
                        $model->delete();
                    } else {
                        $model->hash = md5_file($path.DIRECTORY_SEPARATOR.$name);
                        $model->save();
                    }
                }
            }
            sleep(1);
            return [
                'file_id' => $model->id,
                'index' => $index
            ];
        }
        return false;
    }
}
