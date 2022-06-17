<?php

use backend\models\ItemCategory;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?php
    $result = ArrayHelper::map(ItemCategory::find()->asArray()->all(), 'id', 'name');
    echo $form->field($model, 'category_id')->dropDownList($result, ['id' => 'name', 'prompt' => 'Select category name'])
    ?>
    
    <?= $form->field($model, 'file_img')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
