<?php

/** @var yii\web\View $this */


use app\models\Product;
use yii\helpers\Html;
use yii\bootstrap5\Carousel;

$this->title = 'О нас';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php

$articles=Product::find()->orderBy(['timestamp'=>SORT_DESC])->limit(5)->all();
$items=[];

foreach($articles as $article)
{
    $items[]="<div class='fon m-2 p-2 d-flex flex-column justify-content-center'>
    <h1 class='text-primary text-center m-2'>{$article->name_product}</h1>
    <img class='m-auto w-25' src='../../..{$article->photo}' alt='photo' /></div>";
}
echo "";
 echo Carousel::widget([
     'items' => $items
 ]);
?>
</div>
