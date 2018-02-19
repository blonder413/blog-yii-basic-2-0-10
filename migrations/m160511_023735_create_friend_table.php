<?php

use yii\db\Migration;

/**
 * Handles the creation for table `friend_table`.
 */
class m160511_023735_create_friend_table extends Migration
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
        
        $this->createTable('{{friend}}', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string(50)->notNull()->unique(),
            'url'           => $this->string(200)->notNull()->unique(),
            'image'         => $this->string(20),
            'created_by'    => $this->integer()->notNull(),
            'created_at'    => $this->dateTime()->notNull(),
            'updated_by'    => $this->integer()->notNull(),
            'updated_at'    => $this->dateTime()->notNull(),
        ], $tableOptions);
        
        $this->addForeignKey(
            'usercreatefriend', 'friend', 'created_by', 'user', 'id', 'no action', 'no action'
        );
        
        $this->addForeignKey(
            'userupdatefriend', 'friend', 'updated_by', 'user', 'id', 'no action', 'no action'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('usercreatefriend', 'friend');
        $this->dropForeignKey('userupdatefriend', 'friend');
        $this->dropTable('{{friend}}');
    }
}
