<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Streaming;

/**
 * StreamingSearch represents the model behind the search form about `app\models\Streaming`.
 */
class StreamingSearch extends Streaming
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['title', 'start', 'description', 'embed', 'created_at', 'updated_at'], 'safe'],
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
        $query = Streaming::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'      => [
                    'start'    => SORT_DESC,
                    'title'         => SORT_ASC, 
                ],
                'attributes'    => [
                    'title',
                    'description',
                    'embed',
                    'start',
                    'created_by'   => [
                        'asc'   => ['createdBy.name' => SORT_ASC],
                        'desc'   => ['createdBy.name' => SORT_DESC],
                    ],
                    'created_at',
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
//            'start'      => $this->start,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'start', $this->start])
            ->andFilterWhere(['like', 'embed', $this->embed]);

        return $dataProvider;
    }
}
