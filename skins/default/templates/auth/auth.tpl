{include file='messages/info.tpl'}
{if not $isAuth}
	{include file='auth/loginform.tpl'}
{else}
	{include file='auth/logoutform.tpl'}
{/if}