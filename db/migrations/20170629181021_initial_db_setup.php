<?php

use Phinx\Migration\AbstractMigration;

class InitialDbSetup extends AbstractMigration
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
        $accessKey = $this->table('accesskeys');
        $accessKey->addColumn('person', 'integer')
            ->addColumn('label', 'string')
            ->addColumn('nr', 'integer')
            ->addColumn('lastUpdate', 'timestamp')
            ->create();

        $acl = $this->table('acl');
        $acl->addColumn('section_value', 'string', array('default' => 'system'))
            ->addColumn('allow', 'integer', array('default' => '0'))
            ->addColumn('enabled','integer', array('default' => '0'))
            ->addColumn('return_value','text')
            ->addColumn('note','text')
            ->addColumn('updated_date','integer', array('default' => '0'))
            ->create();

        $acl_sections = $this->table('acl_sections');
        $acl_sections->addColumn('value', 'string')
            ->addColumn('order_value', 'integer', array('default' => '0'))
            ->addColumn('name','string')
            ->addColumn('hidden','integer', array('default' => '0'))
            ->addIndex(array('value'), array('unique' => true))
            ->create();

        $acl_seq = $this->table('acl_seq');
        $acl_seq->create();

        $aco = $this->table('aco');
        $aco->addColumn('section_value', 'string', array('default' => '0'))
            ->addColumn('value','string')
            ->addColumn('order_value','integer', array('default' => '0'))
            ->addColumn('name', 'string')
            ->addColumn('hidden','integer', array('default' => '0'))
            ->addIndex(array('value','section_value'), array('unique' => true))
            ->create();

        $aco_map = $this->table('aco_map');
        $aco_map->addColumn('acl_id', 'integer', array('default' => '0'))
                ->addColumn('section_value','string', array('default' => '0'))
                ->addColumn('value', 'string')
                ->create();

        $aco_section = $this->table('aco_section');
        $aco_section->addColumn('value', 'string')
                    ->addColumn('order_value','integer', array('default' => '0'))
                    ->addColumn('name','string')
                    ->addColumn('hidden','integer', array('default' => '0'))
                    ->addIndex(array('value'), array('unique' => true))
                    ->create();

        $aco_sections_seq = $this->table('aco_sections_seq');
        $aco_sections_seq->create();

        $aco_seq = $this->table('aco_seq');
        $aco_seq->create();

        $aro = $this->table('aro');
        $aro->addColumn('section_value', 'string', array('default' => '0'))
            ->addColumn('value','string')
            ->addColumn('order_value','integer', array('default' => '0'))
            ->addColumn('name','string')
            ->addColumn('hidden', 'integer', array('default' => '0'))
            ->addIndex(array('value','section_value'), array('unique' => true))
            ->create();

        $aro_groups = $this->table('aro_groups');
        $aro_groups->addColumn('parent_id', 'integer', array('default' => '0'))
                    ->addColumn('lft', 'integer', array('default' => '0'))
                    ->addColumn('rgt','integer', array('default' => '0'))
                    ->addColumn('name', 'string')
                    ->addColumn('value','string')
                    ->addIndex(array('value'), array('unique' => true))
                    ->create();

        $aro_groups_id_seq = $this->table('aro_groups_id_seq');
        $aro_groups_id_seq->create();

        $aro_groups_map = $this->table('aro_groups_map');
        $aro_groups_map->addColumn('acl_id', 'integer', array('default' => '0'))
            ->addColumn('group_id', 'integer', array('default' => '0'))
            ->create();

        $aro_map = $this->table('aro_map');
        $aro_map->addColumn('acl_id', 'integer', array('default' => '0'))
            ->addColumn('section_value', 'string', array('default' => '0'))
            ->addColumn('value', 'string', array('default' => '0'))
            ->create();

        $aro_sections = $this->table('aro_sections');
        $aro_sections->addColumn('value','string')
            ->addColumn('order_value', 'integer', array('default' => '0'))
            ->addColumn('name', 'string')
            ->addColumn('hidden', 'integer', array('default' => '0'))
            ->addIndex(array('value'), array('unique' => true))
            ->create();

        $aro_sections_seq = $this->table('aro_sections_seq');
        $aro_sections_seq->create();

        $aro_seq = $this->table('aro_seq');
        $aro_seq->create();

        $axo = $this->table('axo');
        $axo->addColumn('section_value','string', array('default' => '0'))
            ->addColumn('value', 'string')
            ->addColumn('order_value', 'integer', array('default' => '0'))
            ->addColumn('name', 'string')
            ->addColumn('hidden','integer')
            ->addIndex(array('section_value','value'), array('unique' => true))
            ->create();

        $axo_groups = $this->table('axo_groups');
        $axo_groups->addColumn('parent_id', 'integer', array('default' => '0'))
                    ->addColumn('lft', 'integer', array('default' => '0'))
                    ->addColumn('rgt','integer', array('default' => '0'))
                    ->addColumn('name', 'string')
                    ->addColumn('value','string')
                    ->addIndex(array('value'), array('unique' => true))
                    ->create();

        $axo_groups_map = $this->table('axo_groups_map');
        $axo_groups_map->addColumn('acl_id', 'integer', array('default' => '0'))
                ->addColumn('group_id','integer', array('default' => '0'))
                ->create();

        $axo_map = $this->table('axo_map');
        $axo_map->addColumn('acl_id', 'integer', array('default' => '0'))
                ->addColumn('section_value','string', array('default' => '0'))
                ->addColumn('value', 'string')
                ->create();

        $axo_sections = $this->table('axo_sections');
        $axo_sections->addColumn('value','string')
            ->addColumn('order_value', 'integer', array('default' => '0'))
            ->addColumn('name', 'string')
            ->addColumn('hidden', 'integer', array('default' => '0'))
            ->addIndex(array('value'), array('unique' => true))
            ->create();

        $teams = $this->table('teams');
        $teams->addColumn('extid','integer')
            ->addColumn('name','string')
            ->addColumn('extname','string')
            ->addColumn('liga','string')
            ->addColumn('extliga','string')
            ->addColumn('typ','integer')
            ->create();

        $games = $this->table('games');
        $games->addColumn('extid', 'integer')
            ->addColumn('date', 'datetime')
            ->addColumn('team','integer')
            ->addColumn('gegner','string')
            ->addColumn('ort','string')
            ->addColumn('halle','string')
            ->addColumn('heimspiel', 'boolean')
            ->create();

        $games->addForeignKey('team', 'teams', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))->update();

        $persons = $this->table('persons');
        $persons->addColumn('changed','boolean')
            ->addColumn('name','string')
            ->addColumn('prename','string')
            ->addColumn('address','string')
            ->addColumn('plz','string')
            ->addColumn('ort','string')
            ->addColumn('phone','string')
            ->addColumn('mobile','string')
            ->addColumn('email','string')
            ->addColumn('email_parent','string')
            ->addColumn('birthday','date')
            ->addColumn('gender','set', array('values' => 'm,w'))
            ->addColumn('sms','boolean')
            ->addColumn('licence','integer')
            ->addColumn('licence_comment','text')
            ->addColumn('active','boolean')
            ->addColumn('signature','boolean')
            ->addColumn('password','string')
            ->addColumn('refid', 'integer')
            ->create();

        $groups_aro_map = $this->table('groups_aro_map');
        $groups_aro_map->addColumn('group_id', 'integer', array('default' => '0'))
                ->addColumn('aro_id','integer', array('default' => '0'))
                ->create();

        $groups_axo_map = $this->table('groups_axo_map');
        $groups_axo_map->addColumn('group_id', 'integer', array('default' => '0'))
                ->addColumn('axo_id','integer', array('default' => '0'))
                ->create();

        $licences = $this->table('licences');
        $licences->addColumn('type', 'string', array('default' => '0'))
                ->create();

        $notificationtype = $this->table('notificationtype');
        $notificationtype->addColumn('name','string')
            ->create();

        $notification = $this->table('notification');
        $notification->addColumn('type','integer')
            ->addColumn('message','text')
            ->addColumn('objectid','integer')
            ->addColumn('date','datetime')
            ->addColumn('personid', 'integer')
            ->create();
        $notification->addForeignKey('type', 'notificationtype', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))->update();

        $notificationstatus = $this->table('notificationstatus');
        $notificationstatus
            ->addColumn('notificationid','integer')
            ->addColumn('personid','integer')
            ->create();

        $notificationstatus
            ->addForeignKey('notificationid', 'notification', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('personid', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();

        $notificationsubscription = $this->table('notificationsubscription');
        $notificationsubscription
            ->addColumn('typeid','integer')
            ->addColumn('email','boolean')
            ->addColumn('personid', 'integer')
            ->create();

        $notificationsubscription
            ->addForeignKey('personid', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('typeid', 'notificationtype', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();


        $orderstatus = $this->table('orderstatus');
        $orderstatus->addColumn('description','text')
            ->create();

        

        $order = $this->table('order');
        $order->addColumn('createdate','datetime')
            ->addColumn('lastupdate','datetime')
            ->addColumn('status','integer')
            ->addColumn('comment','text')
            ->addColumn('owner', 'integer')
            ->addColumn('teamid', 'integer')
            ->create();

        $order
            ->addForeignKey('owner', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('status', 'orderstatus', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();

        $orderitem = $this->table('orderitem');
        $orderitem->addColumn('orderid','integer')
            ->addColumn('personid','integer')
            ->addColumn('licence_id','integer')
            ->addColumn('licence_comment','text')
            ->create();

        $orderitem
            ->addForeignKey('personid', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('orderid', 'order', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();

        
        


        $phpgacl = $this->table('phpgacl');
        $phpgacl->addColumn('name','string')
            ->addColumn('value','string')
            ->create();

        $players = $this->table('players');
        $players->addColumn('team','integer')
            ->addColumn('person','integer')
            ->addColumn('typ','integer')
            ->create();
        $players
            ->addForeignKey('person', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('team', 'teams', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();

        $reports = $this->table('reports');
        $reports
            ->addColumn('title','string')
            ->addColumn('query','text')
            ->create();

        $schreiber = $this->table('schreiber');
        $schreiber
            ->addColumn('game','integer')
            ->addColumn('person','integer')
            ->create();

        $schreiber
            ->addForeignKey('person', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('game', 'games', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();


        $session = $this->table('session');
        $session
            ->addColumn('uid','integer')
            ->addColumn('lastUpdate','timestamp')
            ->addColumn('isAugth','boolean')
            ->create();

        

        

    }
}
