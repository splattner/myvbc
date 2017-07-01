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
            ->addColumn('schreiber','boolean')
            ->addColumn('sms','boolean')
            ->addColumn('licence','integer')
            ->addColumn('licence_comment','text')
            ->addColumn('active','boolean')
            ->addColumn('signature','boolean')
            ->addColumn('password','string')
            ->addColumn('refid', 'integer')
            ->addColumn('role', 'string')
            ->create();

        $licences = $this->table('licences');
        $licences->addColumn('typ', 'string', array('default' => '0'))
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
            ->addColumn('sid','string')
            ->addColumn('uid','integer')
            ->addColumn('lastUpdate','timestamp')
            ->addColumn('isAuth','boolean')
            ->addColumn('role','string')
            ->create();

        $config = $this->table('config', array('id' => false));
        $config
            ->addColumn('key','string')
            ->addColumn('value','string')
            ->create();

        

        

    }
}
