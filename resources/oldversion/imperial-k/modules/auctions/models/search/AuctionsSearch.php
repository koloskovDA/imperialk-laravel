<?php

namespace app\modules\auctions\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\auctions\models\Auctions;

/**
 * AuctionsSearch represents the model behind the search form about `app\modules\auctions\models\Auctions`.
 */
class AuctionsSearch extends Auctions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'show'], 'integer'],
            [['name', 'slug', 'created_date', 'opening_date', 'closing_date'], 'safe'],
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
        $query = Auctions::find();
        $query->orderBy('opening_date DESC');

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
            'show' => $this->show,
            'created_date' => $this->created_date,
            'opening_date' => $this->opening_date,
            'closing_date' => $this->closing_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
