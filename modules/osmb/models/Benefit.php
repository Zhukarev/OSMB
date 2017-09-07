<?php

namespace app\modules\osmb\models;

use Yii;

/**
 * This is the model class for table "benefit".
 *
 * @property integer $id
 * @property string $name
 * @property integer $percent
 *
 * @property BenefitAppartment[] $benefitAppartments
 */
class Benefit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'benefit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'percent'], 'required'],
            [['percent'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'percent' => Yii::t('app', 'Percent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBenefitAppartments()
    {
        return $this->hasMany(BenefitAppartment::className(), ['benefit_id' => 'id']);
    }
}
