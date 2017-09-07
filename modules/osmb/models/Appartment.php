<?php

namespace app\modules\osmb\models;

use Yii;

/**
 * This is the model class for table "appartment".
 *
 * @property integer $id
 * @property integer $num_app
 * @property string $FIO
 * @property integer $propisano
 * @property integer $area
 * @property string $telefon
 * @property integer $house_id
 * @property integer $subsidStasus
 *
 * @property House $house
 * @property BenefitAppartment[] $benefitAppartments
 * @property Raschet[] $raschets
 */
class Appartment extends \yii\db\ActiveRecord
{
    public $_benefit_id = null;
    public $_area_benefit = null;

    public function getBenefit()
    {
        return $this->_benefit_id;
    }

    public function setBenefit($benefit_id)
    {
        $this->_benefit_id = $benefit_id;
    }

    public function getAreaBenefit()
    {
        return $this->_area_benefit;
    }

    public function setAreaBenefit($area_benefit)
    {
        $this->_area_benefit = $area_benefit;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appartment';
    }

    const SCENARIO_FILLING = 'filling';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_FILLING] = ['area', 'benefit', 'areaBenefit'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area'], 'required', 'on' => self::SCENARIO_FILLING],
            [['benefit, area_benefit'], 'safe', 'on' => self::SCENARIO_FILLING],
            [['num_app', 'house_id'], 'required'],
            [['num_app', 'propisano', 'area', 'house_id', 'subsidStasus'], 'integer'],
            [['FIO'], 'string', 'max' => 45],
            [['telefon'], 'string', 'max' => 20],
            [['house_id'], 'exist', 'skipOnError' => true, 'targetClass' => House::className(), 'targetAttribute' => ['house_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'num_app' => Yii::t('app', 'Num App'),
            'FIO' => Yii::t('app', 'Fio'),
            'propisano' => Yii::t('app', 'Propisano'),
            'area' => Yii::t('app', 'Area'),
            'telefon' => Yii::t('app', 'Telefon'),
            'house_id' => Yii::t('app', 'House ID'),
            'subsidStasus' => Yii::t('app', 'Subsid Stasus'),
        ];
    }


    public static function find()
    {
        $find = parent::find();
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        if (isset($roles['accountant'])) {
            $house = array();
            foreach (House::find()->all() as $item) {
                $house[] = $item->id;
            }
            return $find->andWhere([ 'house_id' => $house]);
        }
        return $find;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouse()
    {
        return $this->hasOne(House::className(), ['id' => 'house_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBenefitAppartments()
    {
        return $this->hasMany(BenefitAppartment::className(), ['appartment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaschets()
    {
        return $this->hasMany(Raschet::className(), ['appartment_id' => 'id']);
    }

    /*public function getAccess()
    {
        return $this->hasMany(Access::className(), ['appartment_id' => 'id']);
    }*/

    public function getAccessStatus($isAccesses, $isAccessesActive)
    {
//        $access = Access::find()->andWhere(['appartment_id' => $this->id])->one();
        $status = 0;
        if(!$isAccesses){
            $status = 5;
        } else {
            if ($isAccessesActive) {
                if (Access::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['appartment_id' => $this->id])->andWhere(['status' => 1])->one()) {
                    $status = 1;
                } elseif (Access::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['appartment_id' => $this->id])->andWhere(['status' => 2])->one()) {
                    $status = 2;
                } elseif (Access::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['appartment_id' => $this->id])->andWhere(['status' => 3])->one()) {
                    $status = 3;
                } elseif (Access::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['appartment_id' => $this->id])->count() == 0) {
                    $status = 4;
                }
            } else {
                if (Access::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['appartment_id' => $this->id])->andWhere(['status' => 1])->one()) {
                    $status = 1;
                } elseif (Access::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['appartment_id' => $this->id])->andWhere(['status' => 3])->one()) {
                    $status = 3;
                } elseif (Access::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['appartment_id' => $this->id])->count() == 0) {
                    $status = 5;
                }
            }
        }


        return $status;
    }
}
