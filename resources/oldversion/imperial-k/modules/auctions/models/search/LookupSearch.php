<?php
/**
 * Created by PhpStorm.
 * User: Мухтар
 * Date: 24.03.15
 * Time: 11:58
 */

namespace app\modules\auctions\models\search;


use app\modules\auctions\models\Lookup;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class LookupSearch extends Lookup
{
    public function rules()
    {
        return [
            [['id','value'],'integer'],
            [['type','value'],'safe'],
        ];

    }


    public function scenarios()
    {
        return Model::scenarios();
    }


    public function search($params)
    {
        $query = Lookup::find();
        $dataProvider = new ActiveDataProvider([
            'query'=>$query,
        ]);
        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'=>$this->id,
            'value'=>$this->value,
        ]);
        $query->andFilterWhere(['like','type',$this->type]);
        return $dataProvider;
    }
} 