<?php

use yii\db\Migration;

/**
 * Class m191003_135026_client_table
 */
class m191003_135026_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('client', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->null(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string(11)->notNull()->unique(),
            'vat' => $this->tinyInteger()->notNull()->defaultValue(0),
            'city_id' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'logo_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191003_135026_client_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191003_135026_client_table cannot be reverted.\n";

        return false;
    }
    */
}
