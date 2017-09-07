<?php

namespace app\modules\osmb\models;

use Yii;

/**
 * This is the model class for table "benefit_appartment".
 *
 * @property integer $id
 * @property integer $area_benefit
 * @property integer $benefit_id
 * @property integer $appartment_id
 *
 * @property Appartment $appartment
 * @property Benefit $benefit
 */
class BenefitAppartment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'benefit_appartment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_benefit', 'benefit_id', 'appartment_id'], 'required'],
            [['area_benefit', 'benefit_id', 'appartment_id'], 'integer'],
            [['appartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appartment::className(), 'targetAttribute' => ['appartment_id' => 'id']],
            [['benefit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Benefit::className(), 'targetAttribute' => ['benefit_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'area_benefit' => Yii::t('app', 'Area Benefit'),
            'benefit_id' => Yii::t('app', 'Benefit ID'),
            'appartment_id' => Yii::t('app', 'Appartment ID'),
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
            return $find->andWhere(['appartment_id' => $appartment]);
        }
        return $find;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppartment()
    {
        return $this->hasOne(Appartment::className(), ['id' => 'appartment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBenefit()
    {
        return $this->hasOne(Benefit::className(), ['id' => 'benefit_id']);
    }
}
