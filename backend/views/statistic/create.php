<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Statistics */

$this->title = 'Create Statistics';
$this->params['breadcrumbs'][] = ['label' => 'Statistics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
