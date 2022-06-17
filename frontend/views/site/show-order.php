<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
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
                'attribute' => 'order_id',
            ],
            [
                'label' => 'Tanggal order',
                'attribute' => 'order.date',
                'value' => function($model) {
                    return Yii::$app->formatter->asDate($model->order->date, 'd MMMM Y');
                }
            ],
            [
                'label' => 'Nama Customer',
                'attribute' => 'order.customer.nama',
            ],
            [
                'label' => 'Nama Item',
                'attribute' => 'item.name',
            ],
            [
                'label' => 'Harga',
                'attribute' => 'item.price',
                'value' => function($model) {
                    return $model->item->getRpPrice();
                }
            ],
            [
                'label' => 'Category',
                'attribute' => 'item.category.name',
            ],
        ],
    ]); ?>


</div>
