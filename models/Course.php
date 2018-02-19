<?php

namespace app\models;
use \yii\behaviors\BlameableBehavior;
use \yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $course
 * @property string $slug
 * @property string $description
 * @property string $image
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Course extends ActiveRecord
{
    public $file;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course', 'slug', 'description'], 'required'],
            [['description'], 'string'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_by', 'created_at', 'updated_by', 'updated_at'], 'safe'],
            [['course', 'slug'], 'string', 'max' => 100],
            [['file'], 'file'],
            [['image'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'course'        => 'Course',
            'slug'          => 'Slug',
            'description'   => 'Description',
            'image'         => 'Image',
            'file'          => 'Image',
            'created_by'    => 'Created By',
            'created_at'    => 'Created At',
            'updated_by'    => 'Updated By',
            'updated_at'    => 'Updated At',
        ];
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
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'course',
                'slugAttribute' => 'slug',
            ],
        ];
    }
}
