<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\models\User;

class SettingsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = User::findOne(Yii::$app->user->id);
        $model->scenario = 'update';

        // Clear fields to avoid overwriting if left empty
        $model->password = '';

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            // Handle profile image upload
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->imageFile) {
                $uploadPath = Yii::getAlias('@webroot/uploads/');
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $fileName = 'profile_' . $model->id . '.' . $model->imageFile->extension;
                $fullPath = $uploadPath . $fileName;
                if ($model->imageFile->saveAs($fullPath)) {
                    $model->image = 'uploads/' . $fileName;
                }
            }

            // Hash new password if provided
            if (!empty($model->password)) {
                $model->setPassword($model->password);
                $model->generateAuthKey(); // update authKey if password changes
            }

            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', '✅ Profile updated successfully.');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', '❌ Failed to update profile. Please check your input.');
            }
        }

        return $this->render('index', ['model' => $model]);
    }
}
