<h3>Konfiguration</h3>

<a class="btn btn-outline-dark" data-toggle="modal" data-target="#myModal" data-tooltip="true" title="Neue Config erfassen" href="#">
    <i class="fas fa-plus-square"></i>
</a>

{include file='messages/info.tpl'}

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">neue Config</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="configform" action="index.php?page={$currentPage}&action=config"
                          method="POST">

                        <div class="form-group row">
                            <label for="key" class="col-sm-3 col-form-label">Key</label>

                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="key" name="key">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-sm-3 col-form-label">Value</label>

                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="value" name="value">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
                <button type="submit" class="btn btn-dark" name="doNew" form="configform">weiter</button>

            </div>
        </div>
    </div>
</div>

<table class="table table-striped table-sm">
	<thead class="thead-inverse">
        <tr>
            <th>Key</th>
            <th>Value</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        {foreach item=config from=$allconfig}
        <tr>
            <td>{$config.key}</td>
            <td>{$config.value}</td>

            <td align="right">
							<a class="btn btn-danger" onclick="return confirm('Willst du diesen Eintrag wirklich l&ouml;schen?')" class="icons" data-toggle="tooltip" data-placement="bottom" title="aus Team entfernen" href="index.php?page={$currentPage}&action=config&key=config.key}&delete"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
