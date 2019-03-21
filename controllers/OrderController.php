<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\SearchOrder;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\base\Model;
use app\models\OrderProducts;
use yii\widgets\ActiveForm;
use app\models\SearchOrderProducts;
use yii\helpers\ArrayHelper;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchOrder();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new SearchOrderProducts();
        $searchModel->order_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
        $modelProducts = [new OrderProducts];

        if ($model->load(Yii::$app->request->post())) 
        {
            $modelProducts = Model::createMultiple(OrderProducts::classname());
            Model::loadMultiple($modelProducts, Yii::$app->request->post());

            $valid = $model->validate();

            if($valid)
            {
                $transaction = \Yii::$app->db->beginTransaction();

                try {

                    if($flag = $model->save(false))
                    {
                        foreach ($modelProducts as $modelProduct) 
                        {
                            $modelProduct->order_id = $model->id;
                            $modelProduct->price = '1';
                            if(!($flag = $modelProduct->save(false)))
                            {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }

                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            
        }

        return $this->render('create', [
            'model' => $model,
            'modelProducts' => (empty($modelProducts)) ? [new OrderProducts] : $modelProducts
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelProducts = $model->orderProducts;

        if($model->load(Yii::$app->request->post()))
        {
            $oldIDs = ArrayHelper::map($modelProducts, 'id', 'id');
            $modelProducts = Model::createMultiple(OrderProducts::className(), $modelProducts);
            Model::loadMultiple($modelProducts, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelProducts, 'id', 'id')));

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelProducts) && $valid;

            if($valid)
            {
                $transaction = Yii::$app->db->beginTransaction();

                try {
                    
                    if($flag = $model->save(false))
                    {

                        if(!empty($deletedIDs))
                        {
                            OrderProducts::deleteAll(['id' => $deletedIDs]);
                        }

                        foreach ($modelProducts as $modelProduct) 
                        {
                            $modelProduct->order_id = $id;
                            $modelProduct->price = '1';
                            if(!($flag = $modelProduct->save(false)))
                            {
                                print_r($modelProduct->getErrors());
                                $transaction->rollBack();
                                break;
                            }
                        }

                    }

                    if($flag)
                    {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }

                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

        }

        return $this->render('update', [
            'model' => $model,
            'modelProducts' => (empty($modelProducts)) ? [new OrderProducts] : $modelProducts
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
