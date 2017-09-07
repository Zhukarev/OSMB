<?php

namespace app\modules\osmb\controllers;

use app\modules\osmb\models\Appartment;
use Yii;
use app\modules\osmb\models\Access;
use app\modules\osmb\models\AccessSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccessController implements the CRUD actions for Access model.
 */
class AccessController extends Controller
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
     * Lists all Access models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccessSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Access model.
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
     * Creates a new Access model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Access();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Access model.
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
     * Deletes an existing Access model.
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
     * Finds the Access model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Access the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Access::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionDeleteAccess($id)
    {

        $house = Appartment::find()->andWhere(['id' => $id])->one();

        $acces = Access::find()->andWhere(['appartment_id' => $id])->andWhere(['user_id'=>Yii::$app->user->id])->one();
        $acces->delete();

        return $this->redirect(['/osmb/house/apply', 'id' => $house->house_id]);
    }

    public function actionCreateAccess($id)
    {

        $house = Appartment::find()->andWhere(['id' => $id])->one();


        $cur_day = str_pad((int)date('d'), 2, '0', STR_PAD_LEFT);
        $cur_month = str_pad((int)date('m'), 2, '0', STR_PAD_LEFT);
        $cur_year = str_pad((int)date('y'), 2, '0', STR_PAD_LEFT);

        $date = $cur_year . $cur_month . $cur_day;

        $model = new Access();
        $model->status = 2;
        $model->user_id = Yii::$app->user->id;
        $model->appartment_id = $id;
        $model->date_create = $date;

        $model->save();

        return $this->redirect(['/osmb/house/apply', 'id' => $house->house_id]);
    }

    public function actionExistAccess()
    {

        $cur_day = str_pad((int)date('d'), 2, '0', STR_PAD_LEFT);
        $cur_month = str_pad((int)date('m'), 2, '0', STR_PAD_LEFT);
        $cur_year = str_pad((int)date('y'), 2, '0', STR_PAD_LEFT);

        $date = $cur_year . $cur_month . $cur_day;

        $exist = Access::find()->innerJoin('appartment a', "((a.id=access.appartment_id) AND (access.status = '2'))")->indexBy('id')->all();
        $existcount = Access::find()->innerJoin('appartment a', "((a.id=access.appartment_id) AND (access.status = '2'))")->count();

        if (Access::loadMultiple($exist, Yii::$app->request->post()) &&
            Access::validateMultiple($exist)
        ) {
            foreach ($exist as $item) {
                $item->date_change = $date;
                if (!$item->save()) {
                    Yii::error(Json::encode($item->errors));
                }
            }
            return $this->render('exist-access', [
                'exist' => $exist,
                'existcount' => $existcount,
            ]);
        }

        return $this->render('exist-access', [
            'exist' => $exist,
            'existcount' => $existcount,
        ]);
    }

    public function actionAppartmentsView()
    {
    $appartments = Appartment::find()->innerJoin('access a', "((appartment.id = a.appartment_id) AND (a.status IN (1, 2, 3)) AND(a.user_id = '". Yii::$app->user->id . "'))")
        ->all();
        return $this->render('appartments-view',[
            'appartments'=>$appartments,
        ]);
    }

    public function actionDeleteRecuest($id)
    {
    if(Access::find()->andWhere(['user_id'=>Yii::$app->user->id])->andWhere(['status'=>'3'])){
        self::actionDelete($id);
    }
        return $this->redirect('/osmb/house/user-index');
    }

}
