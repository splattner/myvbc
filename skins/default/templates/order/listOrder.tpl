{include file='messages/info.tpl'}




<div data-allowEdit="{$allowedit}" data-orderID="{$orderID}" ng-controller="OrderController">
    <form action="index.php?page=order&action=editorder&orderID=" method="POST">
        <table class="edit">
            <tr>
                <th width="30%">
                    Bestellung bearbeiten
                </th>
                <th width="70%" style="text-align: right;">
                    <a data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page=order&action=main"><i style="color: red" class="fa fa-times"></i></a>
                </th>
            </tr>
            <tr>
                <td width="30%">Erstelldatum</td>
                <td width="70%">[[ order.createdate ]]</td>
            </tr>
            <tr>
                <td width="30%">Letze Status &Auml;nderung</td>
                <td width="70%">[[ order.lastupdate ]]</td>
            </tr>
            <tr>
                <td width="30%">Status</td>
                <td width="70%">


                    <select ng-model="order.status" ng-if="allowEdit == 1" class="form-control" name="statusID">r
                        <option ng-selected="status.id == order.status" ng-repeat="status in statuslist" value="[[ status.id ]]">[[ status.description ]]</option>
                    </select>

                    <span ng-if="allowEdit == 0 && order.owner == uid && order.status == 1">[[ order.statustext ]]
                        <a ng-click="updateStatus(2)" data-toggle="tooltip" data-placement="bottom" title="Sobald sie die Bestellung schliessen, wird der Bestellvorgang eingeleitet. Achtung: Danach k&ouml;nnen Sie an dieser Bestellung nichts mehr &auml;ndern!" >
                            <img src="{$templateDir}/images/icons/accept.png" > Bestellung abschliessen
                        </a>
                    </span>



                </td>
            </tr>
            <tr>
                <td width="30%">Bemerkung zur Bestellung</td>
                <td width="70%">

                    <span ng-if="(allowEdit == 1 && order.status != 4) || (order.owner == uid && oder.status == 1)">
                        <textarea ng-model="order.comment" class="form-control" name="comment" cols="40" rows="6">[[ order.comment ]]</textarea>
                    </span>
                    <span ng-if="allowEdit == 0 && (order.owner != uid || oder.status != 1)">[[ order.comment ]]</span>
                </td>
            </tr>

            <tr>
                <td width="30%"></td>
                <td width="70%">
                    <p ng-if="allowEdit == 0 && order.status == 4" class="hightlight" >Bestellung abgeschlossen, Bearbeitung nicht mehr m&ouml;glich!</p>

                    <input ng-click="editOrder()" ng-if="allowEdit == 1 || order.owner == uid && order.status == 1" class="btn btn-primary" type="button" value="bearbeiten">

                    <p ng-if="allowEdit == 0 && (order.owner != uid || oder.status != 1)" class="hightlight" >
                        Bearbeiten ist nicht mehr m&ouml;glich, der Bestellvorgang wurde bereits ausgel&oumlst, oder das ist nich deine Bestellung <br />
                        Wenn etwas nicht in Ordnung ist, melde dich beim Chef-TK!
                    </p>


                </td>
            </tr>

        </table>
    </form>


    <p ng-if="allowEdit == 1 && order.status != 4 || order.status == 1" class="submenu">
        <a ng-click="addNewLicence([[ orderID ]])" data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Neue Lizenz zu dieser Bestellung hinzuf&uuml;gen" href="#">
            <i class="fa fa-plus-square"></i>
        </a>
    </p>
    <div ng-if="allowEdit == 1 && order.status != 4 || order.status == 1" class="alert alert-info" role="alert">
        <b>Achtung:</b> Es k&ouml;nnen nur Lizenzen für Personen bestellt werden, die das Beitrittsgesuch des VBC Langenthal unterzeichnet haben.
        <br> Wenn du ein Spieler nicht findest, prüfe in deiner Teamliste ob das Beitrittsgesuch unterschrieben wurde. Wenn nicht, bitte ausdrucken, unterzeichnen lassen und an unser Sekretariat senden.
    </div>




<table class="table table-striped">
    <thead>
        <tr>
            <th width="2%">&nbsp;</th>
            <th width="25%">Person</th>
            <th width="25%">Lizenz</th>
            <th width="38%">Kommentar</th>
            <th width="10%">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="orderItem in orderItems">
            <td>
                <img src="{$templateDir}/images/icons/bullet_green.png">
            </td>
            <td>
                <span ng-if="orderItem.orderitemid > 0">[[ orderItem.prename ]] [[ orderItem.name ]]</span>

                <select chosen data-placeholder-text-single="'Bitte Person ausw&auml;hlen'" ng-if="orderItem.orderitemid == 0" ng-model="orderItem.personID" ng-options="person.prename + ' ' + person.name for person in persons track by person.id">
                        <option value=""></option>
                </select>
            </td>
            <td>
                <span ng-if="orderItem.orderitemid > 0">[[ orderItem.licence ]]</span>
            </td>

            <td>
                <span ng-if="orderItem.orderitemid > 0">[[ orderItem.comment ]]</span>
            </td>

            <td align="right">
                <a ng-if="orderItem.orderitemid > 0 && ((allowEdit && orderItem.status !=4) || (order.owner == uid && order.status == 1))" ng-click="removeOrderItem([[ orderItem.personID]])"
                   data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Diese Lizenz entfernen" href="#">
                    <i style="color: red;" class="fa fa-trash-o"></i>
                </a>
                <a ng-if="orderItem.orderitemid == 0" href="#" data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Lizenz f&uuml;r diese Person zur Bestellung hinzuf&uuml;gen" ng-click="addLicence(orderItem.personID)">
                    <i class="fa fa-plus-square"></i>
                </a>
            </td>
        </tr>
    </tbody>
</table>
</div>

