<?php

use yii\db\Migration;

/**
 * Class m191003_191550_client_table_foreign_key
 */
class m191003_191550_client_table_foreign_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('city', '{{%client%}}', 'city_id', '{{%city%}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191003_191550_client_table_foreign_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191003_191550_client_table_foreign_key cannot be reverted.\n";

        return false;
    }
    */
}
