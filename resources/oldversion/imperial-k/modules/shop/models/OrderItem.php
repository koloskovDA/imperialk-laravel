<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 14.03.15
 * Time: 3:40
 */

namespace app\modules\shop\models;


use yii\db\ActiveRecord;

class OrderItem extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%order_item}}';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity'], 'number'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'title' => 'Title',
            'price' => 'Price',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class,['id'=>'product_id']);
    }

    public function getOrder()
    {
        return $this->hasOne(Order::class,['id'=>'order_id']);
    }


} 