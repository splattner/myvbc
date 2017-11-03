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


    <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="bower_components/moment/min/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
    <link rel="image_src" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen-sprite.png">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/fc-3.2.3/fh-3.1.3/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/fc-3.2.3/fh-3.1.3/datatables.min.js"></script>



    <!-- AngularJS -->
    <script type="text/javascript" src="bower_components/angular/angular.min.js"></script>

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

<div class="bg-white container">

    </nav>
    <div class="row d-print-none" >
        <div class="col">
            {include file='navigation.tpl'}
        </div>
    </div>
    <div class="row" >
        <div class="col">
            {include file=$content}
            <p>&nbsp;</p>
        </div>
    </div>
    <nav class="navbar fixed-bottom navbar-dark bg-dark d-print-none">
        <a class="navbar-brand" href="https://github.com/splattner/myvbc" target="_blank" >v{$appVersion} <i class="fa fa-github" aria-hidden="true"></i></a>
    </nav>
</div>



</body>
</html>
