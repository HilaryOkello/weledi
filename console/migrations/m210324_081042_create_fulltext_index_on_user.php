<?php

use yii\db\Migration;

/**
 * Class m210324_081042_create_fulltext_index_on_user
 */
class m210324_081042_create_fulltext_index_on_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	$this->execute("ALTER TABLE {{%user}} ADD FULLTEXT(username)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210324_081042_create_fulltext_index_on_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210324_081042_create_fulltext_index_on_user cannot be reverted.\n";

        return false;
    }
    */
}
