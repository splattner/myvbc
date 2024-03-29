<?php

use Phinx\Migration\AbstractMigration;

class InitialDbSetup extends AbstractMigration
{

    public function change()
    {
        $accessKey = $this->table('accesskeys');
        $accessKey->addColumn('person', 'integer')
            ->addColumn('label', 'string')
            ->addColumn('nr', 'integer')
            ->addColumn('lastUpdate', 'timestamp')
            ->create();


        $teams = $this->table('teams');
        $teams->addColumn('extid', 'integer')
            ->addColumn('name', 'string')
            ->addColumn('extname', 'string')
            ->addColumn('liga', 'string')
            ->addColumn('extliga', 'string')
            ->addColumn('typ', 'integer')
            ->create();

        $games = $this->table('games');
        $games->addColumn('extid', 'integer')
            ->addColumn('date', 'datetime')
            ->addColumn('team', 'integer')
            ->addColumn('gegner', 'string')
            ->addColumn('ort', 'string')
            ->addColumn('halle', 'string')
            ->addColumn('heimspiel', 'boolean')
            ->create();

        $games->addForeignKey('team', 'teams', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))->update();

        $persons = $this->table('persons');
        $persons->addColumn('changed', 'boolean', ['default' => false])
            ->addColumn('name', 'string', ['default' => ""])
            ->addColumn('prename', 'string', ['default' => ""])
            ->addColumn('address', 'string', ['default' => ""])
            ->addColumn('plz', 'string', ['default' => ""])
            ->addColumn('ort', 'string', ['default' => ""])
            ->addColumn('phone', 'string', ['null' => true])
            ->addColumn('mobile', 'string', ['null' => true])
            ->addColumn('email', 'string')
            ->addColumn('email_parent', 'string', ['null' => true])
            ->addColumn('birthday', 'date', ['null' => true])
            ->addColumn('gender', 'set', array('values' => 'm,w'))
            ->addColumn('schreiber', 'boolean', ['default' => false])
            ->addColumn('sms', 'boolean', ['default' => false])
            ->addColumn('licence', 'integer', ['default' => 1])
            ->addColumn('licence_comment', 'text', ['default' => ""])
            ->addColumn('active', 'boolean', ['default' => false])
            ->addColumn('signature', 'boolean', ['default' => false])
            ->addColumn('password', 'string')
            ->addColumn('refid', 'integer', ['default' => 0])
            ->addColumn('role', 'string')
            ->create();

        $licences = $this->table('licences');
        $licences->addColumn('typ', 'string', array('default' => '0'))
                ->create();

        $notificationtype = $this->table('notificationtype');
        $notificationtype->addColumn('name', 'string')
            ->create();

        $notification = $this->table('notification');
        $notification->addColumn('type', 'integer')
            ->addColumn('message', 'text')
            ->addColumn('objectid', 'integer')
            ->addColumn('date', 'datetime')
            ->addColumn('personid', 'integer')
            ->create();
        $notification->addForeignKey('type', 'notificationtype', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))->update();

        $notificationstatus = $this->table('notificationstatus');
        $notificationstatus
            ->addColumn('notificationid', 'integer')
            ->addColumn('personid', 'integer')
            ->create();

        $notificationstatus
            ->addForeignKey('notificationid', 'notification', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('personid', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();

        $notificationsubscription = $this->table('notificationsubscription');
        $notificationsubscription
            ->addColumn('typeid', 'integer')
            ->addColumn('email', 'boolean')
            ->addColumn('personid', 'integer')
            ->create();

        $notificationsubscription
            ->addForeignKey('personid', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('typeid', 'notificationtype', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();


        $orderstatus = $this->table('orderstatus');
        $orderstatus->addColumn('description', 'text')
            ->create();



        $order = $this->table('order');
        $order->addColumn('createdate', 'datetime')
            ->addColumn('lastupdate', 'datetime')
            ->addColumn('status', 'integer')
            ->addColumn('comment', 'text')
            ->addColumn('owner', 'integer')
            ->addColumn('teamid', 'integer')
            ->create();

        $order
            ->addForeignKey('owner', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('status', 'orderstatus', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();

        $orderitem = $this->table('orderitem');
        $orderitem->addColumn('orderid', 'integer')
            ->addColumn('personid', 'integer')
            ->addColumn('licence_id', 'integer', ['default' => 0])
            ->addColumn('licence_comment', 'text', ['default' => ''])
            ->create();

        $orderitem
            ->addForeignKey('personid', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('orderid', 'order', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();


        $players = $this->table('players');
        $players->addColumn('team', 'integer')
            ->addColumn('person', 'integer')
            ->addColumn('typ', 'integer')
            ->create();
        $players
            ->addForeignKey('person', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('team', 'teams', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();

        $reports = $this->table('reports');
        $reports
            ->addColumn('title', 'string')
            ->addColumn('query', 'text')
            ->create();

        $schreiber = $this->table('schreiber');
        $schreiber
            ->addColumn('game', 'integer')
            ->addColumn('person', 'integer')
            ->create();

        $schreiber
            ->addForeignKey('person', 'persons', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->addForeignKey('game', 'games', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
            ->update();


        $session = $this->table('session');
        $session
            ->addColumn('sid', 'string')
            ->addColumn('uid', 'integer')
            ->addColumn('lastUpdate', 'timestamp')
            ->addColumn('isAuth', 'boolean', array('default' => 0))
            ->addColumn('role', 'string', array('default' => ''))
            ->create();

        $config = $this->table('config', array('id' => false));
        $config
            ->addColumn('key', 'string')
            ->addColumn('value', 'text')
            ->create();
    }
}
