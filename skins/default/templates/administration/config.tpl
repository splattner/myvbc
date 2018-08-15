<h3>Konfiguration</h3>

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

            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
