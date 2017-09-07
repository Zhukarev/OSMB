<?php

namespace app\modules\osmb\models;

use Yii;

/**
 * This is the model class for table "raschet".
 *
 * @property string $id
 * @property integer $nachisleno
 * @property integer $summ_oplata
 * @property integer $summ_dolg
 * @property integer $summ_subsid
 * @property integer $summ_benefit
 * @property integer $appartment_id
 * @property string $date
 *
 * @property Oplata[] $oplatas
 * @property Appartment $appartment
 */
class Raschet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raschet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nachisleno', 'appartment_id', 'date'], 'required'],
            [['nachisleno', 'summ_oplata', 'summ_dolg', 'summ_subsid', 'summ_benefit', 'appartment_id'], 'integer'],
            [['date'], 'string', 'max' => 4],
            [['appartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appartment::className(), 'targetAttribute' => ['appartment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nachisleno' => Yii::t('app', 'Nachisleno'),
            'summ_oplata' => Yii::t('app', 'Summ Oplata'),
            'summ_dolg' => Yii::t('app', 'Summ Dolg'),
            'summ_subsid' => Yii::t('app', 'Summ Subsid'),
            'summ_benefit' => Yii::t('app', 'Summ Benefit'),
            'appartment_id' => Yii::t('app', 'Appartment ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    public static function find()
    {
        $find = parent::find();
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        if (isset($roles['accountant'])) {
            $appartment = array();
            foreach (Appartment::find()->all() as $item) {
                $appartment[] = $item->id;
            }

            return $find->andWhere(['IN', 'appartment_id', $appartment]);
        }
        return $find;
    }

    public static function findOld()
    {
        $find = parent::find();
        return $find;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOplatas()
    {
        return $this->hasMany(Oplata::className(), ['raschet_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppartment()
    {
        return $this->hasOne(Appartment::className(), ['id' => 'appartment_id']);
    }

    
}
