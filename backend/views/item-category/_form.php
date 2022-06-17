<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ItemCategory;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ItemCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php
    $result = ArrayHelper::map(ItemCategory::find()->asArray()->all(), 'id', 'name');
    echo $form->field($model, 'parent_category')->dropDownList($result, ['id' => 'name', 'prompt' => 'Select parent category'])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
