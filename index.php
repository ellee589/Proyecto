<?php
//header("Location: index.do");
?>
<!DOCTYPE html>
<html ng-app="App">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>AppName</title>

        <link href="css/bootstrap.min.css" rel="stylesheet"/>
        <link href="css/sb-admin-2.css" rel="stylesheet"/>
        <link href="css/font-awesome.min.css" rel="stylesheet"/>
        <link href="css/login.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body ng-controller="RootController">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0" 
             ng-include="'html/views/navigation.html'"
             ng-if="SessionUser.UserId"
             >
        </nav>

        <div id="page-wrapper" style="min-height: 600px;" ng-if="SessionUser.UserId">
            <div ng-view>
            </div>
        </div>
        
        <div ng-view ng-if="!SessionUser.UserId">
        </div>
        
        <script src="js/jquery/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/angular/angular.min.js"></script>
        <script src="js/angular/angular-resource.min.js"></script>
        <script src="js/angular/angular-route.min.js"></script>
        <script src="js/app.min.js"></script>
        <script src="js/services.min.js"></script>
        <script src="js/controllers.min.js"></script>
        
    </body>
</html>
