
<?php

use Phinx\Seed\AbstractSeed;

class InitialSeed extends AbstractSeed
{

    public function run()
    {

        // `myvbc`.`licences`
        $licences = array(
          array('id' => '1','typ' => 'keine Lizenz'),
          array('id' => '2','typ' => 'JLL Junioren'),
          array('id' => '3','typ' => 'DLR Doppellizenz Regional'),
          array('id' => '4','typ' => 'RLL Regionalliga'),
          array('id' => '5','typ' => 'DLN Doppellizenz National'),
          array('id' => '6','typ' => 'NLL Nationalliga'),
          array('id' => '7','typ' => 'TL Trainer'),
          array('id' => '8','typ' => 'TLC Trainer C'),
          array('id' => '9','typ' => 'TLB Trainer B'),
          array('id' => '10','typ' => 'TLA Trainer A'),
          array('id' => '11','typ' => 'Kontingenz Lizenz'),
          array('id' => '12','typ' => 'PL Pendlerlizenz'),
          array('id' => '13','typ' => 'TLEN Trainer'),
          array('id' => '14','typ' => 'TLER Trainer'),
          array('id' => '15','typ' => 'U15L Jugdend U15'),
          array('id' => '16','typ' => 'U13L Mini U13'),
        );

        $table = $this->table('licences');
        $table->insert($licences)
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

        // `myvbc`.`config`
        $configTable = array(
          array('key' => 'initialSeed','value' => 'true')
        );

        $table = $this->table('config');
        $table->insert($configTable)
              ->save();

        // `myvbc`.`persons`
        $persons = array(
          array('id' => '1','name' => 'Administrator','email' => 'admin@myvbc.ch','active' => true,'password' => '2b7e7b3d95551e5c1297f5e03d60be3a', 'gender' => 'm', 'role' => 'administrator')
        );

        $table = $this->table('persons');
        $table->insert($persons)
              ->save();
    }
}
