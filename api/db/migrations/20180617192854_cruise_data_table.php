<?php


use Phinx\Migration\AbstractMigration;

class CruiseDataTable extends AbstractMigration
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
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other distructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        /* create the table */
        $table = $this->table('cruise_data');

        $table->addColumn('offer_id', 'integer')
            ->addColumn('offer_name', 'string')
            ->addColumn('departure_date', 'datetime')
            ->addColumn('itinerary', 'string')
            ->addColumn('cruise_line_name', 'string')
            ->addColumn('cruise_line_logo', 'string')
            ->addColumn('cruise_ship_name', 'string')
            ->create();
    }
}
