<?php

namespace app\modules\osmb\models;

use Yii;
use app\models\User;
use yii\helpers\Html;

/**
 * This is the model class for table "access".
 *
 * @property integer $id
 * @property integer $status
 * @property string $date_create
 * @property string $date_change
 * @property string $comment
 * @property integer $appartment_id
 * @property integer $user_id
 *
 * @property Appartment $appartment
 * @property User $user
 */
class Access extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'appartment_id', 'user_id'], 'integer'],
            [['date_create', 'appartment_id', 'user_id'], 'required'],
            [['comment'], 'string'],
            [['date_create', 'date_change'], 'string', 'max' => 6],
            [['appartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appartment::className(), 'targetAttribute' => ['appartment_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_change' => Yii::t('app', 'Date Change'),
            'comment' => Yii::t('app', 'Comment'),
            'appartment_id' => Yii::t('app', 'Appartment ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppartment()
    {
        return $this->hasOne(Appartment::className(), ['id' => 'appartment_id']);
    }

    public static function getRequestLabel(){
        $cnt = Access::find()->innerJoin('appartment a', "((access.appartment_id=a.id) AND (access.status=2))")->count();

        return ($cnt > 0) ? Html::tag('span', $cnt, ['class'=>'badge pull-right']) : '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
/*
    public static function find()
    {
        return parent::find()->andWhere(['user_id' => Yii::$app->user->id]);

    }*/
}
