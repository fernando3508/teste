<?php

use yii\db\Migration;

/**
 * Class m190320_193006_state
 */
class m190320_193006_state extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('state', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'uf' => $this->string()
        ]);

        $inserts[] = [
            'name' => 'Acre',
            'uf' => 'AC'
        ];

        $inserts[] = [
            'name' => 'Alagoas',
            'uf' => 'AL'
        ];

        $inserts[] = [
            'name' => 'Amazonas',
            'uf' => 'AC'
        ];

        $inserts[] = [
            'name' => 'Amapá',
            'uf' => 'AP'
        ];

        $inserts[] = [
            'name' => 'Bahia',
            'uf' => 'BA'
        ];

        $inserts[] = [
            'name' => 'Ceará',
            'uf' => 'CE'
        ];

        $inserts[] = [
            'name' => 'Distrito Federal',
            'uf' => 'DF'
        ];

        $inserts[] = [
            'name' => 'Espirito Santo',
            'uf' => 'ES'
        ];

        $inserts[] = [
            'name' => 'Goiás',
            'uf' => 'GO'
        ];

        $inserts[] = [
            'name' => 'Maranhão',
            'uf' => 'MA'
        ];

        $inserts[] = [
            'name' => 'Minas Gerais',
            'uf' => 'MG'
        ];

        $inserts[] = [
            'name' => 'Mato Grosso do Sul',
            'uf' => 'MS'
        ];

        $inserts[] = [
            'name' => 'Mato Grosso',
            'uf' => 'MT'
        ];

        $inserts[] = [
            'name' => 'Pará',
            'uf' => 'PA'
        ];

        $inserts[] = [
            'name' => 'Paraiba',
            'uf' => 'PB'
        ];

        $inserts[] = [
            'name' => 'Pernambuco',
            'uf' => 'PE'
        ];

        $inserts[] = [
            'name' => 'Piaui',
            'uf' => 'PI'
        ];

        $inserts[] = [
            'name' => 'Paraná',
            'uf' => 'PR'
        ];

        $inserts[] = [
            'name' => 'Rio de Janeiro',
            'uf' => 'RJ'
        ];

        $inserts[] = [
            'name' => 'Rio Grande do Norte',
            'uf' => 'RN'
        ];

        $inserts[] = [
            'name' => 'Rondônia',
            'uf' => 'RO'
        ];

        $inserts[] = [
            'name' => 'Roraima',
            'uf' => 'RR'
        ];

        $inserts[] = [
            'name' => 'Rio Grande do Sul',
            'uf' => 'RS'
        ];

        $inserts[] = [
            'name' => 'Santa Catarina',
            'uf' => 'SC'
        ];

        $inserts[] = [
            'name' => 'Sergipe',
            'uf' => 'SE'
        ];

        $inserts[] = [
            'name' => 'São Paulo',
            'uf' => 'SP'
        ];

        $inserts[] = [
            'name' => 'Tocantins',
            'uf' => 'TO'
        ];

        \Yii::$app->db->createCommand()->batchInsert(app\models\State::tableName(), ['name', 'uf'], $inserts)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190320_193006_state cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_193006_state cannot be reverted.\n";

        return false;
    }
    */
}
