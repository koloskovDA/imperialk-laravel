<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 17.02.15
 * Time: 19:26
 */

namespace app\components;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;
use Imagine\Image\ManipulatorInterface;


class ImageUploadBehavior extends Behavior
{

    public $attribute = 'image';
    public $directory;
    public $modeThumbnail = 1;


    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
        ];
    }

    public function beforeSave($event)
    {
        $mode = ($this->modeThumbnail == 1) ? ManipulatorInterface::THUMBNAIL_INSET : ManipulatorInterface::THUMBNAIL_OUTBOUND;
        $model = $this->owner;
        $image = UploadedFile::getInstance($model, $this->attribute);
        if ($image instanceof UploadedFile) {
            $fileName = time().'_'.$this->attribute. '.' . $image->getExtension();
            $directory = Yii::getAlias('@webroot/upload') . DIRECTORY_SEPARATOR . $this->directory;
            $savePath = $directory.DIRECTORY_SEPARATOR.$fileName;
            $image->saveAs($savePath);
            $model->{$this->attribute} = $fileName;

            $imageInfo = Image::getImagine()->open($directory.DIRECTORY_SEPARATOR.$model->{$this->attribute})->getSize();

            if(($imageInfo->getWidth() > 1000) || ($imageInfo->getHeight() > 1000)){
                Image::thumbnail($savePath,1000,1000,'inset')->save($savePath, ['quality' => 100]);
            }

        } else {
            if(!$model->isNewRecord){
                $oldAttributes = $model->getOldAttributes();
                $model->{$this->attribute} = $oldAttributes[$this->attribute];
            }
        }

    }



}