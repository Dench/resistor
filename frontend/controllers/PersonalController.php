<?php

namespace frontend\controllers;

use common\models\Broker;
use common\models\User;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
