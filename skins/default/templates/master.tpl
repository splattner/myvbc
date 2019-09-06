<?xml version=\"1.0\" encoding=\"UTF-8\" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html ng-app="myvbc" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>
        {$siteTitle}
    </title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>



    <link rel="stylesheet" type="text/css" media="screen, print" href="skins/default/css/style.css">
    <link rel="stylesheet" type="text/css" media="print" href="skins/default/css/print.css">


    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment-with-locales.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
    <link rel="image_src" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen-sprite.png">


    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fc-3.2.5/fh-3.1.4/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fc-3.2.5/fh-3.1.4/datatables.min.js"></script>

    <!-- AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

    <!-- include angular-chosen -->
    <script src="js/angular-chosen.js"></script>


    <!-- Bootstrap Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js" integrity="sha256-7Ls/OujunW6k7kudzvNDAt82EKc/TPTfyKxIE5YkBzg=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.de.min.js" integrity="sha256-MRg0FdDDqvQkQ3VIUMZCZ39M6O40kpoIYqCGU2rRyxE=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css" integrity="sha256-P1wC4IE9L+kzf2qwueaK/jdj186d/Q05Q8ITF9vr9Ok=" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js" integrity="sha256-59IZ5dbLyByZgSsRE3Z0TjDuX7e1AiqW5bZ8Bg50dsU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/de-ch.js" integrity="sha256-Qsf/BCiIN3Sbv1OHR6930eSMDej2uwzYDi6uvRjveYY=" crossorigin="anonymous"></script>


    <!-- My stuff -->
    <script type="text/javascript" src="js/app.js?"></script>
    <script type="text/javascript" src="js/controller/OrderController.js?v={$appVersion}"></script>
    <script type="text/javascript" src="js/controller/GameController.js?v={$appVersion}"></script>
    <script type="text/javascript" src="js/controller/MyGamesController.js?v={$appVersion}"></script>
    <script type="text/javascript" src="js/controller/GameImportController.js?v={$appVersion}"></script>
    <script type="text/javascript" src="js/controller/SchreiberController.js?v={$appVersion}"></script>
    <script type="text/javascript" src="js/controller/TeamImportController.js?v={$appVersion}"></script>


    {literal}
        <script type="text/javascript">

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
                $('[data-tooltip="true"]').tooltip();
            })

        </script>
    {/literal}

    {$env_javascript}


</head>
<body>

<div class="bg-white container">

  {include file='navigation.tpl'}

  <div class="row" >
      <div class="col pt-3">
          {include file=$content}
          <p>&nbsp;</p>
      </div>
  </div>

  {if $development == "true"}
      <nav style="background-color: #ff0000;" class="navbar fixed-bottom navbar-dark d-print-none">
        <a class="navbar-brand" href="https://github.com/splattner/myvbc" target="_blank" >v{$appVersion}-dev <i class="fab fa-github" aria-hidden="true"></i></a>
  {else}
    <nav class="navbar fixed-bottom navbar-dark bg-dark d-print-none">
      <a class="navbar-brand" href="https://github.com/splattner/myvbc" target="_blank" >v{$appVersion} <i class="fab fa-github" aria-hidden="true"></i></a>
  {/if}

  </nav>
</div>

</body>
</html>
