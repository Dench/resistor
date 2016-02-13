<?php

namespace frontend\controllers;

use common\models\User;
use Yii;
use yii\web\NotFoundHttpException;

class PersonalController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel(Yii::$app->user->identity->getId());

        if ($model->load(Yii::$app->request->post())) {
            if (!empty($model->password)) {
                $model->setPassword($model->password);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'The update was successful.');
                return $this->redirect('');
            }
        }

        return $this->render('index', [
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
