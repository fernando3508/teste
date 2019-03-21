<?php

use yii\db\Migration;

/**
 * Class m190320_193037_order_status
 */
class m190320_193037_order_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_status', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ]);

        $this->addForeignKey(
            'fk_order_status_id',
            'order',
            'order_status_id',
            'order_status',
            'id'
        );

        $inserts[] = [
            'name' => 'Procesando',
        ];

        $inserts[] = [
            'name' => 'Despachado',
        ];

        $inserts[] = [
            'name' => 'Cancelado',
        ];

        $inserts[] = [
            'name' => 'Completo',
        ];

        $inserts[] = [
            'name' => 'Negado',
        ];

        $inserts[] = [
            'name' => 'Cancelamento Revertido',
        ];

        $inserts[] = [
            'name' => 'Não Aprovado',
        ];

        $inserts[] = [
            'name' => 'Reembolsado',
        ];

        $inserts[] = [
            'name' => 'Cancelamento pela Operadora',
        ];

        $inserts[] = [
            'name' => 'Aguardando Pagamento',
        ];

        $inserts[] = [
            'name' => 'Anulado',
        ];

        $inserts[] = [
            'name' => 'Processado',
        ];

        $inserts[] = [
            'name' => 'Expirado',
        ];

        foreach ($inserts as $insert)
        {
            $this->insert('order_status', $insert);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190320_193037_order_status cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_193037_order_status cannot be reverted.\n";

        return false;
    }
    */
}
