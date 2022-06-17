<?php
namespace backend\components;
use yii\base\Component;

class RecordStatistic extends Component
{
    const EVENT_AFTER_SOMETHING = "after-something";

    public function record() {
        \backend\models\Statistics::saveUserInfo();
    }
}