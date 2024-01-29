

<?php

use app\models\Cart;
use app\models\Orders;
use app\models\Product;
use app\models\Status;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
//use Yii;
/** @var yii\web\View $this */
/** @var app\models\OrdersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?

$dataProvider->sort->defaultOrder=['timestamp' => SORT_DESC];


foreach($dataProvider->getModels() as $order)
{
  $user_id = Yii::$app->user->identity->id;
    if( $user_id == $order['user_id'])
    {
    $status = Status::find()->where(['id' => $order["status_order"]])->one();
    $carts = Cart::find()->where(['user_id' => $user_id])->andWhere(['orders_id' => $order['id']])->all();
    echo '<div class="card">
    <div class="card-header"> Заказ №'.$order["id"]
    .'</div>
    <div class="card-body">
      <h5 class="card-title">'.$status['name'].'</h5>';
      $price = 0;
      foreach($carts as $cart){
        $product = Product::findOne(['id' => $cart['product_id']]);
        $price = $product->price;
        echo '<div class ="card-body m-3"><h5 class = "card-title">'.$product->name_product.' ('.$product->color.')</h5><p class = "card-text">Количество: '.$cart["count"].' шт.</p><p class = "card-text">Цена: '.$price.' руб.</p></div>';

      }
      echo '<p class = "card-text">Дата оформления: '.$order["timestamp"].'</p>';
      echo  $order['status_order'] == 1 ? '<div onclick="del_ord()" class = "mt-2"><button class = "btn btn-danger">Удалить</button></div>' : '';
    echo '</div>
  </div> <br>';
    }

}






?>


</div>
