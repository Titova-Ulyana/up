<?php

namespace app\controllers;
use app\models\Orders;
use app\models\Cart;
use app\models\CartSearch;
use app\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    public function beforeAction($action)
    { 
        if (Yii::$app->user->isGuest){ 
        $this->redirect(['site/login']); return false; 
        } else return true; 


        //отключение проверки токена csrf
        if ($action->id=='create' && $action->id=='createcart') $this->enableCsrfValidation=false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Cart models.
     *
     * @return string
     */

     public function actionPlus()
     {
        $id=Yii::$app->request->post('id');
            $product=Product::findOne($id);
            if($product == null) return 'false';
            if($product->count > 0)
            {
                $product->count -= 1;
                $product->save(false);
                
                $cart=Cart::find()->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['product_id'=>$id])->andWhere(['orders_id'=>null])->one();
                if($cart !== null){
                    $cart->count += 1;
                    $cart->save(false);
                    return 'true';
                }
            } else return 'false';
     }

     public function actionMinus()
     {
        $id=Yii::$app->request->post('id');
        $cart=Cart::find()->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['product_id'=>$id])->andWhere(['orders_id'=>null])->one();
            if($cart == null) return 'false';
            if($cart->count > 1)
            {
                $cart->count -= 1;
                $cart->save(false);
            }else if ($cart->count == 1)
                {
                    $cart->delete();
                }  else return 'false';  
            $product=Product::findOne($id);
            if($product !== null){
                $product->count += 1;
                $product->save(false);
                    return 'true';
            }
            else return 'false';
     }


    public function actionIndex()
    {
        $searchModel = new CartSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Cart model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {        
        $product_id=Yii::$app->request->post('product_id');
        $items=1;
        $product=Product::findOne($product_id);
        
        if(!$product) return 'false';
        if($product->count > 0)
        {
            $product->count -= $items;
            $product->save(false);

            $cart=Cart::find()->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['product_id'=>$product_id])->andWhere(['orders_id'=>null])->one();
            if($cart !== null){
                $cart->count += $items;
                $cart->save(false);
                return $product->count;
            }

            $model = new Cart();
            $model->user_id=Yii::$app->user->identity->id;
            $model->product_id=$product->id;
            $model->count=$items;

            if ($model->save(false)) 
            return $product->count; 
       
        }
    return 'false';

    }



        /*$model = new Cart();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cart::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
