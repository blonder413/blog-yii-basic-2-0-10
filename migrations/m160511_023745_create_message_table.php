<?php

use yii\db\Migration;

/**
 * Handles the creation for table `message_table`.
 */
class m160511_023745_create_message_table extends Migration
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
        
        $this->createTable('{{message}}', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string(100)->notNull(),
            'email'         => $this->string(100)->notNull(),
            'message'       => $this->text()->notNull(),
            'date'          => $this->dateTime()->notNull(),
            'client_ip'     => $this->string(15),
            'client_port'   => $this->string(5),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{message}}');
    }
}
