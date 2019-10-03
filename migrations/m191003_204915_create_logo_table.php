<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%logo}}`.
 */
class m191003_204915_create_logo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%logo}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'size' => $this->double()->notNull(),
            'created_at' => $this->dateTime()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%logo}}');
    }
}
