<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>
        {$siteTitle}
    </title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <script src="libs/jquery/jquery-1.11.3.min.js"></script>


    {$xajax_javascript}
    
    {$customer_javascript}

    <link rel="stylesheet" type="text/css" media="screen, print" href="skins/default/css/style.css">
    <link rel="stylesheet" type="text/css" media="print" href="skins/default/css/print.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
          integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
          crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
            integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ=="
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/r/bs/dt-1.10.9,fc-3.1.0,fh-3.0.0/datatables.min.css"/>

    <script type="text/javascript"
            src="https://cdn.datatables.net/r/bs/dt-1.10.9,fc-3.1.0,fh-3.0.0/datatables.min.js"></script>

    {literal}
        <script type="text/javascript">

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

        </script>
    {/literal}


</head>
<body>
{popup_init src="libs/overlib421/overlib.js"}
<div id="myvbc">
    <div id="header">
        <div class="navbar navbar-default">
            <div class="container-fluid">
                {include file='navigation.tpl'}
            </div>
        </div>
    </div>
    <div id="content">
        {include file=$content}
    </div>
</div>
{$loaderJavaScript}
</body>
</html>