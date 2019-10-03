<?php

use yii\db\Migration;

/**
 * Class m191003_205237_client_table_foreign_key
 */
class m191003_205237_client_table_foreign_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('logo', '{{%client%}}', 'logo_id', '{{%logo%}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('logo', '{{%client%}}');
    }
}
