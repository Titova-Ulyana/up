<?php

use app\models\Cart;
use app\models\Orders;
use app\models\Product;
use app\models\Status;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\Dropdown;

/** @var yii\web\View $this */
/** @var app\models\OrdersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="dropdown">
    <a href="#" data-bs-toggle="dropdown" class="dropdown-toggle">Фильтр<b class="caret"></b></a>
    <?
    $items=[];
    $status = Status::find()->all();
    foreach ($status as $stat)
{
    $items[]=['label' => $stat['name'],'url' => 'https://up-titova.xn--80ahdri7a.site/orders?OrdersSearch[status_order]='.$stat['id']];
        
}
echo Dropdown::widget(['items' => $items]);
     ?>
 </div>



    <?/*
    foreach($dataProvider->getModels() as $order)
    {
        $user = User::find()->where(['id' => $order["user_id"]])->one();
        $status = Status::find()->where(['id' => $order["status_order"]])->one();
        $carts = Cart::find()->where(['orders_id' => $order['id']])->all();
        echo '<div class="card">
        <div class="card-header"> Заказ №'.$order["id"].'</div>
        <div class="card-body">
          <h5 class="card-title">Пользователь: '.$user["name"].$user["surname"].$user["patronymic"].'</h5>
          <p class = "card-text">Статус: '.$status['name'].'</p>';
          foreach($carts as $cart){
            $product = Product::findOne(['id' => $cart['product_id']]);
            echo '<div class ="card-body m-3"><h5 class = "card-title">'.$product->name_product.' ('.$product->color.')</h5><p class = "card-text">Количество: '.$cart["count"].' шт.</p></div>';
    
          }
          echo '<p class = "card-text">Дата оформления: '.$order["timestamp"].'</p>';
          echo  '<div class = "mt-2"><button onclick="upd_ord()" class = "btn btn-danger">Изменить заказ</button></div>
          </div>
      </div> <br>';
        }
    
    */
    ?>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            ['attribute'=>'ФИО', 'value'=>function($data){ 
               $fio = $data->getUser()->One()->surname .' '. $data->getUser()->One()->name .' '. $data->getUser()->One()->patronymic;
               
               return $fio;}],


            ['attribute'=>'Продукт',
            'value'=>function($data){
                foreach($data as $orders)
                {
                    $prod ='';
                    $carts = $data->getCarts()->all();
                    foreach($carts as $cart){
                        $product = Product::findOne(['id' => $cart['product_id']]);

                        $prod =$prod. $product->name_product . '('. $cart->count . ' шт.); ';
                    }
                }
                return ($prod);
            }],

            //['attribute'=>'Товар', 'value'=>function($data){return $data->getCarts()->One()->id;}],

            ['attribute'=>'Статус', 'value'=>function($data){return $data->getStatus()->One()->name;}],
            'timestamp',
            'comment',
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Orders $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

<script src=../js/script.js></script>


</div>
