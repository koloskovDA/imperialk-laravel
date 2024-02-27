<?php

namespace app\modules\auctions\models;

use app\components\ImageDisplayBehavior;
use Yii;

/**
 * This is the model class for table "{{%photo_lots}}".
 *
 * @property integer $id
 * @property string $src
 * @property string $alt
 * @property integer $pos
 * @property integer $lot_id
 *
 * @property Lots $lot
 */
class PhotoLots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo_lots}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pos', 'lot_id'], 'integer'],
            [['src'], 'file', 'extensions'=>'jpg,png','mimeTypes'=>'image/jpeg, image/png',],
        ];
    }


    public function behaviors()
    {

        return [
            [
                'class'=>ImageDisplayBehavior::class,
                'attribute'=>'src',
                'directory'=>'photolots',
            ]
        ];

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Фото',
            'alt' => 'Alt',
            'pos' => 'Pos',
            'lot_id' => 'Lot ID',
        ];
    }


    public function getImage()
    {
        $directory = '/upload/photolots/';
        return $directory.$this->src;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLot()
    {
        return $this->hasOne(Lots::class, ['id' => 'lot_id']);
    }
}
