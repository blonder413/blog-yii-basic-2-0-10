<?php

namespace app\models;

use app\models\Security;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $web
 * @property string $rel
 * @property string $comment
 * @property string $date
 * @property integer $article_id
 * @property integer $status
 * @property string $client_ip
 * @property string $client_port
 *
 * @property Article $article
 */
class Comment extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    public $verifyCode;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }
    
    public static function primaryKey()
    {
        return ['id'];
    }

    public function afterSave ( $insert, $changedAttributes )
    {
        if ($insert) {
            $email = new ContactForm();
            $email->name = 'jonathan';
            $email->email = 'blonder413@gmail.com';
            $email->subject = 'comentario insertado';
            $email->body = "<p>El siguiente comentario se ha insertado en <strong>"
                        . $this->article->title . "</strong></p>
                        <p>nombre: $this->name</p>
                        <p>$this->comment</p>
                        ";
            $email->contact(Yii::$app->params['adminEmail']);
        } /*else {
            $email->subject = 'comentario actualizado';
            $email->body = 'Un comentario se ha actualizado en ' . $this->article->title;
        }*/

        return true;
        
    }
/*
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            // ...custom code here...
            return true;
        } else {
            return false;
        }
    }
 */       
    public function beforeSave($insert)
    {
        /*
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->email = Security::mcrypt($this->email);
            }
            
            return true;
        }
        */
        
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->email = Security::mcrypt($this->email);
            }
            
            return true;
        } else {
            return false;
        }
        
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'web'], 'trim'],
            [['name', 'email', 'comment', 'date', 'article_id'], 'required'],
            [['comment'], 'string'],
            [['date'], 'safe'],
            [['article_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['email', 'web'], 'string', 'max' => 100],
            ['email', 'email', 'on' => 'comment'],
            ['web', 'url', 'defaultScheme' => 'http', 'message' => 'Por favor introduzca la URL completa, ej: www.blonder413.com'],
            [['rel'], 'string', 'max' => 20],
            [['client_ip'], 'string', 'max' => 15],
            [['client_port'], 'string', 'max' => 5],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
            [['verifyCode'], 'captcha', 'on'=>'comment'],
            [['status'], 'default', 'value' => self::STATUS_INACTIVE],
            // ['verifyCode', 'captcha', 'captchaAction' => 'site/article', 'caseSensitive' => false,],
            
        ];
    }
/*
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['approve'] = ['status', 'updated_by', 'updated_at'];//Scenario Values Only Accepted
        return $scenarios;
    }
*/
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'name'          => 'Nombre',
            'email'         => 'Correo Electrónico',
            'web'           => 'Web',
            'rel'           => 'Rel',
            'comment'       => 'Comentario',
            'date'          => 'Date',
            'article_id'    => 'Article',
            'status'        => 'Status',
            'client_ip'     => 'Client Ip',
            'client_port'   => 'Client Port',
            "verifyCode"    => "Código de Verificación"
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}