<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html ng-app="myvbc" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>
        {$siteTitle}
    </title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    {$env_javascript}

    <link rel="stylesheet" type="text/css" media="screen, print" href="skins/default/css/style.css">
    <link rel="stylesheet" type="text/css" media="print" href="skins/default/css/print.css">


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

    <!-- include the css and sprite -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
    <link rel="image_src" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen-sprite.png">

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
          integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
          crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
            integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ=="
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/r/bs/dt-1.10.9,fc-3.1.0,fh-3.0.0/datatables.min.css"/>

    <script type="text/javascript"
            src="https://cdn.datatables.net/r/bs/dt-1.10.9,fc-3.1.0,fh-3.0.0/datatables.min.js"></script>


    <!-- AngularJS -->
    <script type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>

    <!-- include angular-chosen -->
    <script src="js/angular-chosen.js"></script>



    <!-- My stuff -->
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/controller/OrderController.js"></script>
    <script type="text/javascript" src="js/controller/GameController.js"></script>
    <script type="text/javascript" src="js/controller/GameImportController.js"></script>
    <script type="text/javascript" src="js/controller/SchreiberController.js"></script>


    {literal}
        <script type="text/javascript">

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
                $('[data-tooltip="true"]').tooltip();
            })

        </script>
    {/literal}


</head>
<body>
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
</body>
</html>