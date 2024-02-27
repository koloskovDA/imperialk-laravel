<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 04.05.15
 * Time: 15:46
 */

namespace app\modules\auctions\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%auctions}}".
 *
 * @property integer $id
 * @property integer $auction_id
 * @property integer $status
 * @property string $created_at
 * */
class AuctionsResult extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%auctions_result}}';
    }

} 