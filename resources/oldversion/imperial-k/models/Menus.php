<?php

namespace app\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use app\models\MenusQuery;

/**
 * This is the model class for table "{{%menus}}".
 *
 * @property integer $id
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $name
 */
class Menus extends \yii\db\ActiveRecord
{
    public $parent;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menus}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name'], 'required'],
            [['lft', 'rgt', 'depth'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'name' => 'Name',
        ];
    }


    public function behaviors()
    {
        return [
            'tree'=>[
                'class'=> NestedSetsBehavior::class,
            ]
        ];
    }


    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT =>self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenusQuery(get_called_class());
    }

}
