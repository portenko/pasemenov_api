<?php

namespace app\modules\v1\controllers;

use app\models\Data;
use georgique\yii2\jsonrpc\exceptions\JsonRpcException;

/**
 * Class DataController
 * @package app\modules\v1\controllers
 */
class DataController  extends \yii\web\Controller
{
    /**
     * @return array
     * @throws JsonRpcException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate()
    {
        $params = \Yii::$app->request->getBodyParams();
        return Data::updateFields($params);
    }

    /**
     * @return array
     * @throws JsonRpcException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionView()
    {
        $params = \Yii::$app->request->getBodyParams();
        return Data::getFields($params);
    }

}
