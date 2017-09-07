<?php
/**
 * Created by PhpStorm.
 * User: Vladimir
 * Date: 17.02.2017
 * Time: 2:31
 */

namespace app\modules\components;

use app\modules\osmb\models\House;

class Formatter extends \yii\i18n\Formatter
{
    public function asMyDate($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        $dateM = substr($value, -2);
        $dateY = substr($value, 0, -2);
        return '20' . $dateY . '-' . $dateM;
    }

    public function asMyBoolean($value)
    {
        if ($value == '1') {
            return '+';
        } else
            return '';
    }

    public function asMyHouse($value)
    {
        $houses = House::find()->all();
        foreach ($houses as $house) {
            if ($house->id == $value) {
                return $house->num_house;
            }
        }

    }

    public function asMyMoney($value)
    {
                return $value;

    }

}