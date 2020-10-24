<?php

namespace app\models;

use georgique\yii2\jsonrpc\exceptions\JsonRpcException;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;

/**
 * This is the model class for table "data".
 *
 * @property int $id
 * @property string $fields
 * @property string|null $page_uid
 * @property int $created
 */
class Data extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%data}}';
    }

    /**
     * @return array|string[]
     */
    public function behaviors()
    {
         return [
             [
                 'class' => TimestampBehavior::class,
                 'createdAtAttribute' => 'created',
                 'updatedAtAttribute' => false,
             ],
         ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fields'], 'required'],
            [['fields'], 'string'],
            [['created'], 'integer'],
            [['page_uid'], 'string', 'max' => 255],
            [['page_uid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fields' => 'Fields',
            'page_uid' => 'Page Uid',
            'created' => 'Created',
        ];
    }

    /**
     * @param $params
     * @return array
     * @throws JsonRpcException
     */
    public static function getFields($params)
    {
        if(empty($params['page_uid'])){
            throw new JsonRpcException('Invalid params', -32602);
        }
        $model = self::findOne(['page_uid' => $params['page_uid']]);
        if($model){
            return [
                'page_uid' => $model->page_uid,
                'fields' => Json::decode($model->fields),
                'created' => $model->created
            ];
        }
        throw new JsonRpcException("Data not found", -32000);
    }

    /**
     * @param $params
     * @return array
     * @throws JsonRpcException
     */
    public static function updateFields($params)
    {
        if(empty($params['page_uid']) || empty($params['fields'])){
            throw new JsonRpcException('Invalid params', -32602);
        }
        $page_uid = $params['page_uid'];
        $fields = $params['fields'];
        $model = self::findOne(['page_uid' => $page_uid]);
        if(!$model){
            throw new JsonRpcException("Data not found", -32000);
        }
        $attributes = Json::decode($model->fields);
        foreach ($fields as $field) {
            foreach($attributes as $key => $attribute){
                if($attribute['name'] === $field['name']){
                    $attributes[$key]['value'] = $field['value'];
                }
            }
        }
        $model->fields = Json::encode($attributes);
        if($model->save()){
            return [
                'page_uid' => $model->page_uid,
                'fields' => Json::decode($model->fields),
                'created' => $model->created
            ];
        }
        else {
            throw new JsonRpcException("Data save error", -32001, $model->errors);
        }
    }
}
