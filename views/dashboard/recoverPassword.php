<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Favicons-->
    <link rel="icon" type="image/x-icon" href="../../assets/img/logos/favicon.png" />
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/logos/favicon.png" />
    <!--Css Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--Css App-->
    <link href="../../assets/css/style.css" rel="stylesheet">

    <title>Recuperar Contraseña</title>
</head>

<body>

    <!--Container-->
    <div class="container">
        <!--Container Form-->
        <div class="row">
            <div class="col-6 mx-auto mt-5 p-2 container-form">
                <h3 class="text-center mt-1">Recuperar Contraseña</h3>

                <form id="formPasswordRecover" class="mt-5 p-2 mb-5 ">
                    <div class="form-floating mb-3">
                        <input type="email" minlength="6" maxlength="30" title="Validate the data entered"
                            class="form-control" id="user" placeholder="Enter User" required>
                        <label for="user">Email</label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-100 mb-0">Enviar</button>
                        <a href="./create.php" class="btn btn-primary w-100 mb-0">Registrarse</a>
                        <a href="/SENA/AdmiredAdmin" class="btn btn-primary w-100 mb-0">Iniciar Sesión</a>
                    </div>
                </form>

            </div>
        </div>
        <!--End Container Form-->
    </div>
    <!--End Container-->

    <!--Script bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <!--Script app-->

    <!--Script module-->
    <script src="../../assets/js/user/main.js" type="module"></script>

</body>

</html>