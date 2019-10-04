<?php

use yii\db\Migration;

/**
 * Class m191003_215804_client_table_null_columns
 */
class m191003_215804_client_table_null_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%client%}}', 'logo_id', $this->integer()->null());
        $this->alterColumn('{{%client%}}', 'vat', $this->tinyInteger()->null());
        $this->alterColumn('{{%client%}}', 'description', $this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191003_215804_client_table_null_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191003_215804_client_table_null_columns cannot be reverted.\n";

        return false;
    }
    */
}
