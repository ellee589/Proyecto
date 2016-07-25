<div class="container">
    <form class="form-signin" role="form" method="POST">
        <h2 class="form-signin-heading">Ingresar</h2>
        <input type="text" name="user" class="form-control" placeholder="Nombre de usuario" required autofocus autocomplete="off" ng-model="$parent.$parent.User">
        <input type="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" required autocomplete="off" ng-model="$parent.$parent.Password">
        <button class="btn btn-lg btn-primary btn-block" type="button" ng-click="login()">Entrar</button>
        <label class="ErrorMessage"></label>
    </form>
</div> 