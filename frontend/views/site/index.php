<?php

/** @var yii\web\View $this */

use PharIo\Manifest\Url;
use yii\helpers\Html;

$this->title = 'MyMart';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Let's Shopping!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">
        <div class="row">
            <?php foreach($products as $product) : ?>
            <div class="col-lg-3">
                <div class="card">
                    <?= Html::img('@web/img/'.$product->img, [
                        'class' => 'card-img-top img-cover',
                    ]) ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $product->name ?></h5>
                        <p class="card-text"><?= $product->category->name ?></p>
                        <p class="card-text font-weight-bold text-success"><?= $product->getRpPrice() ?></p>
                        <a href="/site/order?id=<?= $product->id ?>" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
