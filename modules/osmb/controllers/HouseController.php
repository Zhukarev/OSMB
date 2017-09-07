<?php

namespace app\modules\osmb\controllers;

use app\modules\osmb\models\Access;
use app\modules\osmb\models\Appartment;
use app\modules\osmb\models\Benefit;
use app\modules\osmb\models\BenefitAppartment;
use app\modules\osmb\models\Raschet;
use Yii;
use app\modules\osmb\models\House;
use app\modules\osmb\models\HouseSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * HouseController implements the CRUD actions for House model.
 */
class HouseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

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

    /**
     * Displays a single House model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new House model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new House();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->addFlash('success', 'Успех! Приступите к заполнению данных по квартирам.');
            //var_dump($model->id);die;

            return $this->redirect(['filling', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionFilling($id)
    {

        $appartments = Appartment::find()->where(['house_id' => $id])->indexBy('id')->all();
        //    var_dump($appartments);die();

        foreach ($appartments as $appartment) {
            $appartment->scenario = Appartment::SCENARIO_FILLING;
        }
        if (!$appartments) {
            throw new NotFoundHttpException("The appartments was not found.");
        }
        $benefits = Benefit::find()->all();

        if (Model::loadMultiple($appartments, Yii::$app->request->post()) &&
            Model::validateMultiple($appartments)
        ) {
            foreach ($appartments as $key => $appartment) {
                if (!$appartment->save()) {
                    Yii::error(Json::encode($appartment->errors));
                } elseif ($appartment->benefit) {
                    $benefitAppartment = new BenefitAppartment();
                    $benefitAppartment->appartment_id = $appartment->id;
                    $benefitAppartment->benefit_id = $appartment->benefit;
                    $benefitAppartment->area_benefit = $appartment->areaBenefit;
                    if (!$benefitAppartment->save()) {
                        Yii::error(Json::encode($appartment->errors));
                        //  var_dump($benefitAppartment->errors);
                    }
                }

            }
            return $this->redirect(['index']);
//            die;
            //            return $this->redirect(['index']);

        }

        return $this->render('filling', [
            'appartments' => $appartments,
            'benefits' => $benefits,
        ]);

    }


    /**
     * Updates an existing House model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing House model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param $id - id(House)
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionNewRaschet($id)
    {
        switch ($this->findModel($id)->batchCreateRaschet($id)) {
            case 0:
                \Yii::$app->session->addFlash('info', 'Raschet on previous month not exist, you need entred debts');
                return $this->redirect(['dolg', 'id' => $id]);
                break;
            case 1:
                \Yii::$app->session->addFlash('warning', 'Raschet on previous month exist');
                return $this->redirect(['index']);
                break;
            case 2:
                \Yii::$app->session->addFlash('success', 'Raschet created');
                return $this->redirect(['index']);//TODO: redirect to raschet-house-month
                break;
        }
    }


    /**
     * Finds the House model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return House the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = House::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDolg($id)
    {

        $curr_year = (int)date('y');
        $curr_month = (int)date('m');
        if ($curr_month === 2) {
            $prev_prev_year = $curr_year - 1;
            $prev_prev_month = 12;
        } elseif ($curr_month === 1) {
            $prev_prev_year = $curr_year - 1;
            $prev_prev_month = 11;
        } else {
            $prev_prev_year = $curr_year;
            $prev_prev_month = $curr_month - 2;
        }

        $prev_prev_month = str_pad($prev_prev_month, 2, '0', STR_PAD_LEFT);
        $prev_prev_year = str_pad($prev_prev_year, 2, '0', STR_PAD_LEFT);

        $prev_prev_date = $prev_prev_year . $prev_prev_month;

        $raschets = Raschet::find()
            ->innerJoin('appartment a', "((raschet.appartment_id=a.id) AND (a.house_id = '" . (int)$id . "') AND (raschet.date='" . $prev_prev_date . "'))")
            ->indexBy('id')
            ->all();
//var_dump($raschets);die();

        if (Model::loadMultiple($raschets, Yii::$app->request->post()) &&
            Model::validateMultiple($raschets)
        ) {
            foreach ($raschets as $raschet) {
                if (!$raschet->save()) {
                    Yii::error(Json::encode($raschet->errors));
                }
            }
            return $this->redirect(['index']);
        }
        return $this->render('dolg', [
            'raschets' => $raschets,
        ]);
    }

    public function actionMonthDolg($house_id, $date = '')
    {

        $fixdate = $date ? substr($date, 2, 2) . substr($date, 5, 2) : date('ym');

        $raschets = Raschet::find()
            ->innerJoin('appartment a', "((raschet.appartment_id=a.id) AND (a.house_id = '" . (int)$house_id . "') AND (raschet.date='" . (int)$fixdate . "'))")
            ->indexBy('id')
            //    echo $raschets->createCommand()->getRawSql(); die;//возвращает SQL, all - не нужен
            ->all();
        $houses = House::find()->all();
        if (Model::loadMultiple($raschets, Yii::$app->request->post()) &&
            Model::validateMultiple($raschets)
        ) {
            foreach ($raschets as $raschet) {
                if (!$raschet->save()) {
                    Yii::error(Json::encode($raschet->errors));
                }
            }
            return $this->redirect(['index']);
        }
        return $this->render('month-dolg', [
            'raschets' => $raschets,
            'house_id' => $house_id,
            'date' => $date ? $date : date('Y-m'),
            'houses' => $houses,
        ]);
    }

    /**
     * @param $id - id(House)
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionHousePay($id)
    {
        $curr_year = (int)date('y');
        $curr_month = (int)date('m');
        if ($curr_month === 1) {
            $prev_year = $curr_year - 1;
            $prev_month = 12;
        } else {
            $prev_year = $curr_year;
            $prev_month = $curr_month - 1;
        }
        $prev_month = str_pad($prev_month, 2, '0', STR_PAD_LEFT);
        $prev_year = str_pad($prev_year, 2, '0', STR_PAD_LEFT);

        $prev_date = $prev_year . $prev_month;

        $raschets = Raschet::find()
            ->innerJoin('appartment a', 'a.id=raschet.appartment_id AND a.house_id = ' . (int)$id . ' AND raschet.date="' . $prev_date . '"')
            ->indexBy('id')
            ->all();
        var_dump($raschets);
        die();
        $benefits = Benefit::find()->all();
        $app_benefits = new BenefitAppartment();
        if (Model::loadMultiple($app_benefits, Yii::$app->request->post()) &&
            Model::validateMultiple($app_benefits)
        ) {
            foreach ($app_benefits as $app_benefit) {
                if (!$app_benefit->save()) {
                    Yii::error(Json::encode($app_benefit->errors));
                }
            }
            return $this->redirect(['index']);
        }
        return $this->render('dolg', [
            'benefits' => $benefits,
            'app_benefits' => $app_benefits,
        ]);
    }

    public function actionGrantSubsid($id)
    {
        $curr_year = (int)date('y');
        $curr_month = (int)date('m');
        if ($curr_month === 2) {
            $prev_prev_year = $curr_year - 1;
            $prev_prev_month = 12;
        } elseif ($curr_month === 1) {
            $prev_prev_year = $curr_year - 1;
            $prev_prev_month = 11;
        } else {
            $prev_prev_year = $curr_year;
            $prev_prev_month = $curr_month - 2;
        }

        $prev_prev_month = str_pad($prev_prev_month, 2, '0', STR_PAD_LEFT);
        $prev_prev_year = str_pad($prev_prev_year, 2, '0', STR_PAD_LEFT);

        $prev_prev_date = $prev_prev_year . $prev_prev_month;


        $appartments = Appartment::find()->where(['house_id' => $id])->indexBy('id')->all();

        $raschets = Raschet::find()
            ->innerJoin('appartment a', "((raschet.appartment_id=a.id) AND (a.house_id = '" . (int)$id . "') AND (raschet.date='" . $prev_prev_date . "'))")
            ->indexBy('appartment_id')
            ->all();

        if (Model::loadMultiple($appartments, Yii::$app->request->post()) &&
            Model::validateMultiple($appartments)
        ) {
            foreach ($appartments as $appartment) {
                if (!$appartment->save()) {
                    Yii::error(Json::encode($appartment->errors));
                }
            }
            return $this->redirect(['index']);
        }
        return $this->render('grant-subsid', [
            'raschets' => $raschets,
        ]);
    }


    public function actionUserIndex()
    {
        $searchModel = new HouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('user-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApply($id)
    {
        $appartments = Appartment::findAll(['house_id' => $id]);
        $isAccesses = (boolean)Access::find()->andWhere(['user_id'=>Yii::$app->user->id])->count();
        $isAccessesActive = (boolean)Access::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['status' => 2])->count();

        return $this->render('apply', [
            'appartments' => $appartments,
            'isAccesses' => $isAccesses,
            'isAccessesActive' => $isAccessesActive,
        ]);
    }

}
