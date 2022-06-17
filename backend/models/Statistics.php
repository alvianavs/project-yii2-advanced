<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "statistics".
 *
 * @property int $id
 * @property string $access_time
 * @property string $user_ip
 * @property string $user_host
 * @property string $path_info
 * @property string $query_string
 */
class Statistics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statistics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['access_time', 'user_ip', 'user_host', 'path_info'], 'required'],
            [['access_time'], 'safe'],
            [['user_ip'], 'string', 'max' => 20],
            [['user_host', 'path_info', 'query_string'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'access_time' => 'Access Time',
            'user_ip' => 'User Ip',
            'user_host' => 'User Host',
            'path_info' => 'Path Info',
            'query_string' => 'Query String',
        ];
    }
    /**
     * record access log
     */
    public static function saveUserInfo()
    {
        $model = new Statistics();
        $model->user_ip = Yii::$app->request->userIP;
        $model->user_host = Yii::$app->request->hostInfo;
        $model->path_info = Yii::$app->request->pathInfo;
        $model->query_string = Yii::$app->request->queryString;
        $model->access_time = date('Y-m-d H:i:s');

        if ($model->validate()) {
            $model->save();
        }
    }
}