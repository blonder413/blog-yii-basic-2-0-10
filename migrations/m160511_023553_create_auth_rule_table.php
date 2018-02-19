<?php

use yii\db\Migration;

/**
 * Handles the creation for table `auth_rule_table`.
 */
class m160511_023553_create_auth_rule_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_spanish_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{auth_rule}}', [
            'name'          => $this->string(64)->notNull(),
            'data'          => $this->text(),
            'created_at'    => $this->integer(),
            'updated_at'    => $this->integer(),
        ], $tableOptions);
        
        $this->addPrimaryKey('auth_rule_name', 'auth_rule', 'name');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{auth_rule}}');
    }
}
