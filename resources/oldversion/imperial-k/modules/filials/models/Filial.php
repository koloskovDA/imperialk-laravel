<?php

namespace app\modules\filials\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $info
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 */
class Filial extends \yii\db\ActiveRecord
{
	public static function tableName()
	{
		return '{{%filial}}';
	} 

	public function rules()
	{
		return [
		   [['name','info'],'required'],
		   [['address'],'safe'],
		];
	}

	public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'info' => 'Текст',
        ];
    }




}