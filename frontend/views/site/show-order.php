<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pesanan '.Yii::$app->user->identity->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Order ID',
                'attribute' => 'id',
            ],
            [
                'label' => 'Tanggal order',
                'value' => function($model) {
                    return Yii::$app->formatter->asDate($model->date, 'd MMMM Y');
                }
            ],
            [
                'label' => 'Nama Customer',
                'attribute' => 'customer.nama',
            ],
            [
                'label' => 'Nama Item',
                'value' => function($model) {
                    return $model->orderItems[0]->item->name;
                }
            ],
            [
                'label' => 'Harga',
                'value' => function($model) {
                    return $model->orderItems[0]->item->getRpPrice();
                }
            ],
            [
                'label' => 'Category',
                'value' => function($model) {
                    return $model->orderItems[0]->item->category->name;
                }
            ],
        ],
    ]); ?>


</div>
