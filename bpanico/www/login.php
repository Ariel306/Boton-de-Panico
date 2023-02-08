<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
        <!-- Estilos del Login -->
    <style>
        body{
           /* Aquí el origen de la imagen */
            background-image: url(imagenes/fondofacu.jpg);

            /* Fijar la imagen de fondo este vertical y
            horizontalmente y centrado */
            background-position: center center;

            /* Esta imagen no debe de repetirse */
            background-repeat: no-repeat;

            /* Con esta regla fijamos la imagen en la pantalla. */
            background-attachment: fixed;

            /* La imagen ocupa el 100% y se reescala */
            background-size: cover;

            /* Damos un color de fondo mientras la imagen está cargando  */
            background-color: #F5AD11;
        }
        .bg{
            background-image: url(imagenes/mundo.jpg);
            background-position: center center;
          
        }
    </style>    
</head>

<body>
    <div class="container w-75 bg-primary mt-5 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg- col-xl-6 rounded">
                
            </div>
            <div class="col bg-white p-5 rounded-end">
                <div class="text-end text-center">
                    <img src="imagenes/logo_fcpys.png" class="img-fluid" alt="...">
                </div>

                <h2 class="fw-bold text-center py-5">Bienvenidos</h2>

                <!-- Login -->
                <form action="#">
                    <div class="mb-4">
                        <label for="email" class="form-label">Correo electronico</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" name="connected">
                        <label for="connected" class="form-check-label">Mantenerme conectado</label>
                    </div>
                    <!-- d-grid es para ocupar toda la pantalla-->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Iniciar sesion</button>
                    </div>
                    <div class="my-3">
                        <span>No tienes cuenta? <a href="#">Regístrate</a></span> <br>
                        <span><a href="#">Recuperar Password</a></span>
                    </div>
                </form>
                <!-- FIN Login -->

                <!-- Login redes Sociales -->
                <div class="container w-100 my-5">
                    <div class="row text-center">
                        <div class="col-12">Iniciar Sesión</div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-outline-primary w-100 my-1">
                                <div class="row align-items-center">
                                    <div class="col-2 d-none d-md-block">
                                        <img src="imagenes/icon/siu_guarani.png" width="32" alt="">
                                    </div>

                                    <div class="col-12 col-md-10 text-center">
                                        Siu Guarani
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="col">
                            <button class="btn btn-outline-danger w-100 my-1">
                                    <div class="row align-items-center">
                                        <div class="col-2 d-none d-md-block">
                                            <img src="imagenes/icon/mapuche.gif" width="30" alt="">
                                        </div>

                                        <div class="col-12 col-md-10 text-center">
                                            Siu Mapuche
                                        </div>
                                    </div>
                            </button>
                        </div>
                    </div>

                </div>
                <!-- FIN Login redes Sociales -->
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>