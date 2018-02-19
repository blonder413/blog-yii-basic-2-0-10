<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `app\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'category_id', 'course_id', 'status', 'download_counter'], 'integer'],
            [['title', 'slug', 'course_id', 'detail', 'abstract', 'video', 'download', 'tags', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'safe'],
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
        $query = Article::find();

        $query->joinWith('category');
        $query->joinWith('course');
//        $query->joinWith('createdBy');

        $query->joinWith(['createdBy' => function ($q) {
            $q->andFilterWhere(['=', 'user.username', $this->createdBy]);
            $q->andFilterWhere(['=', 'user.username', $this->updatedBy]);
        }]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder'      => [
                    'created_at'    => SORT_DESC,
                    'title'         => SORT_ASC, 
                ],
                'attributes'    => [
                    'title',
                    'created_at',
                    'visit_counter',
                    'download_counter',
                    'category_id'   => [
                        'asc'   => ['categories.category' => SORT_ASC],
                        'desc'   => ['categories.category' => SORT_DESC],
                    ],
                    'course_id'   => [
                        'asc'   => ['courses.course' => SORT_ASC],
                        'desc'   => ['courses.course' => SORT_DESC],
                    ]
                ]
            ],
        ]);
        /*
        $dataProvider->setSort([
            'attributes'    => [
                'title',
                'created_at',
                'category_id'   => [
                    'asc'   => ['category.category' => SORT_ASC],
                    'desc'   => ['category.category' => SORT_DESC],
                ]
            ]
        ]);
        */
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'category_id' => $this->category_id,
            'course_id' => $this->course_id,
            'status' => $this->status,
            'download_counter'  => $this->download_counter,
            // 'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            //'articles.updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
//            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'articles.slug', $this->slug])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'abstract', $this->abstract])
            //->andFilterWhere(['like', 'category.category', $this->category_id])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'download', $this->download])
            ->andFilterWhere(['like', 'user.name', $this->created_by])
            ->andFilterWhere(['like', 'user.name', $this->updated_by])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}
