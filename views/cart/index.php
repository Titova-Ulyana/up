<?php

use app\models\Cart;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var app\models\CartSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <? $carts=$dataProvider->getModels();
        echo "<div id='card'><div class='d-flex flex-row flex-wrap justify-content-start align-items-end'>";
            $user_id=Yii::$app->user->identity->id;
            foreach ($carts as $cart){
                if (($cart->orders_id == null) && ($user_id == $cart->user_id)){
                    $product = Product::findOne(['id' => $cart->product_id]);
                    $count = $cart->count;
            echo "<div class='card m-1' style='width: 22%; min-width: 300px;'>
                    <div class='card-body'>
                        <h5 class='card-title' >{$product->name_product}</h5>
                        
                        
                        <div class='row g-3 align-items-center'>
                            <div class='col-auto'>
                                <button type='button' onclick='minus_count($product->id)' class='btn btn-primary'>-</button>
                            </div>
                            <div class='col-auto'>
                                <div class='card-text'>{$count} шт</div>
                            </div>
                            <div class='col-auto'>
                                <button type='button' onclick='plus_count($product->id)' class='btn btn-primary'>+</button>
                            </div>
                        </div>
                    </div>
                </div>
            ";
    }
}
echo ((($cart->orders_id == null) && ($user_id == $cart->user_id)) ? " </div><br>

<div class='row g-3 align-items-center'>
<div class='col-auto'>
  <label for='pass' class='col-form-label'>Введите пароль</label>
</div>
<div class='col-auto'>
    <input type='password' id='pass' class='form-control' >
</div>
<div class='col-auto'>
    <button type='button' onclick='create_order()' class='btn btn-primary'>Создать заказ</button>
</div>
</div>

</div>
":"<p class='text-center'>Корзина пуста</p>");

    ?>

<script src=../js/script.js></script>
</div>
