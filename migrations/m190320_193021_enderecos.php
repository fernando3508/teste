<?php

use yii\db\Migration;

/**
 * Class m190320_193021_enderecos
 */
class m190320_193021_enderecos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('enderecos', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(),
            'state_id' => $this->integer(),
            'customer_id' => $this->integer(),
            'logradouro' => $this->string(),
            'numero' => $this->string(),
            'cep' => $this->string(),
            'complemento' => $this->string(),
            'bairro' => $this->string()
        ]);

        $this->addForeignKey(
            'fk_enderecos_state_id',
            'enderecos',
            'state_id',
            'state',
            'id'
        );

        $this->addForeignKey(
            'fk_enderecos_city_id',
            'enderecos',
            'city_id',
            'city',
            'id'
        );


        $this->addForeignKey(
            'fk_enderecos_customer_id',
            'enderecos',
            'customer_id',
            'customer',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190320_193021_enderecos cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_193021_enderecos cannot be reverted.\n";

        return false;
    }
    */
}
