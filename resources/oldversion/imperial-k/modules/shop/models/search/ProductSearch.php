<?php

namespace app\modules\shop\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\shop\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\modules\shop\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sku', 'category_id'], 'integer'],
            [['name', 'slug', 'weight', 'metal', 'diameter', 'packing', 'trial', 'quality_coin', 'degree_safe', 'circulation', 'specificity', 'image', 'description', 'seo_title', 'seo_description', 'h1_title'], 'safe'],
            [['price'], 'number'],
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
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>100,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'sku' => $this->sku,
            'price' => $this->price,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'weight', $this->weight])
            ->andFilterWhere(['like', 'metal', $this->metal])
            ->andFilterWhere(['like', 'diameter', $this->diameter])
            ->andFilterWhere(['like', 'packing', $this->packing])
            ->andFilterWhere(['like', 'trial', $this->trial])
            ->andFilterWhere(['like', 'quality_coin', $this->quality_coin])
            ->andFilterWhere(['like', 'degree_safe', $this->degree_safe])
            ->andFilterWhere(['like', 'circulation', $this->circulation])
            ->andFilterWhere(['like', 'specificity', $this->specificity])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'h1_title', $this->h1_title]);

        return $dataProvider;
    }
}
