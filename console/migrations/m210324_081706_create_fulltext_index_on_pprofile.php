<?php

use yii\db\Migration;

/**
 * Class m210324_081706_create_fulltext_index_on_pprofile
 */
class m210324_081706_create_fulltext_index_on_pprofile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	$this->execute("ALTER TABLE {{%pprofile}} ADD FULLTEXT(first_name,last_name, about, introduction,specialty, location, payment,tags)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210324_081706_create_fulltext_index_on_pprofile cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210324_081706_create_fulltext_index_on_pprofile cannot be reverted.\n";

        return false;
    }
    */
}
