<?php

session_start(); 

          include '../conexion/errores.php';
          include '../conexion/validarfoto.php';
          include '../conexion/database.php';
          require_once '../conexion/config.php';
          spl_autoload_register( function($clase){
              require_once "../conexion/$clase.php";
               });




    /*Para la fecha de usuarios*/
    $fecha = getdate();
    $diaN = date('d');
    $anio = date('Y');
    $meses = ["Enero", "Enero", "Febrero" ,"Marzo" ,"Abril" ,"Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
    $diaS = ["Domingo","Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
    $dia2 = $diaS[$fecha['wday']];
    $mes = $meses[$fecha['mon']=1];

    /*echo time()."<br>";*/


    


    $db = new database( DB_HOST, DB_USER, DB_PASS, DB_NAME );

    $sId = $_SESSION['idUsuario'];
    $db->preparar("SELECT id_usuario,nombre, imagen FROM usuario WHERE id_usuario = ? ");
    $db->prep()->bind_param( 'i', $sId); /*para añadir o agregar mas variables a la consulta que estamos haciendo*/
    $db->ejecutar();
    $db->prep()->bind_result( $uid, $uNombre, $uImagen); /*Para vincular el resultado*/
    $db->resultado();
    $db->liberar();


?>
<!--      NAVEGACION      -->
  <nav class="container-fluid d-none d-lg-block">
   <!--Aca pasa algo, por mas que baje o borre el padding y margin, va a seguir teniendo el mismo tamaño porque toma el tamaño de la imagen-->
   <a href="../index/index.php"> <img src="../imagenes/logo.png" alt="Logo-ArServicio" style="width:150px;float:left;"> </a>
   
   <!--container-fluid es una clase igual que row, esta en el libro-->
   <!-- d-none  d-lg-block me dice que cuando llege al tamaño md se va a ocultar esto-->
   <div >
        <div class="row">
           <!--text-sm-center es para poner el contenido en el centro a partir del sm (telefono) y poniendo solo text-center va a estar centrado desde el dispositivo mas chico al mas grande -->
           
            <div class="col-2  text-center">
                <li class="menu"><a href="" class="contenido" style="text-decoration:none;font-size: 25px;color: #212a31;"></a></li>
            </div>
            
            <div class="col-2  text-center">
                <li class="menu"><a href="../index/index.php" class="contenido" style="text-decoration:none;font-size: 25px;color: #212a31;">Inicio</a></li>
            </div>
            
            <div class="col-2  text-center">
                <li class="menu"><a href="../index/nosotros.php" class="contenido" style="text-decoration:none;font-size: 25px;color: #212a31;">Nosotros</a></li>
            </div>
            
            <div class="col-2 text-center">
                <li class="menu"><a href="../index/noticias.php" class="contenido" style="text-decoration:none;font-size: 25px;color: #212a31;">Noticias</a></li>
            </div>
            
            <div class="col-2 text-center">
                <li class="menu"><a href="../index/contacto.php" class="contenido" style="text-decoration:none;font-size: 25px;color: #212a31;">Contacto</a></li>
            </div>
            <?php 
                /*esto valida el usuario, sino existe, me manda a la pagina de iniciar sesion*/
                if( !$_SESSION['idUsuario'] && !$_SESSION['nombre'] ){
                    echo "<div class='col-2 text-center'>
                    <li class='menu'><a href='../index/login.php' class='contenido' style='text-decoration:none;font-size: 25px;color: #212a31;'>Registrarse</a></li>
                        </div>";
                    
                }else{
                    ?>
                    <div class="col-2 text-center" >
                    
                        <li class="" style=" display: inline-block;"><a href="../index/login.php" class="" style="text-decoration:none;font-size: 25px;color: #212a31; margin-top:40px; list-style-type:none; display: inline-block;"><img class=" img-responsive rounded-circle" src='<?php echo "../index/{$uImagen}"; ?>' alt="" style="margin:auto; width:50px; display: inline-block; ">Administracion</a></li>
                    </div>

               <?php
                }
            
            ?>
            
            
        </div>
    </div>

    <!--Y d-lg-none es que cuando llegue al tamaño md se va a mostrar esto-->  
   </nav>
   
   <!--creamos un div para ponerle un container-fluid y ocupe toda la pantalla-->
   <div  class="container-fluid d-lg-none" style="background-color: #ffffff;">
        <!--creamos la etiqueta de navegacion y le ponemos la clase navbar, que me permite ocultarla y cambiar la navegacion por un boton-->
       <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color: #ffffff;">
            <!--agregamos la imagen y ademas si precionan nos va a mandar al index.php-->
            <a class="navbar-brand" href="../index/index.php"><img src="../imagenes/logo.png" width="150" class="d-inline-block align-top" alt="logo de ArServicios"></a>
          <!--creamos un boton para hacer la pagina responsit-->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
            <!--creamos el div que es donde va a estar el contenido del menu-->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown" >
              <ul class="navbar-nav text-right">
              
              <!--<li class="nav-item active"> VER MAS ADELANTE SI PUEDO ACTIVAR CADA SITIO-->
              <li class="nav-item ">
                <a class="nav-link" href="../index/index.php" >Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../index/nosotros.php">Nosotros</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../index/noticias.php">Noticias</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="../index/contacto.php">Contacto</a>
              </li>
              <li class="nav-item">
              <?php 
                /*esto valida el usuario, sino existe, me manda a la pagina de iniciar sesion*/
                if( !$_SESSION['idUsuario'] && !$_SESSION['nombre'] ){
                    echo "<a class='nav-link' href='../index/login.php'>Registrarse</a>";
                    
                }else{
                    ?>
                    <a class='nav-link' href='../index/login.php'><img class="" src='<?php echo "../index/{$uImagen}"; ?> ' alt="" style="display:block;
                        margin:auto; width:50px; display: inline-block; ">Administracion</a>

               <?php
                }
            
            ?>
              
              
              
                
              </li>
            </ul>
            </div>
       </nav> 
   </div>
   <!--      NAVEGACION      -->