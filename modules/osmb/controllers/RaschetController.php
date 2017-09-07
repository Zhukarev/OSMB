<?php

namespace app\modules\osmb\controllers;

use app\modules\osmb\models\Access;
use Yii;
use app\modules\osmb\models\Raschet;
use app\modules\osmb\models\RaschetSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RaschetController implements the CRUD actions for Raschet model.
 */
class RaschetController extends Controller
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
     * Lists all Raschet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RaschetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Raschet model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Raschet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Raschet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Raschet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Raschet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Raschet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Raschet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Raschet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionViewAppartment($id)
    {
        $choice = 0;

        switch (Access::find()->innerJoin('raschet r', "((access.appartment_id = r.appartment_id) AND (access.user_id = '" . Yii::$app->user->id . "') AND(access.appartment_id = '" . (int)$id . "') )")->one()->status) {
            case 1:
                $raschets = Raschet::find()->innerJoin('access a', "((a.appartment_id = raschet.appartment_id) AND (a.user_id = '" . Yii::$app->user->id . "') AND (a.status = '1') AND(a.appartment_id = '" . (int)$id . "') )")
                    ->orderBy(['date' => SORT_DESC])
                    //        ->andWhere(['access.status'=>'1'])
                    ->indexBy('date')
                    ->all();
                $choice = 1;
                break;
            case 3:
                $raschets = Access::find()->andWhere(['appartment_id' => $id])->andWhere(['user_id' => Yii::$app->user->id])->one();
//                $raschets = Access::find()->innerJoin('apparyment a', "((a.appartment_id = raschet.appartment_id) AND (a.user_id = '" . Yii::$app->user->id . "') AND (a.status = '1') AND(a.appartment_id = '" . (int)$id . "') )")
//                    ->one();
                $choice = 3;
                break;
            case 4:
                $raschets = Access::find()->andWhere(['appartment_id' => $id])->andWhere(['user_id' => Yii::$app->user->id])->one();
                $choice = 4;
                break;
            default:
                $raschets = Access::find()->andWhere(['appartment_id' => $id])->andWhere(['user_id' => Yii::$app->user->id])->one();
                break;
        }
        return $this->render('view-appartment', [
            'raschets' => $raschets,
            'choice' => $choice,
        ]);


        /*  if (!Raschet::find()->innerJoin('access a', "((a.appartment_id = raschet.appartment_id) AND (a.user_id = '" . Yii::$app->user->id . "') AND (a.status = '1') AND(a.appartment_id = '" . (int)$id . "') )")) {
              $statusApp = Access::find()->andWhere(['appartment_id' => $id])->one();
              return $this->render('view-appartment', [
                  'statusApp' => $statusApp
              ]);
          } else {
              $raschets = Raschet::find()->innerJoin('access a', "((a.appartment_id = raschet.appartment_id) AND (a.user_id = '" . Yii::$app->user->id . "') AND (a.status = '1') AND(a.appartment_id = '" . (int)$id . "') )")
                  ->orderBy(['date' => SORT_DESC])
                  //        ->andWhere(['access.status'=>'1'])
                  ->indexBy('date')
                  ->all();
              return $this->render('view-appartment', [
                  'raschets' => $raschets,
              ]);

          }*/
    }

}
