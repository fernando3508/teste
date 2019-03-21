<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enderecos".
 *
 * @property int $id
 * @property int $city_id
 * @property int $state_id
 * @property int $customer_id
 * @property string $logradouro
 * @property string $numero
 * @property string $cep
 * @property string $complemento
 * @property string $bairro
 *
 * @property City $city
 * @property Customer $customer
 * @property State $state
 */
class Enderecos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enderecos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'state_id', 'logradouro', 'numero', 'cep', 'bairro'], 'required'],
            [['city_id', 'state_id', 'customer_id'], 'integer'],
            [['logradouro', 'numero', 'cep', 'complemento', 'bairro'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'Cidade',
            'state_id' => 'Estado',
            'customer_id' => 'Customer ID',
            'logradouro' => 'Endereço',
            'numero' => 'Nº',
            'cep' => 'CEP',
            'complemento' => 'Complemento',
            'bairro' => 'Bairro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    public function searchCep($cep)
    {
        $cep = str_replace('-', '', $cep);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://viacep.com.br/ws/". $cep ."/json/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $r = json_decode($result);

        if(isset($r->logradouro))
        {
            $state_id = State::find()->where(['uf' => $r->uf])->one()->id;
            $city_id = City::find()->where(['name' => $r->localidade, 'state_id' => $state_id])->one()->id;

            $dados = [
                'logradouro' => $r->logradouro,
                'bairro' => $r->bairro,
                'city_id' => $city_id,
                'state_id' => $state_id
            ];

            return $dados;
        }
        return NULL;
    }

    public function getEnderecoCompleto()
    {
        return $this->logradouro . ' nº ' . $this->numero . ' ' . $this->complemento;
    }

    public function getCidade()
    {
        return $this->city->name . ' - ' . ucwords($this->state->uf); 
    }
}
