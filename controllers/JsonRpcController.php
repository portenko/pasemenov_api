<?php

namespace app\controllers;
use \georgique\yii2\jsonrpc\Controller;
use yii\filters\auth\QueryParamAuth;

/**
 * Class JsonRpcController
 * @package app\controllers
 */
class JsonRpcController extends Controller
{
    public $paramsPassMethod = self::JSON_RPC_PARAMS_PASS_BODY;

    /**
     * @return array|array[]
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['POST'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => null,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => [
                    'X-Pagination-Current-Page',
                    'X-Pagination-Page-Count',
                    'X-Pagination-Per-Page',
                    'X-Pagination-Total-Count',
                ],
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
        ];
        return $behaviors;
    }
}