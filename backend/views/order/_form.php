<?php

use common\models\Customer;
use common\models\Item;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $result = ArrayHelper::map(Item::find()->asArray()->all(), 'id', 'name');
    echo $form->field($modelOrderItem, 'item_id')->dropDownList($result, ['id' => 'name', 'prompt' => 'Select item'])
    ?>

    <?php
    $result = ArrayHelper::map(Customer::find()->asArray()->all(), 'id', 'nama');
    echo $form->field($model, 'customer_id')->dropDownList($result, ['id' => 'nama', 'prompt' => 'Select customer'])
    ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
