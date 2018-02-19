<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property string $date
 * @property string $client_iP
 * @property string $client_port
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message'], 'required'],
            [['message'], 'string'],
            [['date'], 'safe'],
            [['name', 'email'], 'string', 'max' => 100],
            [['client_iP'], 'string', 'max' => 15],
            [['client_port'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'message' => 'Message',
            'date' => 'Date',
            'client_iP' => 'Client I P',
            'client_port' => 'Client Port',
        ];
    }
}
