<?php

use Phinx\Migration\AbstractMigration;

class POCOR6145 extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        //backup
        $this->execute('CREATE TABLE `z_6145_security_functions` LIKE `security_functions`');
        $this->execute('INSERT INTO `z_6145_security_functions` SELECT * FROM `security_functions`');


        //Change Contact people Controller
        $this->execute("UPDATE security_functions SET controller = 'Institutions' WHERE name = 'Infrastructure WASH Water'");

        //chnage view,add,edit and delete to controller
        $this->execute("UPDATE security_functions SET _view = 'InfrastructureWashWaters.view|InfrastructureWashWaters.index|InfrastructureWashWaters.download' WHERE name = 'Infrastructure WASH Water' ");
        $this->execute("UPDATE security_functions SET  _edit = 'InfrastructureWashWaters.edit' WHERE name = 'Infrastructure WASH Water' ");
        $this->execute("UPDATE security_functions SET  _add = 'InfrastructureWashWaters.add' WHERE name = 'Infrastructure WASH Water' ");
        $this->execute("UPDATE security_functions SET _delete = 'InfrastructureWashWaters.delete' WHERE name = 'Infrastructure WASH Water' ");

        //enable Execute checkbox for export data
        $this->execute("UPDATE security_functions SET _execute = 'InfrastructureWashWaters.excel' WHERE name = 'Infrastructure WASH Water' ");
    }

     //rollback
     public function down()
     {
        $this->execute('DROP TABLE IF EXISTS `security_functions`');
        $this->execute('RENAME TABLE `z_6145_security_functions` TO `security_functions`');
     }
}
