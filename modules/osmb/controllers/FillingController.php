<?php

namespace app\modules\osmb\controllers;

use app\modules\osmb\models\Appartment;
use app\modules\osmb\models\Benefit;
use Yii;
use app\modules\osmb\models\HouseSearch;
use yii\web\Controller;

/**
 * HouseController implements the CRUD actions for House model.
 */
class FillingController extends Controller
{

    /**
     * Lists all House models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFilling($id)
    {
        $appartments = Appartment::find()->where(['house_id' => $id])->all();
        $benefit = Benefit::find()->all();
        return $this->render('filling', [
            'appartments' => $appartments,
            'benefit' => $benefit,
        ]);

    }

}
