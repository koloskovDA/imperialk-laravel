<?php

namespace app\modules\auctions\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $pos
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['pos'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255]
        ];
    }

    public function behaviors()
    {
        return [
            'sluggable'=>[
                'class'=>SluggableBehavior::class,
                'attribute'=>'name',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'slug' => 'Slug',
            'pos' => 'Позиция',
        ];
    }
}
