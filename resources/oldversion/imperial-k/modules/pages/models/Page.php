<?php

namespace app\modules\pages\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $url
 * @property string $content
 * @property string $created_at
 * @property string $h1_title
 * @property string $seo_title
 * @property string $seo_description
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['content', 'seo_description'], 'string'],
            [['created_at','slug'], 'safe'],
            [['title', 'slug', 'url', 'h1_title', 'seo_title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'slug' => 'Slug',
            'url' => 'Url',
            'content' => 'Текст',
            'created_at' => 'Дата',
            'h1_title' => 'H1 Title',
            'seo_title' => 'Seo Title',
            'seo_description' => 'Seo Description',
        ];
    }



    public function behaviors()
    {
        return [
            'sluggable'=>[
                'class'=>SluggableBehavior::class,
                'attribute'=>'title',
            ],
            'timestamp'=>[
                'class'=>TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ]
        ];
    }
}
