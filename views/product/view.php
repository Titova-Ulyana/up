<?php

use app\models\Category;
use app\models\Product;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name_product;
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?//= Html::a('Delete', ['delete', 'id' => $model->id], [
            /*'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>




<div class="card mb-3" style="max-width: 1000px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="../..<?echo $model->photo?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?echo $model->name_product?></h5>
        <p class="card-text">Цена: <?echo $model->price?></p>
        <p class="card-text"><b>Характеристики:</b></p>
        <p class="card-text">Цвет: <?echo $model->color?></p>
        <p class="card-text">Страна-производитель: <?echo $model->country?></p>
        <?$category=Category::findOne($model->category_id);?>
        <p class="card-text">Вид товара: <?echo $category->name_category?></p>
      </div>
    </div>
  </div>
</div>


<?
if(Yii::$app->user->isGuest){}
else echo "<p onclick='add_product({$model->id})' class='btn btn-primary'>Добавить в корзину</p>";
 ?>

<script src=../js/script.js></script>

    <?/*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name_product',
            'photo',
            'count',
            'price',
            'country',
            'color',
            'category_id',
        ],
    ]) */?>

</div>
