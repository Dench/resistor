<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SaleSearch represents the model behind the search form about `common\models\Sale`.
 */
class SaleSearch extends Sale
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'region_id', 'district_id', 'type_id', 'parking_id', 'year', 'covered', 'uncovered', 'plot', 'bathroom', 'bedroom', 'solarpanel', 'sauna', 'furniture', 'conditioner', 'heating', 'storage', 'tennis', 'status', 'created_at', 'updated_at', 'top', 'title'], 'integer'],
            [['name', 'commission', 'gps', 'contacts', 'owner', 'address'], 'safe'],
            ['price', 'each', 'rule' => ['integer']],
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
        $query = Sale::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'region_id' => $this->region_id,
            'district_id' => $this->district_id,
            'type_id' => $this->type_id,
            'parking_id' => $this->parking_id,
            'year' => $this->year,
            'covered' => $this->covered,
            'uncovered' => $this->uncovered,
            'plot' => $this->plot,
            'bathroom' => $this->bathroom,
            'bedroom' => $this->bedroom,
            'solarpanel' => $this->solarpanel,
            'sauna' => $this->sauna,
            'furniture' => $this->furniture,
            'conditioner' => $this->conditioner,
            'heating' => $this->heating,
            'storage' => $this->storage,
            'tennis' => $this->tennis,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'top' => $this->top,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'commission', $this->commission])
            ->andFilterWhere(['like', 'gps', $this->gps])
            ->andFilterWhere(['like', 'contacts', $this->contacts])
            ->andFilterWhere(['like', 'owner', $this->owner])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['>=', 'price', $this->price['from']])
            ->andFilterWhere(['<=', 'price', $this->price['to']]);

        return $dataProvider;
    }
}
