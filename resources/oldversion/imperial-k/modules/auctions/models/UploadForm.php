<?php
/**
 * Created by PhpStorm.
 * User: Ìóõòàð
 * Date: 18.11.2015
 * Time: 23:41
 */

namespace app\modules\auctions\models;


use yii\base\Model;

class UploadForm extends Model
{
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFile'],'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4]
        ];
    }


}