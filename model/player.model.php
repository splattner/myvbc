<?php

namespace splattner\myvbc\models;

use splattner\framework\Application;
use splattner\framework\Model;

// no direct access
defined('_MYVBC') or die('Restricted access');

class MPlayer extends Model
{
    public $table = 'players';

    public function updateStatus()
    {

        //Reset All Status
        $sql = "UPDATE persons SET active = 0";
        $this->pdo->query($sql);

        //Set new Status

        $sql = "UPDATE persons RIGHT JOIN players ON persons.id = players.person SET active = 1";
        $this->pdo->query($sql);
    }

    public function insert()
    {
        parent::insert();

        /* Add Notification */
        $notification = Application::getService("ServiceNotification");
        $notification->addNewTeamMemberNotification($this->person, $this->team);

        // Update Active Status. After affing to a Team he is for sure active
        $person = new MPerson();
        $person->setState($this->person, 1);
    }


    public function delete($where)
    {
        parent::delete($where);

        /* Add Notification */
        $notification = Application::getService("ServiceNotification");
        $notification->addRemoveTeamMemberNofitication($this->person, $this->team);
    }
}
