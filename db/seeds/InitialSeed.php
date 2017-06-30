
<?php

use Phinx\Seed\AbstractSeed;

class InitialSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {


        // `myvbc`.`persons`
        $persons = array(

          array('id' => '1','changed' => '0','name' => 'Administrator','email' => 'admin@myvbc.ch','active' => '1','password' => 'dc48fb00f34e4ac3ae330cf1f1055a9b')
        );

        $table = $this->table('persons');
        $table->insert($persons)
              ->save();


        // `myvbc`.`acl`
        $acl = array(
          array('id' => '10','section_value' => 'user','allow' => '1','enabled' => '1','return_value' => '','note' => 'Policy for guest Users','updated_date' => '1255251204'),
          array('id' => '11','section_value' => 'user','allow' => '1','enabled' => '1','return_value' => '','note' => 'Policy for Registered Users','updated_date' => '1250426183'),
          array('id' => '20','section_value' => 'user','allow' => '1','enabled' => '1','return_value' => '','note' => 'Policy for Vorstand','updated_date' => '1460560918'),
          array('id' => '15','section_value' => 'user','allow' => '1','enabled' => '1','return_value' => '','note' => '','updated_date' => '1460560933'),
          array('id' => '16','section_value' => 'user','allow' => '1','enabled' => '1','return_value' => '','note' => 'Policy for Captain und Trainer','updated_date' => '1459882081'),
          array('id' => '19','section_value' => 'user','allow' => '0','enabled' => '0','return_value' => '','note' => 'Policy for Registered Administrator','updated_date' => '1284471529')
        );

        $table = $this->table('acl');
        $table->insert($acl)
              ->save();

        // `myvbc`.`acl_sections`
        $acl_sections = array(
          array('id' => '1','value' => 'system','order_value' => '1','name' => 'System','hidden' => '0'),
          array('id' => '2','value' => 'user','order_value' => '2','name' => 'User','hidden' => '0')
        );

        $table = $this->table('acl_sections');
        $table->insert($acl_sections)
              ->save();

        // `myvbc`.`acl_seq`
        $acl_seq = array(
          array('id' => '20')
        );

        $table = $this->table('acl_seq');
        $table->insert($acl_seq)
              ->save();

        // `myvbc`.`aco`
        $aco = array(
          array('id' => '10','section_value' => 'index','value' => 'main','order_value' => '1','name' => 'Main Action','hidden' => '0'),
          array('id' => '11','section_value' => 'auth','value' => 'main','order_value' => '1','name' => 'Main Action','hidden' => '0'),
          array('id' => '12','section_value' => 'auth','value' => 'login','order_value' => '2','name' => 'Login Action','hidden' => '0'),
          array('id' => '13','section_value' => 'admin','value' => 'main','order_value' => '1','name' => 'Main Action','hidden' => '0'),
          array('id' => '14','section_value' => 'address','value' => 'main','order_value' => '1','name' => 'Main Action','hidden' => '0'),
          array('id' => '15','section_value' => 'team','value' => 'main','order_value' => '1','name' => 'Main Action','hidden' => '0'),
          array('id' => '16','section_value' => 'games','value' => 'main','order_value' => '1','name' => 'Main Action','hidden' => '0'),
          array('id' => '17','section_value' => 'address','value' => 'edit','order_value' => '2','name' => 'Edit Action','hidden' => '0'),
          array('id' => '18','section_value' => 'address','value' => 'new','order_value' => '3','name' => 'New Action','hidden' => '0'),
          array('id' => '19','section_value' => 'address','value' => 'delete','order_value' => '4','name' => 'Delete action','hidden' => '0'),
          array('id' => '20','section_value' => 'auth','value' => 'logout','order_value' => '3','name' => 'Logout Action','hidden' => '0'),
          array('id' => '32','section_value' => 'admin','value' => 'access','order_value' => '2','name' => 'Access Action','hidden' => '0'),
          array('id' => '22','section_value' => 'games','value' => 'edit','order_value' => '3','name' => 'Edit Action','hidden' => '0'),
          array('id' => '23','section_value' => 'games','value' => 'editSchreiber','order_value' => '4','name' => 'EditSchreiber Action','hidden' => '0'),
          array('id' => '24','section_value' => 'team','value' => 'edit','order_value' => '2','name' => 'Edit Action','hidden' => '0'),
          array('id' => '25','section_value' => 'team','value' => 'member','order_value' => '3','name' => 'Member Action','hidden' => '0'),
          array('id' => '26','section_value' => 'team','value' => 'deleteMember','order_value' => '4','name' => 'DeleteMember Action','hidden' => '0'),
          array('id' => '27','section_value' => 'team','value' => 'addMember','order_value' => '5','name' => 'AddMemberAction','hidden' => '0'),
          array('id' => '28','section_value' => 'team','value' => 'new','order_value' => '6','name' => 'New Action','hidden' => '0'),
          array('id' => '29','section_value' => 'team','value' => 'delete','order_value' => '7','name' => 'Delete Action','hidden' => '0'),
          array('id' => '30','section_value' => 'games','value' => 'delete','order_value' => '5','name' => 'Delete Action','hidden' => '0'),
          array('id' => '31','section_value' => 'games','value' => 'import','order_value' => '6','name' => 'Import Action','hidden' => '0'),
          array('id' => '33','section_value' => 'mydata','value' => 'main','order_value' => '1','name' => 'Main Action','hidden' => '0'),
          array('id' => '34','section_value' => 'myteam','value' => 'main','order_value' => '1','name' => 'Main Action','hidden' => '0'),
          array('id' => '35','section_value' => 'mydata','value' => 'edit','order_value' => '2','name' => 'Edit Action','hidden' => '0'),
          array('id' => '36','section_value' => 'myteam','value' => 'addMember','order_value' => '2','name' => 'Add Member Action','hidden' => '0'),
          array('id' => '37','section_value' => 'myteam','value' => 'deleteMember','order_value' => '3','name' => 'Delete Member Action','hidden' => '0'),
          array('id' => '38','section_value' => 'mydata','value' => 'editPassword','order_value' => '3','name' => 'Edit Password Action','hidden' => '0'),
          array('id' => '39','section_value' => 'admin','value' => 'addAccess','order_value' => '3','name' => 'Add Access Action','hidden' => '0'),
          array('id' => '40','section_value' => 'admin','value' => 'removeAccess','order_value' => '4','name' => 'Remove Access Action','hidden' => '0'),
          array('id' => '41','section_value' => 'auth','value' => 'createAccess','order_value' => '4','name' => 'Create Access Action','hidden' => '0'),
          array('id' => '42','section_value' => 'myteam','value' => 'edit','order_value' => '4','name' => 'Edit Action','hidden' => '0'),
          array('id' => '43','section_value' => 'report','value' => 'main','order_value' => '0','name' => 'Main Action','hidden' => '0'),
          array('id' => '44','section_value' => 'report','value' => 'getReport','order_value' => '1','name' => 'GetReport Action','hidden' => '0'),
          array('id' => '45','section_value' => 'admin','value' => 'report','order_value' => '5','name' => 'Report Action','hidden' => '0'),
          array('id' => '46','section_value' => 'admin','value' => 'addReport','order_value' => '6','name' => 'Add Report Action','hidden' => '0'),
          array('id' => '47','section_value' => 'admin','value' => 'editReport','order_value' => '7','name' => 'Edit Report Action','hidden' => '0'),
          array('id' => '48','section_value' => 'admin','value' => 'deleteReport','order_value' => '8','name' => 'deleteReport Action','hidden' => '0'),
          array('id' => '49','section_value' => 'admin','value' => 'functions','order_value' => '9','name' => 'Functions Action','hidden' => '0'),
          array('id' => '50','section_value' => 'admin','value' => 'updateStatus','order_value' => '10','name' => 'Update Status Action','hidden' => '0'),
          array('id' => '51','section_value' => 'admin','value' => 'changePassword','order_value' => '11','name' => 'Change Password Action','hidden' => '0'),
          array('id' => '52','section_value' => 'notification','value' => 'main','order_value' => '0','name' => 'Main Action','hidden' => '0'),
          array('id' => '53','section_value' => 'notification','value' => 'delete','order_value' => '1','name' => 'Delete Action','hidden' => '0'),
          array('id' => '54','section_value' => 'admin','value' => 'notifications','order_value' => '12','name' => 'Notifications Action','hidden' => '0'),
          array('id' => '55','section_value' => 'admin','value' => 'deleteNoteSubscription','order_value' => '13','name' => 'deleteoteSubscription Action','hidden' => '0'),
          array('id' => '56','section_value' => 'admin','value' => 'addNoteSubscription','order_value' => '14','name' => 'addNoteSubscription Action','hidden' => '0'),
          array('id' => '57','section_value' => 'admin','value' => 'deleteNote','order_value' => '15','name' => 'deleteNote Action','hidden' => '0'),
          array('id' => '70','section_value' => 'admin','value' => 'gacl','order_value' => '17','name' => 'Gacl Action','hidden' => '0'),
          array('id' => '59','section_value' => 'myteam','value' => 'new','order_value' => '5','name' => 'New Action','hidden' => '0'),
          array('id' => '60','section_value' => 'admin','value' => 'clearGames','order_value' => '16','name' => 'clearGames Action','hidden' => '0'),
          array('id' => '61','section_value' => 'order','value' => 'main','order_value' => '4','name' => 'Main Action','hidden' => '0'),
          array('id' => '62','section_value' => 'order','value' => 'list','order_value' => '3','name' => 'List Action','hidden' => '0'),
          array('id' => '63','section_value' => 'order','value' => 'addLicence','order_value' => '1','name' => 'Add Licence to Order Action','hidden' => '0'),
          array('id' => '64','section_value' => 'order','value' => 'removeLicence','order_value' => '5','name' => 'Remove Licence from Order Action','hidden' => '0'),
          array('id' => '65','section_value' => 'order','value' => 'editorder','order_value' => '2','name' => 'Edit Order Action','hidden' => '0'),
          array('id' => '66','section_value' => 'order','value' => 'new','order_value' => '6','name' => 'new Order Action','hidden' => '0'),
          array('id' => '67','section_value' => 'order','value' => 'delete','order_value' => '7','name' => 'delete Order Action','hidden' => '0'),
          array('id' => '68','section_value' => 'order','value' => 'allowall','order_value' => '8','name' => 'User can see and edit all orders','hidden' => '0'),
          array('id' => '69','section_value' => 'order','value' => 'allowedit','order_value' => '9','name' => 'User can edit an order aften Status Erfassen','hidden' => '0'),
          array('id' => '71','section_value' => 'order','value' => 'closeOrder','order_value' => '10','name' => 'closeOrder Action','hidden' => '0'),
          array('id' => '72','section_value' => 'admin','value' => 'workflow','order_value' => '18','name' => 'Workflow Action','hidden' => '0'),
          array('id' => '74','section_value' => 'address','value' => 'setState','order_value' => '5','name' => 'SetState Action','hidden' => '0'),
          array('id' => '75','section_value' => 'key','value' => 'main','order_value' => '1','name' => 'Main Action','hidden' => '0'),
          array('id' => '76','section_value' => 'key','value' => 'new','order_value' => '2','name' => 'New Action','hidden' => '0'),
          array('id' => '77','section_value' => 'key','value' => 'delete','order_value' => '3','name' => 'Delete Action','hidden' => '0'),
          array('id' => '78','section_value' => 'address','value' => 'setSignature','order_value' => '6','name' => 'setSignature Action','hidden' => '0'),
          array('id' => '79','section_value' => 'myteam','value' => 'requestForm','order_value' => '6','name' => 'requestForm Action','hidden' => '0'),
          array('id' => '80','section_value' => 'address','value' => 'requestForm','order_value' => '7','name' => 'requestForm Action','hidden' => '0')
        );

        $table = $this->table('aco');
        $table->insert($aco)
              ->save();

        // `myvbc`.`aco_map`
        $aco_map = array(
          array('acl_id' => '10','section_value' => 'auth','value' => 'createAccess'),
          array('acl_id' => '10','section_value' => 'auth','value' => 'login'),
          array('acl_id' => '10','section_value' => 'auth','value' => 'main'),
          array('acl_id' => '10','section_value' => 'index','value' => 'main'),
          array('acl_id' => '10','section_value' => 'report','value' => 'getReport'),
          array('acl_id' => '11','section_value' => 'auth','value' => 'createAccess'),
          array('acl_id' => '11','section_value' => 'auth','value' => 'login'),
          array('acl_id' => '11','section_value' => 'auth','value' => 'logout'),
          array('acl_id' => '11','section_value' => 'auth','value' => 'main'),
          array('acl_id' => '11','section_value' => 'index','value' => 'main'),
          array('acl_id' => '11','section_value' => 'mydata','value' => 'edit'),
          array('acl_id' => '11','section_value' => 'mydata','value' => 'editPassword'),
          array('acl_id' => '11','section_value' => 'mydata','value' => 'main'),
          array('acl_id' => '11','section_value' => 'myteam','value' => 'main'),
          array('acl_id' => '15','section_value' => 'address','value' => 'delete'),
          array('acl_id' => '15','section_value' => 'address','value' => 'edit'),
          array('acl_id' => '15','section_value' => 'address','value' => 'main'),
          array('acl_id' => '15','section_value' => 'address','value' => 'new'),
          array('acl_id' => '15','section_value' => 'address','value' => 'requestForm'),
          array('acl_id' => '15','section_value' => 'address','value' => 'setSignature'),
          array('acl_id' => '15','section_value' => 'address','value' => 'setState'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'access'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'addAccess'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'addNoteSubscription'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'addReport'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'changePassword'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'clearGames'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'deleteNote'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'deleteNoteSubscription'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'deleteReport'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'editReport'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'functions'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'gacl'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'main'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'notifications'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'removeAccess'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'report'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'updateStatus'),
          array('acl_id' => '15','section_value' => 'admin','value' => 'workflow'),
          array('acl_id' => '15','section_value' => 'auth','value' => 'createAccess'),
          array('acl_id' => '15','section_value' => 'auth','value' => 'login'),
          array('acl_id' => '15','section_value' => 'auth','value' => 'logout'),
          array('acl_id' => '15','section_value' => 'auth','value' => 'main'),
          array('acl_id' => '15','section_value' => 'games','value' => 'delete'),
          array('acl_id' => '15','section_value' => 'games','value' => 'edit'),
          array('acl_id' => '15','section_value' => 'games','value' => 'editSchreiber'),
          array('acl_id' => '15','section_value' => 'games','value' => 'import'),
          array('acl_id' => '15','section_value' => 'games','value' => 'main'),
          array('acl_id' => '15','section_value' => 'index','value' => 'main'),
          array('acl_id' => '15','section_value' => 'mydata','value' => 'edit'),
          array('acl_id' => '15','section_value' => 'mydata','value' => 'editPassword'),
          array('acl_id' => '15','section_value' => 'mydata','value' => 'main'),
          array('acl_id' => '15','section_value' => 'myteam','value' => 'addMember'),
          array('acl_id' => '15','section_value' => 'myteam','value' => 'deleteMember'),
          array('acl_id' => '15','section_value' => 'myteam','value' => 'edit'),
          array('acl_id' => '15','section_value' => 'myteam','value' => 'main'),
          array('acl_id' => '15','section_value' => 'myteam','value' => 'new'),
          array('acl_id' => '15','section_value' => 'notification','value' => 'delete'),
          array('acl_id' => '15','section_value' => 'notification','value' => 'main'),
          array('acl_id' => '15','section_value' => 'order','value' => 'addLicence'),
          array('acl_id' => '15','section_value' => 'order','value' => 'allowall'),
          array('acl_id' => '15','section_value' => 'order','value' => 'allowedit'),
          array('acl_id' => '15','section_value' => 'order','value' => 'closeOrder'),
          array('acl_id' => '15','section_value' => 'order','value' => 'delete'),
          array('acl_id' => '15','section_value' => 'order','value' => 'editorder'),
          array('acl_id' => '15','section_value' => 'order','value' => 'list'),
          array('acl_id' => '15','section_value' => 'order','value' => 'main'),
          array('acl_id' => '15','section_value' => 'order','value' => 'new'),
          array('acl_id' => '15','section_value' => 'order','value' => 'removeLicence'),
          array('acl_id' => '15','section_value' => 'report','value' => 'getReport'),
          array('acl_id' => '15','section_value' => 'report','value' => 'main'),
          array('acl_id' => '15','section_value' => 'team','value' => 'addMember'),
          array('acl_id' => '15','section_value' => 'team','value' => 'delete'),
          array('acl_id' => '15','section_value' => 'team','value' => 'deleteMember'),
          array('acl_id' => '15','section_value' => 'team','value' => 'edit'),
          array('acl_id' => '15','section_value' => 'team','value' => 'main'),
          array('acl_id' => '15','section_value' => 'team','value' => 'member'),
          array('acl_id' => '15','section_value' => 'team','value' => 'new'),
          array('acl_id' => '16','section_value' => 'auth','value' => 'createAccess'),
          array('acl_id' => '16','section_value' => 'auth','value' => 'login'),
          array('acl_id' => '16','section_value' => 'auth','value' => 'logout'),
          array('acl_id' => '16','section_value' => 'auth','value' => 'main'),
          array('acl_id' => '16','section_value' => 'index','value' => 'main'),
          array('acl_id' => '16','section_value' => 'mydata','value' => 'edit'),
          array('acl_id' => '16','section_value' => 'mydata','value' => 'editPassword'),
          array('acl_id' => '16','section_value' => 'mydata','value' => 'main'),
          array('acl_id' => '16','section_value' => 'myteam','value' => 'addMember'),
          array('acl_id' => '16','section_value' => 'myteam','value' => 'deleteMember'),
          array('acl_id' => '16','section_value' => 'myteam','value' => 'edit'),
          array('acl_id' => '16','section_value' => 'myteam','value' => 'main'),
          array('acl_id' => '16','section_value' => 'myteam','value' => 'new'),
          array('acl_id' => '16','section_value' => 'myteam','value' => 'requestForm'),
          array('acl_id' => '16','section_value' => 'order','value' => 'addLicence'),
          array('acl_id' => '16','section_value' => 'order','value' => 'closeOrder'),
          array('acl_id' => '16','section_value' => 'order','value' => 'delete'),
          array('acl_id' => '16','section_value' => 'order','value' => 'editorder'),
          array('acl_id' => '16','section_value' => 'order','value' => 'list'),
          array('acl_id' => '16','section_value' => 'order','value' => 'main'),
          array('acl_id' => '16','section_value' => 'order','value' => 'new'),
          array('acl_id' => '16','section_value' => 'order','value' => 'removeLicence'),
          array('acl_id' => '16','section_value' => 'report','value' => 'getReport'),
          array('acl_id' => '16','section_value' => 'report','value' => 'main'),
          array('acl_id' => '19','section_value' => 'order','value' => 'allowall'),
          array('acl_id' => '19','section_value' => 'order','value' => 'allowedit'),
          array('acl_id' => '20','section_value' => 'address','value' => 'delete'),
          array('acl_id' => '20','section_value' => 'address','value' => 'edit'),
          array('acl_id' => '20','section_value' => 'address','value' => 'main'),
          array('acl_id' => '20','section_value' => 'address','value' => 'new'),
          array('acl_id' => '20','section_value' => 'address','value' => 'requestForm'),
          array('acl_id' => '20','section_value' => 'address','value' => 'setSignature'),
          array('acl_id' => '20','section_value' => 'address','value' => 'setState'),
          array('acl_id' => '20','section_value' => 'auth','value' => 'createAccess'),
          array('acl_id' => '20','section_value' => 'auth','value' => 'login'),
          array('acl_id' => '20','section_value' => 'auth','value' => 'logout'),
          array('acl_id' => '20','section_value' => 'auth','value' => 'main'),
          array('acl_id' => '20','section_value' => 'games','value' => 'delete'),
          array('acl_id' => '20','section_value' => 'games','value' => 'edit'),
          array('acl_id' => '20','section_value' => 'games','value' => 'editSchreiber'),
          array('acl_id' => '20','section_value' => 'games','value' => 'import'),
          array('acl_id' => '20','section_value' => 'games','value' => 'main'),
          array('acl_id' => '20','section_value' => 'index','value' => 'main'),
          array('acl_id' => '20','section_value' => 'key','value' => 'delete'),
          array('acl_id' => '20','section_value' => 'key','value' => 'main'),
          array('acl_id' => '20','section_value' => 'key','value' => 'new'),
          array('acl_id' => '20','section_value' => 'mydata','value' => 'edit'),
          array('acl_id' => '20','section_value' => 'mydata','value' => 'editPassword'),
          array('acl_id' => '20','section_value' => 'mydata','value' => 'main'),
          array('acl_id' => '20','section_value' => 'myteam','value' => 'addMember'),
          array('acl_id' => '20','section_value' => 'myteam','value' => 'deleteMember'),
          array('acl_id' => '20','section_value' => 'myteam','value' => 'edit'),
          array('acl_id' => '20','section_value' => 'myteam','value' => 'main'),
          array('acl_id' => '20','section_value' => 'myteam','value' => 'new'),
          array('acl_id' => '20','section_value' => 'notification','value' => 'delete'),
          array('acl_id' => '20','section_value' => 'notification','value' => 'main'),
          array('acl_id' => '20','section_value' => 'order','value' => 'addLicence'),
          array('acl_id' => '20','section_value' => 'order','value' => 'allowall'),
          array('acl_id' => '20','section_value' => 'order','value' => 'allowedit'),
          array('acl_id' => '20','section_value' => 'order','value' => 'closeOrder'),
          array('acl_id' => '20','section_value' => 'order','value' => 'delete'),
          array('acl_id' => '20','section_value' => 'order','value' => 'editorder'),
          array('acl_id' => '20','section_value' => 'order','value' => 'list'),
          array('acl_id' => '20','section_value' => 'order','value' => 'main'),
          array('acl_id' => '20','section_value' => 'order','value' => 'new'),
          array('acl_id' => '20','section_value' => 'order','value' => 'removeLicence'),
          array('acl_id' => '20','section_value' => 'report','value' => 'getReport'),
          array('acl_id' => '20','section_value' => 'report','value' => 'main'),
          array('acl_id' => '20','section_value' => 'team','value' => 'addMember'),
          array('acl_id' => '20','section_value' => 'team','value' => 'delete'),
          array('acl_id' => '20','section_value' => 'team','value' => 'deleteMember'),
          array('acl_id' => '20','section_value' => 'team','value' => 'edit'),
          array('acl_id' => '20','section_value' => 'team','value' => 'main'),
          array('acl_id' => '20','section_value' => 'team','value' => 'member'),
          array('acl_id' => '20','section_value' => 'team','value' => 'new')
        );

        // `myvbc`.`aco_sections`
        $aco_sections = array(
          array('id' => '10','value' => 'index','order_value' => '2','name' => 'Index Page','hidden' => '0'),
          array('id' => '11','value' => 'auth','order_value' => '1','name' => 'Auth Page','hidden' => '0'),
          array('id' => '12','value' => 'admin','order_value' => '3','name' => 'Administration Page','hidden' => '0'),
          array('id' => '13','value' => 'address','order_value' => '4','name' => 'Address Page','hidden' => '0'),
          array('id' => '14','value' => 'team','order_value' => '5','name' => 'Team Page','hidden' => '0'),
          array('id' => '15','value' => 'games','order_value' => '6','name' => 'Games Page','hidden' => '0'),
          array('id' => '16','value' => 'mydata','order_value' => '7','name' => 'MyData Page','hidden' => '0'),
          array('id' => '17','value' => 'myteam','order_value' => '8','name' => 'MyTeam Page','hidden' => '0'),
          array('id' => '18','value' => 'report','order_value' => '9','name' => 'Report Page','hidden' => '0'),
          array('id' => '19','value' => 'notification','order_value' => '10','name' => 'Notification Page','hidden' => '0'),
          array('id' => '20','value' => 'order','order_value' => '11','name' => 'Licence Order Page','hidden' => '0'),
          array('id' => '22','value' => 'key','order_value' => '12','name' => 'Key Page','hidden' => '0')
        );

        $table = $this->table('aco_map');
        $table->insert($aco_map)
              ->save();

        // `myvbc`.`aco_sections_seq`
        $aco_sections_seq = array(
          array('id' => '22')
        );

        $table = $this->table('aco_sections_seq');
        $table->insert($aco_sections_seq)
              ->save();

        // `myvbc`.`aco_seq`
        $aco_seq = array(
          array('id' => '80')
        );

        $table = $this->table('aco_seq');
        $table->insert($aco_seq)
              ->save();

        // `myvbc`.`aro`
        $aro = array(
          array('id' => '12','section_value' => 'user','value' => '0','order_value' => '0','name' => 'Gast','hidden' => '0'),
          array('id' => '20','section_value' => 'user','value' => '63','order_value' => '1','name' => '1','hidden' => '0'),
        );

        $table = $this->table('aro');
        $table->insert($aro)
              ->save();

        // `myvbc`.`aro_groups`
        $aro_groups = array(
          array('id' => '10','parent_id' => '0','lft' => '1','rgt' => '10','name' => 'Guests','value' => 'guest'),
          array('id' => '11','parent_id' => '10','lft' => '2','rgt' => '9','name' => 'Registered Users','value' => 'registered'),
          array('id' => '12','parent_id' => '11','lft' => '3','rgt' => '8','name' => 'Captain and Trainer','value' => 'captain-trainer'),
          array('id' => '13','parent_id' => '12','lft' => '4','rgt' => '7','name' => 'Vorstand','value' => 'vorstand'),
          array('id' => '14','parent_id' => '13','lft' => '5','rgt' => '6','name' => 'Administration','value' => 'administration')
        );

        $table = $this->table('aro_groups');
        $table->insert($aro_groups)
              ->save();

        // `myvbc`.`aro_groups_id_seq`
        $aro_groups_id_seq = array(
          array('id' => '14')
        );

        // `myvbc`.`aro_groups_map`
        $aro_groups_map = array(
          array('acl_id' => '10','group_id' => '10'),
          array('acl_id' => '11','group_id' => '11'),
          array('acl_id' => '15','group_id' => '14'),
          array('acl_id' => '16','group_id' => '12'),
          array('acl_id' => '20','group_id' => '13')
        );

        $table = $this->table('aro_groups_map');
        $table->insert($aro_groups_map)
              ->save();

        // `myvbc`.`aro_map`
        $aro_map = array(
          array('acl_id' => '19','section_value' => 'user','value' => '1')
        );

        $table = $this->table('aro_map');
        $table->insert($aro_map)
              ->save();

        // `myvbc`.`aro_sections`
        $aro_sections = array(
          array('id' => '10','value' => 'user','order_value' => '1','name' => 'Users','hidden' => '0')
        );

        $table = $this->table('aro_sections');
        $table->insert($aro_sections)
              ->save();

        // `myvbc`.`aro_sections_seq`
        $aro_sections_seq = array(
          array('id' => '10')
        );

        $table = $this->table('aro_sections_seq');
        $table->insert($aro_sections_seq)
              ->save();

        // `myvbc`.`aro_seq`
        $aro_seq = array(
          array('id' => '111')
        );

        $table = $this->table('aro_seq');
        $table->insert($aro_seq)
              ->save();


        // `myvbc`.`groups_aro_map`
        $groups_aro_map = array(
          array('group_id' => '10','aro_id' => '12'),
          array('group_id' => '11','aro_id' => '62'),
          array('group_id' => '11','aro_id' => '63'),
          array('group_id' => '11','aro_id' => '65'),
          array('group_id' => '11','aro_id' => '66'),
          array('group_id' => '11','aro_id' => '70'),
          array('group_id' => '11','aro_id' => '86'),
          array('group_id' => '11','aro_id' => '88'),
          array('group_id' => '11','aro_id' => '102'),
          array('group_id' => '11','aro_id' => '106'),
          array('group_id' => '11','aro_id' => '107'),
          array('group_id' => '12','aro_id' => '47'),
          array('group_id' => '12','aro_id' => '71'),
          array('group_id' => '12','aro_id' => '90'),
          array('group_id' => '12','aro_id' => '91'),
          array('group_id' => '12','aro_id' => '98'),
          array('group_id' => '12','aro_id' => '100'),
          array('group_id' => '12','aro_id' => '101'),
          array('group_id' => '12','aro_id' => '103'),
          array('group_id' => '12','aro_id' => '104'),
          array('group_id' => '12','aro_id' => '108'),
          array('group_id' => '12','aro_id' => '109'),
          array('group_id' => '13','aro_id' => '72'),
          array('group_id' => '13','aro_id' => '81'),
          array('group_id' => '13','aro_id' => '83'),
          array('group_id' => '13','aro_id' => '84'),
          array('group_id' => '13','aro_id' => '99'),
          array('group_id' => '13','aro_id' => '105'),
          array('group_id' => '14','aro_id' => '20')
        );

        $table = $this->table('groups_aro_map');
        $table->insert($groups_aro_map)
              ->save();


        // `myvbc`.`licences`
        $licences = array(
          array('id' => '1','typ' => 'keine Lizenz'),
          array('id' => '2','typ' => 'Junioren Lizenz'),
          array('id' => '3','typ' => 'Doppellizenz Regional'),
          array('id' => '4','typ' => 'Regional Lizenz'),
          array('id' => '5','typ' => 'Doppellizenz National'),
          array('id' => '6','typ' => 'National Lizenz'),
          array('id' => '7','typ' => 'Trainer Lizenz'),
          array('id' => '8','typ' => 'Trainer C Lizenz'),
          array('id' => '9','typ' => 'Trainer B Lizenz'),
          array('id' => '10','typ' => 'Trainer A Lizenz'),
          array('id' => '11','typ' => 'Kontingenz Lizenz')
        );

        $table = $this->table('licence');
        $table->insert($licence)
              ->save();


        // `myvbc`.`notificationtype`
        $notificationtype = array(
          array('id' => '1','name' => 'Adressänderung'),
          array('id' => '2','name' => 'Teamänderung'),
          array('id' => '3','name' => 'Lizenzänderung'),
          array('id' => '4','name' => 'Sonstiges'),
          array('id' => '5','name' => 'Bestellung')
        );

        $table = $this->table('notificationtype');
        $table->insert($notificationtype)
              ->save();

        // `myvbc`.`orderstatus`
        $orderstatus = array(
          array('id' => '1','description' => 'Erfassen'),
          array('id' => '2','description' => 'Bestellung ausgelöst'),
          array('id' => '3','description' => 'In Bearbeitung'),
          array('id' => '4','description' => 'Abgeschlossen')
        );

        $table = $this->table('orderstatus');
        $table->insert($orderstatus)
              ->save();


        // `myvbc`.`reports`
        $reports = array(
          array('id' => '4','title' => 'Adressliste aller Schreiber','query' => 'SELECT
        CONCAT(persons.prename, \' \', persons.name) as "Schreiber",
          CONCAT("Tel: " , persons.phone , "<br />Mobile: ", persons.mobile) as "Tel / Mobile",
        persons.email as "E-Mail",
          GROUP_CONCAT(teams.liga SEPARATOR \'<br />\') as "Liga"
        FROM
          persons
        LEFT JOIN
          players ON persons.id = players.person
        LEFT JOIN 
          teams on players.team = teams.id
        WHERE
          schreiber = 1 AND active = 1 AND refid = 0
        GROUP BY 
          persons.id
        ORDER BY
          persons.name ASC, persons.prename ASC'),
          array('id' => '5','title' => 'Schreibereinsätze (public)','query' => 'SELECT 
          DATE_FORMAT(games.date,\'%d.%m.%Y - %H:%i\') as "Datum",
          teams.name as "Team",
          CONCAT(games.ort, \' \', games.halle) as "Ort / Halle",
          GROUP_CONCAT(CONCAT("<b>" , persons.prename, " " , persons.name , "</b>") SEPARATOR "<br /><br />") as "Schreiber"

        FROM
          games
        LEFT JOIN
          teams ON games.team = teams.id
        LEFT JOIN
          schreiber ON games.id = schreiber.game
        LEFT JOIN
          persons ON schreiber.person = persons.id
        WHERE
          games.heimspiel = 1
        GROUP BY
          games.id
        ORDER BY
          games.date
          '),
          array('id' => '6','title' => 'Anzahl Schreibereinsätze pro Person','query' => 'SELECT
          persons.prename as "Vorname",
          persons.name as "Name",
          COUNT(schreiber.game) as "Einsätze"
        FROM
          persons
        LEFT JOIN
          schreiber ON persons.id = schreiber.person
        WHERE
          persons.schreiber = 1
          AND persons.active = 1
          AND persons.refid = 0
        GROUP BY 
          persons.id
        ORDER BY 
          Einsätze DESC,
          persons.name,
          persons.prename'),
          array('id' => '8','title' => 'Spielplan (nach Teams)','query' => 'SELECT
          teams.name as "Team",
          DATE_FORMAT(games.date,\'%d.%m.%Y - %H:%i\') as "Datum",
        CONCAT(games.ort, \' / \',games.halle) as "Ort / Halle",
          games.gegner as "Gegner"
        FROM games
        LEFT JOIN
          teams on games.team = teams.id
        ORDER BY
          teams.name,
          games.date'),
          array('id' => '9','title' => 'Spielplan','query' => 'SELECT
          teams.name as "Team",
          DATE_FORMAT(games.date,\'%d.%m.%Y - %H:%i\') as "Datum",
          CONCAT(games.ort, \' / \',games.halle) as "Ort / Halle",
          games.gegner as "Gegner"
        FROM games
        LEFT JOIN
          teams on games.team = teams.id
        ORDER BY
          games.date'),
          array('id' => '10','title' => 'Heimspiele (nach Teams)','query' => 'SELECT
          teams.name as "Team",
          DATE_FORMAT(games.date,\'%d.%m.%Y - %H:%i\') as "Datum",
          CONCAT(games.ort, \' / \' , games.halle) as "Ort / Halle",
          games.gegner as "Gegner"
        FROM games
        LEFT JOIN
          teams on games.team = teams.id
        WHERE 
          games.heimspiel = 1
        ORDER BY
          teams.name,
          games.date'),
          array('id' => '11','title' => 'Heimspiele','query' => 'SELECT
          teams.name as "Team",
          DATE_FORMAT(games.date,\'%d.%m.%Y - %H:%i\') as "Datum",
          CONCAT(games.ort, \' / \',games.halle) as "Ort / Halle",
          games.gegner as "Gegner"
        FROM games
        LEFT JOIN
          teams on games.team = teams.id
        WHERE 
          games.heimspiel = 1
        ORDER BY
          games.date'),
          array('id' => '13','title' => 'Schiedsrichter','query' => 'SELECT
          prename as "Vorname",
          name as "Name",
          phone as "Telefon",
          mobile as "Mobile",
          email as "E-Mail"
        FROM
          persons
        WHERE
          refid > 0'),
          array('id' => '15','title' => 'Aktiv und nicht Schreiber','query' => 'SELECT
          persons.prename as "Vorname",
          persons.name as "Name",
          CONCAT(persons.address, \'<br/>\', persons.plz, \' \', persons.ort) as "Adresse",
          persons.email as "E-Mail",
          GROUP_CONCAT(teams.liga SEPARATOR \'<br />\') as "Liga"
        FROM
          persons
        LEFT JOIN
          players ON persons.id = players.person
        LEFT JOIN 
          teams on players.team = teams.id
        WHERE
          persons.active = 1 AND (persons.schreiber = 0 OR persons.schreiber IS NULL) AND refid = 0
        GROUP BY persons.id
        ORDER BY
          persons.name,
          persons.prename'),
          array('id' => '16','title' => 'offene Lizenzbestellung','query' => 'SELECT
          persons.changed AS "Änderung<br>seit letzer Bestellung",
          CONCAT(\'<b>\' , persons.name , \' \' , persons.prename , \'</b><br />\', persons.address, \'<br/>\', persons.plz, \' \', persons.ort, \'<br/>\', persons.birthday) as "Person",
          CONCAT(licences.typ, \'<br />\',  persons.licence_comment) AS "Lizenz",
          DATE_FORMAT(order.lastupdate,\'%d.%m.%Y - %H:%i\') AS "Bestelldatum",
          orderstatus.description as "Bestellstatus",
          order.comment AS "Kommentar zu Bestellung"
        FROM
          persons
        LEFT JOIN
          licences ON persons.licence = licences.id
        LEFT JOIN
          orderitem ON persons.id = orderitem.personid
        LEFT JOIN
          `order` ON orderitem.orderid = order.id
        LEFT JOIN
          orderstatus ON order.status = orderstatus.id
        WHERE
          active = 1 AND (order.status > 1 AND order.status < 4)
        ORDER BY persons.name ASC, persons.prename ASC'),
          array('id' => '17','title' => 'Teamverantwortliche und Trainer','query' => 'SELECT
          REPLACE(REPLACE(players.typ, "2", "Teamverantwortlicher"), "3", "Trainer") as "Funktion",
          teams.name as "Team",
          persons.prename as "Vorname",
          persons.name as "Name",
          CONCAT(persons.address, "<br />", persons.plz , " " , persons.ort) as Adresse,
          persons.phone as "Telefon",
          persons.mobile as "Mobile",
          persons.email as "E-Mail"
        FROM
          players
        LEFT JOIN
          persons ON players.person = persons.id
        LEFT JOIN
          teams ON players.team = teams.id
        WHERE
          players.typ = 2 OR players.typ = 3
        ORDER BY
          teams.name'),
          array('id' => '18','title' => 'letzte abgeschlossene Lizenzbestellungen','query' => 'SELECT 
          fullname AS "Name",
          address AS "Adesse",
          lizenz AS "Lizenz",
          date AS "Bestelldatum"
        FROM (
        SELECT
          persons.id AS id,
          persons.name AS lastname,
          persons.prename AS prename,
          CONCAT(persons.prename, \' \', persons.name) AS fullname,
          CONCAT(persons.address, \'<br/>\', persons.plz, \' \', persons.ort) AS address,
          CONCAT(licences.typ, \'<br />\',  persons.licence_comment) AS lizenz,
          DATE_FORMAT(order.lastupdate,\'%d.%m.%Y - %H:%i\') AS date
        FROM 
          persons
        LEFT JOIN
          licences ON persons.licence = licences.id
        LEFT JOIN
          orderitem ON persons.id = orderitem.personid
        LEFT JOIN
          `order` ON orderitem.orderid = order.id
        LEFT JOIN
          orderstatus ON order.status = orderstatus.id
        WHERE
          order.status = 4 AND
          YEAR(order.lastupdate) = YEAR(NOW())
        ORDER BY 
          order.lastupdate DESC
        ) AS tmp
        GROUP BY
          id
        ORDER BY
          lastname ASC, prename ASC
        '),
          array('id' => '19','title' => 'Schreibereinsätze','query' => 'SELECT 
          DATE_FORMAT(games.date,\'%d.%m.%Y - %H:%i\') as "Datum",
          teams.name as "Team",
          CONCAT(games.ort, \' \', games.halle) as "Ort / Halle",
          GROUP_CONCAT(CONCAT("<b>" , persons.prename, " " , persons.name , "</b><br />Tel: " , persons.phone , "<br />Mobile: ", persons.mobile, "<br />E-Mail: " , persons.email) SEPARATOR "<br /><br />") as "Schreiber"

        FROM
          games
        LEFT JOIN
          teams ON games.team = teams.id
        LEFT JOIN
          schreiber ON games.id = schreiber.game
        LEFT JOIN
          persons ON schreiber.person = persons.id
        WHERE
          games.heimspiel = 1 AND
          schreiber.person IS NOT NULL
        GROUP BY
          games.id
        ORDER BY
          games.date
          '),
          array('id' => '20','title' => 'Adressliste für externe','query' => 'SELECT
          prename as "Vorname",
          name as "Name",
          address as "Strasse",
          plz as "PLZ",
          ort as "Ort"
        FROM
          persons
        WHERE
          active = 1
        ORDER BY
          name, prename ASC
        '),
          array('id' => '21','title' => 'E-Mail Liste aktive','query' => 'SELECT
          CONCAT(persons.email,\',\', persons.email_parent) as "Person"
        FROM
          persons
        WHERE
          persons.active = 1 '),
          array('id' => '22','title' => 'Adressliste aktive','query' => 'SELECT
          prename as "Vorname",
          name as "Name",
          address as "Strasse",
          plz as "PLZ",
          ort as "Ort",
          DATE_FORMAT(birthday,\'%d.%m.%Y\')as "Geburtstag"
        FROM
          persons
        WHERE
          active = 1
        ORDER BY
          name, prename ASC
        '),
          array('id' => '23','title' => 'Aktive Personen ohne Team-Zuteilung','query' => 'SELECT
        persons.prename as "Vorname",
        persons.name as "Name"
        from persons
        LEFT JOIN players ON
        players.person = persons.id
        WHERE active = 1
        GROUP BY persons.id
        Having count(players.team) = 0'),
          array('id' => '24','title' => 'Personen ohne unterzeichneten Vereinsbeitritt','query' => 'SELECT
        CONCAT(persons.prename, \' \', persons.name) as "Schreiber",
          CONCAT("Tel: " , persons.phone , "<br />Mobile: ", persons.mobile) as "Tel / Mobile",
        persons.email as "E-Mail",
          GROUP_CONCAT(teams.liga SEPARATOR \'<br />\') as "Liga"
        FROM
          persons
        LEFT JOIN
          players ON persons.id = players.person
        LEFT JOIN 
          teams on players.team = teams.id
        WHERE
          signature = 0
        GROUP BY 
          persons.id
        ORDER BY
          persons.name ASC, persons.prename ASC'),
          array('id' => '25','title' => 'Aktive Personen ohne unterzeichneten Vereinsbeitritt','query' => 'SELECT
        CONCAT(persons.prename, \' \', persons.name) as "Schreiber",
          CONCAT("Tel: " , persons.phone , "<br />Mobile: ", persons.mobile) as "Tel / Mobile",
        persons.email as "E-Mail",
          GROUP_CONCAT(teams.liga SEPARATOR \'<br />\') as "Liga"
        FROM
          persons
        LEFT JOIN
          players ON persons.id = players.person
        LEFT JOIN 
          teams on players.team = teams.id
        WHERE
          signature = 0 AND active = 1
        GROUP BY 
          persons.id
        ORDER BY
          persons.name ASC, persons.prename ASC')
        );

        $table = $this->table('reports');
        $table->insert($reports)
              ->save();


    }
}
