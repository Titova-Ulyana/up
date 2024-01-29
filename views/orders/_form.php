<?php

use app\models\Status;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */
/** @var yii\widgets\ActiveForm $form */
?>

<? $li=[]; $status=Status::find()->all();
 foreach ($status as $stat)
{ 
$li[$stat->id]=$stat->name; 
}

?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'status_order')->dropDownList($li) ?>

    <?//= $form->field($model, 'timestamp')->textInput() ?>

    <?= $form->field($model, 'comment')->textArea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранен', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
