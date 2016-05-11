<?php

namespace frontend\controllers;

use backend\models\SaleFiles;
use common\models\Broker;
use common\models\District;
use common\models\Lang;
use common\models\Sale;
use common\models\SaleLang;
use common\models\SalePhoto;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class PersonalController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $user = $this->findModel(Yii::$app->user->identity->getId());
        $broker = Broker::findOne($user->id);

        return $this->render('index', [
            'user' => $user,
            'broker' => $broker
        ]);
    }

    public function actionUser()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel(Yii::$app->user->identity->getId());

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->password)) {
                $model->setPassword($model->password);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'The update was successful.'));
                return $this->redirect(Url::toRoute('personal/index'));
            }
        }

        return $this->render('user', [
            'model' => $model,
        ]);
    }

    public function actionBroker()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = Broker::findOne(Yii::$app->user->identity->getId());
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->getDirtyAttributes()) {
                $mes = [];
                foreach ($model->getDirtyAttributes() as $k => $v) {
                    if ($k == 'name' && $model->type_id == 1) {
                        $mes[$k] = [ Yii::t('app', 'Full name'), $model->name ];
                    } else {
                        $mes[$k] = [$model->getAttributeLabel($k), $model->$k];
                    }
                }
                $message = "";
                foreach ($mes as $m) {
                    $message .= "<p><b>".$m[0].":</b> ".$m[1]."</p>";
                }
                $new = Broker::findOne($model->user_id);
                if ($message) {
                    $new->edit = $message;
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Sent admin to verify.'));
                } else {
                    $new->edit = '';
                }
                $new->save();
                return $this->redirect(Url::toRoute('personal/index'));
            }
        }

        return $this->render('broker', [
            'model' => $model,
        ]);
    }

    function actionSaleUpdate($id)
    {
        $model = Sale::findOne(['id' => $id, 'user_id' => Yii::$app->user->identity->getId()]);

        if (empty($model)) return $this->redirect(['/personal']);

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
            return $this->redirect(['/personal']);
        } else {
            return $this->render('sale/update', [
                'model' => $model,
                'model_content' => $model_content,
            ]);
        }
    }
    
    function actionSaleCreate()
    {
        $model = new Sale();

        for ($i = 1; $i <= Lang::find()->count(); $i++) {
            $model_content[$i] = new SaleLang();
            $model_content[$i]['lang_id'] = $i;
            $model_content[$i]['id'] = 0;
        }

        $model->status = Sale::STATUS_AWAITING;
        $model->sold = 1;
        $model->code = rand(100000000,999999999);

        if ($model->load(Yii::$app->request->post()) &&
            Model::loadMultiple($model_content, Yii::$app->request->post()) &&
            Model::validateMultiple($model_content) &&
            $model->validate() && $model->district_id > 0)
        {
            $model->save();
            foreach ($model_content as $key => $content) {
                $content->id = $model->id;
                $content->lang_id = $key;
                $content->save(false);
            }
            return $this->redirect(['sale-update', 'id' => $model->id]);
        } else {
            return $this->render('sale/create', [
                'model' => $model,
                'model_content' => $model_content
            ]);
        }
    }

    public function actionDistrictList()
    {
        if (isset($_POST['depdrop_parents'])) {
            if ($parents = $_POST['depdrop_parents']) {
                $out[-1] = '';
                $out += District::getList($parents[0]);
                foreach ($out as $key => $value) {
                    $result[] = ['id' => $key, 'name' => $value];
                }
                print Json::encode(['output' => @$result, 'selected' => '']);
                return;
            }
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
                    } else {
                        $model->hash = md5_file($path.DIRECTORY_SEPARATOR.$name);
                        $model->save();
                    }
                }
            }
            sleep(1);
            return true;
        }
        return false;
    }

    public function actionDeleteFile()
    {
        $id = Yii::$app->request->post('key');
        $model = SaleFiles::findOne($id);
        if ($model ->delete())
            return true;
        return false;
    }

    public function actionUploadFile()
    {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('sale_id');
            $path = Yii::$app->params['uploadSalePath'].DIRECTORY_SEPARATOR.$id;
            BaseFileHelper::createDirectory($path);
            $file = UploadedFile::getInstanceByName('files');
            if (file_exists($path.DIRECTORY_SEPARATOR.$file->name)) {
                return false;
            }
            $model = new SaleFiles();
            $model->sale_id = $id;
            $model->name = $file->name;
            if ($model->save()) {
                if ($model->save()) {
                    if (!$file->saveAs($path.DIRECTORY_SEPARATOR.$model->name)) {
                        $model->delete();
                    }
                }
            }
            sleep(1);
            return true;
        }
        return false;
    }

    public function actionDistrictMarkers($district_id)
    {
        print json_encode(Sale::gpsMarkers($district_id));
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
