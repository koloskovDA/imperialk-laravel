<?php

namespace app\modules\auctions\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;

use app\modules\auctions\models\Lots;
/**
 * This is the model class for table "{{%auctions}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $show
 * @property string $created_date
 * @property string $opening_date
 * @property string $closing_date
 * @property  integer $status
 */
class Auctions extends \yii\db\ActiveRecord
{

    const STATUS_CLOSE = 0;
    const STATUS_OPEN = 1;
    const SHOW_CLOSE = 0;
    const SHOW_OPEN = 10;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auctions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['status','default','value'=>self::STATUS_OPEN],
            ['show','default','value'=>self::SHOW_CLOSE],
            ['status','in','range'=>[self::STATUS_OPEN,self::STATUS_CLOSE]],
            ['show','in','range'=>[self::SHOW_OPEN,self::SHOW_CLOSE]],
            [['created_date', 'opening_date', 'closing_date','status','show'], 'safe'],
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
            'timestamp'=>[
                'class'=>TimestampBehavior::class,
                'createdAtAttribute' => 'created_date',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
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
            'name' => 'Название',
            'slug' => 'Slug',
            'show' => 'Выставлен',
            'status'=>'Текущий аукцион',
            'created_date' => 'Created Date',
            'opening_date' => 'Начало закрытия',
            'closing_date' => 'Дата закрытия',
        ];
    }


    public function beforeSave($insert)
    {

        if($this->isNewRecord)
        {
            $openingDate = strtotime($this->opening_date) + Lots::TIME_PERIOD;
            $this->closing_date = date("Y-m-d H:i:s",$openingDate);
        }else {
            $openingDate = $this->opening_date;
            $closeTime = date("H:i:s", strtotime($openingDate));
            $closeDate = date("Y-m-d", strtotime($openingDate));
            $lots = Lots::find()->where(['auction_id' => $this->id])->orderBy('category_id ASC,pos ASC')->all();
            $i = 0;

            foreach($lots as $lot){
                $i++;
                if($i == 1){
                    $closeTime = date("H:i:s", strtotime($closeTime));
                } else {
                    $closeTime = date("H:i:s", strtotime($closeTime) + Lots::TIME_PERIOD);
                }
                $fullDate = strtotime($closeDate.$closeTime);
                $closingDate = date('Y-m-d H:i:s',$fullDate);
                Yii::$app->db->createCommand()->update('im_lots',[
                    'close_time'=>$closeTime,
                    'close_date'=>$closeDate,
                    'closing_date'=>$closingDate,
                    'pos'=>$i,

                ],'id='.$lot->id)->execute();

            }

            $fullDate = strtotime($closeDate.$closeTime);
            $this->closing_date = date('Y-m-d H:i:s',$fullDate);
       
        }
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLots()
    {
        return $this->hasMany(Lots::class, ['auction_id' => 'id']);
    }


    public function getAuctionName()
    {
        return 'Аукцион № '.$this->name;
    }

}
