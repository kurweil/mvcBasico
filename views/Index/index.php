<!Doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Mi MVC básico en PHP</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/stylesheet.css" />
    <script src="<?php echo URL; ?>public/js/jquery-1.11.2.min.js"></script>
</head>
<body>
    <?php if(!Session::exist()){ ?>
        <div id="formWrapper">
            <div class="formWrapper">
                <div class="formTitle">Entrar</div>
                <form name="signIn" method="post">
                    <input name="username" type="text" placeholder="Username" required="true" />
                    <input name="password" type="password" placeholder="Password" required="true" />
                    <input id="signInBtn" name="signInBtn" value="Entrar" type="submit" />
                    <div class="smallText">
                        <span>¿No estas registado? <div class="button" id="signUpButton">Regístrate aquí</div> </span>
                        <span>¿Olvidaste tu password? <a href="">Recordar password</a> </span>
                    </div>
                </form>
            </div>
            <div class="formWrapper hidden">
                <div class="formTitle">Registro</div>
                <form name="signUp" method="post">
                    <input name="nombre" type="text" placeholder="Nombre" required="true" />
                    <input name="username" type="text" placeholder="Username" required="true" />
                    <input name="password" type="password" placeholder="Password" required="true" />
                    <input name="email" type="email" placeholder="fernando@mvc.com" required="true" />
                    <input id="signUpBtn" name="signUpBtn" value="Registrar" type="submit" />
                    <div class="smallText">
                        <span>¿Si estas registado? <div class="button" id="signInButton">Volver</div> </span>
                    </div>
                </form>
            </div>
        </div>

    <script>
        $(function(){
            $('#signUpButton').click(function(){
                $('form[name=signIn]').parent().hide();
                $('form[name=signUp]').parent().fadeToggle();
            });

            $('#signInButton').click(function(){
                $('form[name=signUp]').parent().hide();
                $('form[name=signIn]').parent().fadeToggle();
            });

            $('#signUpBtn').click(function(e){
                e.preventDefault();
                signUp();
            });

            $('#signInBtn').click(function(e){
                e.preventDefault();
                signIn();
            });
        });

        function signUp()
        {
            var nombre = $('form[name=signUp] input[name=nombre]')[0].value;
            var username = $('form[name=signUp] input[name=username]')[0].value;
            var password = $('form[name=signUp] input[name=password]')[0].value;
            var email = $('form[name=signUp] input[name=email]')[0].value;

            $.ajax({
                type: "POST",
                url: "<?php echo URL.'User/signUp'; ?>",
                data: {nombre: nombre, username: username, password: password, email: email }
            }).done(function(response){
                if(response == true)
                {
                //    alert("Registro OK");
                //}else{
                    alert(response);
                }
            })
        }

        function signIn()
        {
            //console.log("signIn");
            var username = $('form[name=signIn] input[name=username]')[0].value;
            var password = $('form[name=signIn] input[name=password]')[0].value;

            $.ajax({
                type: "POST",
                url: "<?php echo URL.'User/signIn'; ?>",
                data: {username: username, password: password}
            }).done(function(response){
                //alert(response);
                if(response == 1)
                {
                    location.reload();
                }else{
                    alert("Usuario o Pasword incorrecto");
                }
            })
        }

        /*function signIn()
        {
            var username = $('form[name=signUp] input[name=username]')[0].value;
            var password = $('form[name=signUp] input[name=password]')[0].value;

            $.ajax({
                type: "POST",
                url: "<?php echo URL.'User/signIn'; ?>",
                data: {username: username, password: password}
            }).done(function(response){
                alert(response);
                if(response == 1)
                {
                    location.reload();
                }else {
                    alert("Usuario o Password incorrecto");
                }
            })
        }*/

    </script>
    <?php }else{ ?>
        <div class="formWrapper">
            <?php echo Session::getValue("U_NAME"); ?>
            <button id="closeSessionbtn">Cerrar sesión</button>
        </div>
        <script>
            $(function(){
               $('#closeSessionbtn').click(function(){
                  document.location = "<?php echo URL; ?>User/destroySession";
               });
            });
        </script>
    <?php } ?>
</body>
</html>