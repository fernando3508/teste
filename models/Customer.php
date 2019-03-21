<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $cpf
 * @property string $email
 * @property string $tel
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 *
 * @property Enderecos[] $enderecos
 * @property Order[] $orders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'email', 'tel', 'cpf', 'last_name'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['first_name', 'last_name', 'cpf', 'email', 'tel'], 'string', 'max' => 255],
            ['email', 'email', 'message' => 'E-mail invalido.'],
            [['cpf', 'email'], 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Nome',
            'last_name' => 'Sobrenome',
            'cpf' => 'CPF',
            'email' => 'E-mail',
            'tel' => 'Celular',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnderecos()
    {
        return $this->hasMany(Enderecos::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }

    public function getNomeCompleto()
    {
        if($this->last_name != NULL)
        {
            return  ucfirst($this->first_name . ' ' . $this->last_name);
        }
        return ucfirst($this->first_name);
    }
}
