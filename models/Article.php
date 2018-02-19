<?php

namespace app\models;

use \yii\behaviors\BlameableBehavior;
use \yii\behaviors\SluggableBehavior;
use \yii\db\ActiveRecord;
use \yii\db\Expression;
use \yii\helpers\Url;
use himiklab\sitemap\behaviors\SitemapBehavior;


use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property integer $number
 * @property string $title
 * @property string $slug
 * @property string $topic
 * @property string $detail
 * @property string $abstract
 * @property string $video
 * @property integer $type_id
 * @property string $download
 * @property integer $category_id
 * @property string $tags
 * @property integer $status
 * @property integer $visit_counter
 * @property integer $download_counter
 * @property integer $course_id
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property Category $category
 * @property Course $course
 * @property Type $type
 * @property User $createdBy
 * @property User $updatedBy
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'detail', 'abstract', 'type_id', 'category_id', 'tags'], 'required'],
            [['title'], 'unique'],
            [['detail', 'video'], 'string'],
            [['number','type_id', 'category_id', 'status', 'visit_counter', 'download_counter', 'course_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 150],
            [['abstract'], 'string', 'max' => 300],
            [['download', 'topic'], 'string', 'max' => 100],
            [['tags'], 'string', 'max' => 255]
        
            /*
            [
                'title', 'required', 'when' => function($model, $attribute){
                    return (empty($model->number));
                }, 'whenClient' => "function (attribute, value) {
                    return $('#article-number').val() == 0;
                }"
            ],
            */
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'timestamp' => [
//                'class' => 'yii\behaviors\TimestampBehavior',
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
//                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
//                ],
//                'value' => new Expression('NOW()'), 
//            ],
//            'blameable' => [
//                'class' => BlameableBehavior::className(),
//                'createdByAttribute' => 'created_by',
//                'updatedByAttribute' => 'updated_by',
//            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
//                'slugAttribute' => 'seo_slug',
/*
                'value' => function ($event) {
                    $article = rtrim($this->title, '?' );
                    return str_replace(' ', '_', $article);
                }
 */
            ],
            'sitemap' => [
                'class' => SitemapBehavior::className(),
                'scope' => function ($model) {
                    /** @var \yii\db\ActiveQuery $model */
                    $model->select(['slug', 'updated_at']);
                    $model->andWhere(['status' => 1]);
                },
                'dataClosure' => function ($model) {
                    /** @var self $model */
                    return [
                        'loc' => Url::to($model->url, true),
                        'lastmod' => strtotime($model->updated_at),
                        'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                        'priority' => 0.8
                    ];
                }
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->status = 1;
                $this->created_by = Yii::$app->user->id;
                $this->created_at = new Expression('NOW()');
                $this->updated_by = Yii::$app->user->id;
                $this->updated_at = new \yii\db\Expression('NOW()');

                $rss = Yii::$app->getModule('rss');
                $rssItem = $rss->createNewItem();
     
                $rssItem->title = $this->title;
                $rssItem->description = $this->detail;
                $rssItem->link = Url::to($this->url, true);
                $rssItem->pubDate = time();
     
                return $rss->addItemToFeed('rss', $rssItem);
            } else {
                if ( isset( Yii::$app->user->id ) ) {
                    $this->updated_by = Yii::$app->user->id;
                    $this->updated_at = new \yii\db\Expression('NOW()');
                }
            }
            return true;
        }
        return false;
    }
    
    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
        parent::afterDelete();
        $rss = Yii::$app->getModule('rss');
     
        $rss->deleteItems('rss', ['link' => Url::to($this->url, true)]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'number'            => 'Number',
            'title'             => 'Title',
            'slug'              => 'Slug',
            'topic'             => 'Topic',
            'detail'            => 'Detail',
            'abstract'          => 'Abstract',
            'video'             => 'Video',
            'type_id'           => 'Type',
            'download'          => 'Download',
            'category_id'       => 'Category',
            'tags'              => 'Tags',
            'status'            => 'Status',
            'visit_counter'     => 'Visit Counter',
            'download_counter'  => 'Download Counter',
            'course_id'         => 'Course',
            'created_by'        => 'Created By',
            'created_at'        => 'Created At',
            'updated_by'        => 'Updated By',
            'updated_at'        => 'Updated At',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id'])
                    ->where("status = " . Comment::STATUS_ACTIVE)
                    ->count('id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id'])->orderBy('id desc');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
    
    /**
     * @return String the URL for the article detail
     */
    public function getUrl()
    {
        return \yii\helpers\BaseUrl::home() . "articulo/" . $this->slug;
    }
}
