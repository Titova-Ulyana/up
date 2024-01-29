<?php

use app\controllers\ProductController;
use app\models\Category;
use app\models\Product;
use app\models\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap5\Dropdown;


/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Каталог товаров';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="dropdown">
    <a href="#" data-bs-toggle="dropdown" class="dropdown-toggle">Фильтр<b class="caret"></b></a>
    <?php
    $items=[];
    $categories=Category::find()->all();
    foreach ($categories as $category)
    { 
        $items[]=['label' => $category['name_category'],'url' => 'https://up-titova.xn--80ahdri7a.site/product/catalog?ProductSearch[category_id]='.$category['id']];
    }
        echo Dropdown::widget(['items' => $items]);
     ?>
 </div>


<div class="dropdown">
    <a href="#" data-bs-toggle="dropdown" class="dropdown-toggle">Сортировать по цене<b class="caret"></b></a>
    <?php
        echo Dropdown::widget([
            'items' => [
                ['label' => 'По возрастанию', 'url' => 'https://up-titova.xn--80ahdri7a.site/product/catalog?sort=price'],
                ['label' => 'По убыванию', 'url' => 'https://up-titova.xn--80ahdri7a.site/product/catalog?sort=-price'],
            ],
        ]);
    ?>
</div>

<div class="dropdown">
    <a href="#" data-bs-toggle="dropdown" class="dropdown-toggle">Сортировать по наименованию<b class="caret"></b></a>
    <?php
        echo Dropdown::widget([
            'items' => [
                ['label' => 'По возрастанию', 'url' => 'https://up-titova.xn--80ahdri7a.site/product/catalog?sort=name_product'],
                ['label' => 'По убыванию', 'url' => 'https://up-titova.xn--80ahdri7a.site/product/catalog?sort=-name_product'],
            ],
        ]);
    ?>
</div>

<div class="dropdown">
    <a href="#" data-bs-toggle="dropdown" class="dropdown-toggle">Сортировать по стране-производителя<b class="caret"></b></a>
    <?php
        echo Dropdown::widget([
            'items' => [
                ['label' => 'По возрастанию', 'url' => 'https://up-titova.xn--80ahdri7a.site/product/catalog?sort=country'],
                ['label' => 'По убыванию', 'url' => 'https://up-titova.xn--80ahdri7a.site/product/catalog?sort=-country'],
            ],
        ]);
    ?>
</div>



<!--<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <div class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="rgu">
      <button class="btn btn-outline-success" type="submit" onclick="ser()">Search</button>
</div>
  </div>
</nav>-->




<?
$dataProvider->sort->defaultOrder=['timestamp' => SORT_DESC];

$products=$dataProvider->getModels();
echo "<div class='d-flex flex-row flex-wrap justify-content-start align-items-end'>";
foreach ($products as $product){
 if ($product->count>0) {
 echo "<div class='card m-1' style='width: 22%; min-width: 300px;'>
 <a href='/product/view?id={$product->id}'><img src='{$product->photo}' class='card-img-top' style='max-height: 300px;' alt='image'></a>
 <div class='card-body'>
 <h5 class='card-title'>{$product->name_product}</h5>
 <p class='card-text'>{$product->price} руб</p>";

 echo (Yii::$app->user->isGuest ? "<a href='/product/view?id={$product->id}' class='btn btn-primary'>Просмотр товара</a>":"<p onclick='add_product({$product->id})' class='btn btn-primary'>Добавить в корзину</p>");
 echo "</div>
</div>";}
}
echo "</div>";

?>
<script src=../js/script.js></script>




<!--<script>
function ser(){
    let f = document.getElementById('rgu');

    window.location.href = "https://up-titova.xn--80ahdri7a.site/product/catalog?ProductSearch[name_product]=" + f.value;
}
</script> -->
