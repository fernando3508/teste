<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_products".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quatity
 * @property string $price
 * @property string $total
 *
 * @property Order $order
 * @property Product $product
 */
class OrderProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'quatity'], 'integer'],
            [['product_id', 'quatity'], 'required'],
            [['price', 'total'], 'number'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Produto',
            'quatity' => 'Quantidade',
            'price' => 'Preço',
            'total' => 'Total',
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $this->calcTotal();
            return true;
        }
        return false;
    }

    public function calcTotal()
    {
        if(!is_null($this->quatity) && ($this->price = $this->product->price) != NULL)
        {
            $this->total = $this->price * $this->quatity;
        }
    }

    public function getTotalPreco()
    {
        return $this->total != NULL ? number_format($this->total, 2, ',', '.') : '0,00';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
