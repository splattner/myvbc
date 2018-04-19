{include file='messages/info.tpl'}
<div data-allowEdit="{$allowedit}" data-orderID="{$orderID}" ng-controller="OrderController">
    <div class="card">
        <h4 class="card-header">
            <a class="btn btn-dark" data-toggle="tooltip" data-placement="bottom" title="Zur&uuml;ck zur &Uuml;bersicht" href="index.php?page=order&action=main"><i class="fas fa-times"></i></a> Bestellung bearbeiten
        </h4>
        <div class="card-body">
            <form action="index.php?page=order&action=editorder&orderID=" method="POST">
                <div class="row">
                    <div class="col-sm-4">Erstelldatum</div>
                    <div class="col-sm-8">[[ order.createdate ]]</div>
                </div>
                <div class="row">
                    <div class="col-sm-4">Letze Status &Auml;nderung</div>
                    <div class="col-sm-8">[[ order.lastupdate ]]</div>
                </div>
                <div class="row">
                    <div class="col-sm-4">Status</div>
                    <div class="col-sm-8">
                        <select ng-model="order.status" ng-if="allowEdit == 1" class="form-control" name="statusID">r
                            <option ng-selected="status.id == order.status" ng-repeat="status in statuslist" value="[[ status.id ]]">[[ status.description ]]</option>
                        </select>

                        <span ng-if="allowEdit == 0 && order.owner == uid && order.status == 1">[[ order.statustext ]]
                            <a class="btn btn-dakr" ng-click="updateStatus(2)" data-toggle="tooltip" data-placement="bottom" title="Sobald sie die Bestellung schliessen, wird der Bestellvorgang eingeleitet. Achtung: Danach k&ouml;nnen Sie an dieser Bestellung nichts mehr &auml;ndern!" >
                                <i class="fas fa-check-circle"></i> Bestellung abschliessen
                            </a>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">Bemerkung zur Bestellung</div>
                    <div class="col-sm-8">
                        <span ng-if="(allowEdit == 1 && order.status != 4) || (order.owner == uid && oder.status == 1)">
                            <textarea ng-model="order.comment" class="form-control" name="comment" cols="40" rows="6">[[ order.comment ]]</textarea>
                        </span>
                        <span ng-if="allowEdit == 0 && (order.owner != uid || oder.status != 1)">[[ order.comment ]]</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <p ng-if="allowEdit == 0 && order.status == 4" class="hightlight" >Bestellung abgeschlossen, Bearbeitung nicht mehr m&ouml;glich!</p>

                        <p ng-if="allowEdit == 1 || order.owner == uid && order.status == 1"><input ng-click="editOrder()" ng-if="allowEdit == 1 || order.owner == uid && order.status == 1" class="btn btn-primary" type="button" value="bearbeiten"></p>

                        <p ng-if="allowEdit == 0 && (order.owner != uid || oder.status != 1)" class="hightlight" >
                            Bearbeiten ist nicht mehr m&ouml;glich, der Bestellvorgang wurde bereits ausgel&oumlst, oder das ist nich deine Bestellung <br />
                            Wenn etwas nicht in Ordnung ist, melde dich beim Chef-TK!
                        </p>
                    </div>
                </div>
            </form>

            <table class="table table-striped">
                <thead class="thead-inverse">
                    <tr>
                        <th width="25%">Person</th>
                        <th width="25%">Lizenz</th>
                        <th width="40%">Kommentar</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="orderItem in orderItems">
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
                            <a class="btn btn-danger" ng-if="orderItem.orderitemid > 0 && ((allowEdit && orderItem.status !=4) || (order.owner == uid && order.status == 1))" ng-click="removeOrderItem([[ orderItem.personID]])"
                               data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Diese Lizenz entfernen" href="#">
                                <i class="fas fa-trash"></i>
                            </a>
                            <a class="btn btn-dark" ng-if="orderItem.orderitemid == 0" href="#" data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Lizenz f&uuml;r diese Person zur Bestellung hinzuf&uuml;gen" ng-click="addLicence(orderItem.personID)">
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p ng-if="allowEdit == 1 && order.status != 4 || order.status == 1" class="submenu">
                <a class="btn btn-dark" ng-click="addNewLicence([[ orderID ]])" data-toggle="tooltip" data-tooltip="true" data-placement="bottom" title="Neue Lizenz zu dieser Bestellung hinzuf&uuml;gen" href="#">
                    <i class="fa fa-plus-square"></i>
                </a>
            </p>
            <div ng-if="allowEdit == 1 && order.status != 4 || order.status == 1" class="alert alert-info" role="alert">
                <b>Achtung:</b> Es k&ouml;nnen nur Lizenzen für Personen bestellt werden, die das Beitrittsgesuch des VBC Langenthal unterzeichnet haben.
                <br> Wenn du ein Spieler nicht findest, prüfe in deiner Teamliste ob das Beitrittsgesuch unterschrieben wurde. Wenn nicht, bitte ausdrucken, unterzeichnen lassen und an unser Sekretariat senden.
            </div>

        </div>
    </div>
</div>
