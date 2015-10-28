<div class="panel panel-default">
	<div class="panel-heading">
		Meine Schiedsrichtereins&auml;tze
	</div>
	<div class="panel-body">
		<table class="table table-striped">

			{foreach item=refGame from=$refGames}
				<tr>
					<td>
						{if ($refGame.datum|date_format:"%d" < $smarty.now|date_format:"%d" &&  $refGame.datum|date_format:"%m" <= $smarty.now|date_format:"%m" && $refGame.datum|date_format:"%Y" <= $smarty.now|date_format:"%Y")
						|| ($refGame.datum|date_format:"%m" < $smarty.now|date_format:"%m" && $refGame.datum|date_format:"%Y" <= $smarty.now|date_format:"%Y")
						|| ($refGame.datum|date_format:"%Y" < $smarty.now|date_format:"%Y") }
							<img src="{$templateDir}/images/icons/bullet_red.png">
						{else}
							<img src="{$templateDir}/images/icons/bullet_green.png">
						{/if}
					</td>
					<td>{$refGame.datum|date_format:"%a, %d %B %y - %H:%M"}</td>
					<td>{$refGame.heimteam}</td>
					<td>{$refGame.gastteam}</td>
					<td>{$refGame.ort} / {$refGame.halle}</td>
				</tr>
			{/foreach}
		</table>

	</div>
</div>



