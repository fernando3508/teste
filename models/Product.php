<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property string $sku
 * @property string $price
 * @property string $width
 * @property string $height
 * @property int $enable
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 *
 * @property OrderProducts[] $orderProducts
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'enable', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['description'], 'string'],
            [['price'], 'required'],
            //[['price'], 'number'],
            [['name', 'sku', 'width', 'height'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            ['sku', 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Categoria',
            'name' => 'Name',
            'description' => 'Descrição',
            'sku' => 'Codigo',
            'price' => 'Preço',
            'width' => 'Largura',
            'height' => 'Altura',
            'enable' => 'Status',
            'created_at' => 'Data',
            'updated_at' => 'Atualizado',
            'deleted_at' => 'Deleted At',
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $this->price = $this->price != NULL && $this->price != '0,00' ? str_replace(',', '.', str_replace('.', '', $this->price)) : NULL;

            if($this->isNewRecord)
            {
                $this->created_at = strtotime('NOW');
            }
            return true;
        }
        return false;
    }

    public function delete()
    {
        $this->deleted_at = strtotime('NOW');
        $this->save();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProducts::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getPreco()
    {
        return $this->price != NULL ? number_format($this->price, 2, ',', '.') : '0,00';
    }
}
