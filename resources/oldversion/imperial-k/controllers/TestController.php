<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 04.04.15
 * Time: 4:31
 */

namespace app\controllers;


use app\models\User;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\Controller;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

class TestController extends Controller
{
    public function actionIndex()
    {
        $uploadsDir = \Yii::getAlias('@webroot/upload/test/');
        $file = $uploadsDir . '1455733512_image.jpg';
        $fileout = $uploadsDir . '1455733512_thumb.jpg';
        $imageInfo = Image::getImagine()->open($file)->getSize();


        if (($imageInfo->getWidth() > 1000) || ($imageInfo->getHeight() > 1000)) {
            $width = $imageInfo->getWidth();
            $height = $imageInfo->getHeight();
            $ratio = $width / $height;
            if ($ratio > 1) {
                $width = 1000;
                $height = ceil(1000 / $ratio);
            } else {
                $width = ceil(1000 * $ratio);
                $height = 1000;
            }
//            Image::thumbnail($file, $width, $height)->save($file, ['quality' => 100]);
//            Image::thumbnail($file, 100, 100)->save($file, ['quality' => 100]);
        }
        Image::thumbnail($file, 200, 200,'outbound')->save($fileout, ['quality' => 100]);
        $response = \Yii::$app->getResponse();
        $response->headers->set('Content-Type', 'image/jpeg');
        $response->format = Response::FORMAT_RAW;
        if (!is_resource($response->stream = fopen($fileout, 'r'))) {
            throw new ServerErrorHttpException('file access failed');
        }
        $response->send();


    }


    public function actionCurl()
    {
        \Yii::$app->controller->enableCsrfValidation = false;
        $ch = curl_init();
        $user = User::findOne(1);
        $user = serialize($user);
        $postData = [
            'user' => $user,
        ];

        curl_setopt($ch, CURLOPT_URL, "http://mmkstroy.ru/mail/index");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $output = curl_exec($ch);
        if ($output === FALSE) {
            echo "cURL Error: " . curl_error($ch);
        }
        $info = curl_getinfo($ch);

        curl_close($ch);
        print_r($output);


    }

    public function actionShowimage()
    {
        print "SHOW IMAGE";

    }


}