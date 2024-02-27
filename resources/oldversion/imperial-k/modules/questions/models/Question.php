<?php

namespace app\modules\questions\models;

use Yii;

/**
 * This is the model class for table "{{%question}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $email
 * @property string $question
 * @property string $answer
 * @property string $created_at
 * @property string $updated_at
 * @property integer $show
 * @property integer $pos
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%question}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'show', 'pos'], 'integer'],
            [['question', 'answer'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
            'email' => 'Email',
            'question' => 'Question',
            'answer' => 'Answer',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'show' => 'Show',
            'pos' => 'Pos',
        ];
    }
}
