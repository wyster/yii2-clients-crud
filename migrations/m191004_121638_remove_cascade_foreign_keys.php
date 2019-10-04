<?php

use yii\db\Migration;

/**
 * Class m191004_121638_remove_cascade_foreign_keys
 */
class m191004_121638_remove_cascade_foreign_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('logo', '{{%client%}}');
        $this->addForeignKey('logo', '{{%client%}}', 'logo_id', '{{%logo%}}', 'id');

        $this->dropForeignKey('city', '{{%client%}}');
        $this->addForeignKey('city', '{{%client%}}', 'city_id', '{{%city%}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191004_121638_remove_cascade_foreign_keys cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191004_121638_remove_cascade_foreign_keys cannot be reverted.\n";

        return false;
    }
    */
}
