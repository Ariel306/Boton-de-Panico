<?php
    //a pedido del ale saque conexion afuera de la carpeta www
    include("../conexion/config.php");

    //Aca recibe la informacion de InfoUser.php del boton eliminar y hace esta accion
    if(isset($_GET['eliminar'])){
        $eliminar = $_GET['eliminar'];
        $ipeliminar = "DELETE FROM ubiemer WHERE ip = '$eliminar'";
        mysqli_query($conexion, $ipeliminar);
        //echo $ipeliminar; para probar si estaba bien
        /*Esto va a redirigir la pagina cuando termine de ejecutar la accion, lo hago asi 
        porque sino en la url va a quedar ip="la ip que se mando". Esto me puede dar un error
        y si el usuario manda otra alerta se va a eliminar sin poder verla.*/
        header('Location: index.php');
    }
    

    $usuarios = "SELECT * FROM ap";
    $Ubiemer = "SELECT * FROM ubiemer";
    $userss = "SELECT * FROM users";
    
    
    //echo $ipeliminar;
    //$ipeliminar;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- css para bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/header.css">
    <title>Boton de Panico</title>
    <!-- Para recargar toda la pagina cada  segundos en este caso -->
    
</head>
<body>
   
<!-- Coneccion con la API de Unifi -->
   <?php
        require_once '../vendor/autoload.php';

        require_once '../vendor/art-of-wifi/unifi-api-client/examples/config.php';
        
        $site_id = '37gm9avi';

        //Informacion Usuarios
        $unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
        $set_debug_mode   = $unifi_connection->set_debug($debug);
        $loginresults     = $unifi_connection->login();
        $clients_array    = $unifi_connection->list_clients();
        //convertimos la lista de clientes en un array 
        $thearray = (array) $clients_array; 
    ?>

<!-- INFORMACION IMPORTANTE -->
<!-- 
    En infoUser.php tenemos la navegacion 
    En contador.php tenemos el contador de usuarios y el sliter
    En emertabla.php esta la tabla a donde van a llegar las emergencias
    En platouser.php tenemos la lista de usuarios y platos de la facultad
-->
    
    <!-- Navegacion -->
    <?php include("nav/InfoUser.php") ?> 
    <!-- FIN Navegacion -->

   
    <!-- Contador -->
    <div id="seccionRecargar2">
        <?php include("nav/contador.php") ?>
    </div> 
    <!-- FIN Contador -->

    <!-- Emergencia -->
    <div id="seccionRecargar">
        <?php include("nav/emertabla.php") ?>
    </div>
    
    <!-- FIN Emergencia -->

    <!-- Platos y usuarios info -->
    <?php include("nav/platouser.php") ?> 
    <!-- FIN Platos y usuarios info -->
        
<!--     FOOTER     -->
    
<?php include("secciones_generales/footer.php"); ?>
    
<!-- Footer -->

    <!-- script para bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/codigo.js"></script>
    <script type="text/javascript">
      //este es el metodo que lo mantendra actualizado
      /*
        https://www.baulphp.com/refresh-reload-contenido-div-usando-jquery-completo/#Como_refrescar_un_DIV_con_jQuery
        Nota: Siempre tome nota del espacio justo antes del segundo signo #, de lo contrario el código 
        anterior devolverá toda la página anidada dentro de su DIV previsto. Siempre ponga espacio.
      */
        $(document).ready(function() {
          setInterval( function(){  
         $('#seccionRecargar').load(location.href + " #seccionRecargar");//actualizas el div
        }, 2000 );
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
          setInterval( function(){  
         $('#seccionRecargar2').load(location.href + " #seccionRecargar2");//actualizas el div
        }, 2000 );
        });
    </script>
    
    </body>
</html>