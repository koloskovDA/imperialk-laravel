<?php

namespace app\modules\auctions\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\auctions\models\ProfileLots;

/**
 * ProfileLotsSearch represents the model behind the search form about `app\modules\auctions\models\ProfileLots`.
 */
class ProfileLotsSearch extends ProfileLots
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lot_id', 'user_id'], 'integer'],
            [['sum'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProfileLots::find();
        $query->addOrderBy('id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'lot_id' => $this->lot_id,
            'user_id' => $this->user_id,
            'sum' => $this->sum,
        ]);



        return $dataProvider;
    }
}
