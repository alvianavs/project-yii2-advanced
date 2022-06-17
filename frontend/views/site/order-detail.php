<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail order';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                    <?= Html::img('@web/img/'.$model->img, [
                        'class' => 'card-img-top img-cover',
                    ]) ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $model->name ?></h5>
                        <p class="card-text"><?= $model->category->name ?></p>
                        <p class="card-text font-weight-bold text-success"><?= $model->getRpPrice() ?></p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Konfirmasi pemesanan</h5>
                        <p class="card-text">Kamu akan pesan <?= $model->name ?>. Klik order untuk setuju,</p>
                        <a href="/site" class="btn btn-danger">Cancel</a>
                        <a href="/site/order-product?id=<?= $model->id ?>" class="btn btn-success">Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
