<?php

use yii\db\Migration;

/**
 * Class m191004_091548_cascade_foreing_keys
 */
class m191004_091548_cascade_foreing_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('logo', '{{%client%}}');
        $this->addForeignKey('logo', '{{%client%}}', 'logo_id', '{{%logo%}}', 'id', 'CASCADE');

        $this->dropForeignKey('city', '{{%client%}}');
        $this->addForeignKey('city', '{{%client%}}', 'city_id', '{{%city%}}', 'id', 'CASCADE');

        $this->dropForeignKey('region_id', '{{%city%}}');
        $this->addForeignKey('region_id', '{{%city%}}', 'region_id', '{{%region%}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191004_091548_cascade_foreing_keys cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191004_091548_cascade_foreing_keys cannot be reverted.\n";

        return false;
    }
    */
}
