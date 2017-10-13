{if !empty($mySchreibers)}
<div class="card">
	<div class="card-header">
		Meine Schreibereins�tze
	</div>
	<div class="card-body">
		<table class="table table-striped">
		{foreach item=mySchreiber from=$mySchreibers}
			<tr>
				<td>
					{if ($mySchreiber.date|date_format:"%d" < $smarty.now|date_format:"%d" &&  $mySchreiber.date|date_format:"%m" == $smarty.now|date_format:"%m" && $mySchreiber.date|date_format:"%Y" == $smarty.now|date_format:"%Y")
					|| ($mySchreiber.date|date_format:"%m" < $smarty.now|date_format:"%m" && $mySchreiber.date|date_format:"%Y" <= $smarty.now|date_format:"%Y") }
						<img src="{$templateDir}/images/icons/bullet_red.png">
					{else}
						<img src="{$templateDir}/images/icons/bullet_green.png">
					{/if}				
				</td>
				<td>{$mySchreiber.date|date_format:"%a, %d %B %y - %H:%M"}</td>
				<td>{$mySchreiber.name} : {$mySchreiber.gegner}</td>
				<td>{$mySchreiber.ort} / {$mySchreiber.halle}</td>
			</tr>
		{/foreach}
		</table>

	</div>
</div>
{/if}

