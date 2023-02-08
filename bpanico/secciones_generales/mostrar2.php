
<?php 

 /*https://desarrolloweb.com/articulos/317.php*/
     $variable=($_GET['id']);               
     $nombreser=($_GET['nombre']);      

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ArServicios - <?php echo $nombreser ?></title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos_index.css">
    <link rel="stylesheet" href="../css/estilos_contacto.css">
    <link rel="stylesheet" href="../css/estilos_estrellas.css">
</head>
<body>
   
   <!--      NAVEGACION      -->
   
   <?php include("../secciones_generales/nav.php"); ?>
    
    <!--      NAVEGACION     -->
     
    <!--      NAVEGACION SERVICIOS      -->
   
   <?php include("../secciones_generales/servicios.php"); ?>
    
    <!--      NAVEGACION SERVICIOS     -->
    
    <section>
        <div class="contacto">
          
            <h1><?php echo $nombreser; ?></h1>
        </div>
    </section>
    <br>
    
    
                        <!--SI APRETAMOS EL BOTON ver PASA ESTO-->

                               <?php if(isset($_GET['editar']) ) : ?>
                               
                                <?php 

                                      /*ESTAS FUNCIONES YA SON LLAMADAS DESDE EL NAV.PHP POR ESO NO HACE FALTA PONERLAS*/
    
                                         /* include '../conexion/errores.php';
                                          include '../conexion/validarfoto.php';
                                          include '../conexion/database.php';
                                          require_once '../conexion/config.php';
                                          spl_autoload_register( function($clase){
                                              require_once "../conexion/$clase.php";
                                               });
*/

                                    $db = new database( DB_HOST, DB_USER, DB_PASS, DB_NAME );


                                ?>


                    <center> 
                        <!-- Material form login -->
                        <div class="card col-md-6 col-center" style="padding: 0;border: 0;">

                         <?php 
                            
                     
                            $eID = $_GET['editar'];

                                     /* Con esto traigo la informacion del usuario y del servicio, es lo mismo que en indexlogin2 pero aca funciona con id_servicio y en el otro con usuario*/
                                        $db->preparar("SELECT us.id_usuario, us.id_servicio,
                                                      user.nombre, user.email, user.telefono, user.id_provincia,
                                                      ser.nombre, ser.direccion,ser.maps, ser.imagens
                                               FROM usuario_servicio us
                                               INNER JOIN usuario user ON us.id_usuario = user.id_usuario
                                               INNER JOIN servicio ser ON us.id_servicio = ser.id_servicio
                                               WHERE us.id_servicio = ?");
                                        $db->prep()->bind_param( 'i', $eID);
                                        $db->ejecutar();
                                        $db->prep()->bind_result( $iduser, $idser,$unombre, $uemail, $utelefono, $uidpro, $snombre,$sdireccion,$smaps, $simagens);
                                        $db->resultado();
                                        $db->liberar();
                                       ?>

                          
                          
                            <?php
                            /*HAGO ESTO YA QUE NO ME SALIO EL ELIMINAR EL USUARIO CON TODOS LOS SERVICIOS A SU NOMBRE, ENTONCES CON ESTO LO QUE HAGO ES QUE SI LA CONSULTA DE ARRIBA ESTA VACIA QUE HAGA OTRA CONSULTA DONDE TRAE SOLO LA INFORMACION DEL SERVICIO*/
                                   if (!empty($unombre)) { // <= si es false se va al else

                                            // No está vacía (true)

                                        } else {

                                            // Está vacía (false)
                                       
                                       $db->preparar("SELECT servicio.id_servicio, servicio.nombre, servicio.id_categoria, servicio.direccion, servicio.maps, servicio.imagens FROM servicio WHERE id_servicio = ? "); /* */
                                       $db->prep()->bind_param( 'i', $eID);
                                        $db->ejecutar();
                                        $db->prep()->bind_result( $dbid, $snombre, $dbcategoria, $sdireccion, $smaps, $simagens);
                                       $db->resultado();
                                        $db->liberar();
                                       
                                       $unombre= "Sin Informacion";
                                       $uemail= "Sin Informacion";
                                       $utelefono= "Sin Informacion";
                                       $valores= "Sin Informacion";
                                       
                                       
                                        }

                               ?>   
                               
                          <h5 class="card-header info-color white-text text-center py-4" style="background-color: #e2db36;">
                            <strong><?php echo ucwords ("$snombre"); ?></strong>
                          </h5> 
                                  
                                  <div class="row g-0 bg-light position-relative">
                                      <div class="col-md-6 mb-md-0 p-md-4">
                                        <img
                                          src='<?php echo "../index/$simagens"; ?>'
                                          class="w-100"
                                          alt="..."
                                        />
                                      </div>
                                      <div class="col-md-6 p-4 ps-md-0">
                                        <h5 class="mt-0">Nombre del Dueño: </h5>
                                        <p>
                                          <?php echo ucwords ("$unombre"); ?>
                                        </p>
                                        
                                        <h5 class="mt-0">Email: </h5>
                                        <p>
                                          <?php echo "$uemail"; ?>
                                        </p>
                                        
                                        <h5 class="mt-0">Telefono: </h5>
                                        <p>
                                          <?php echo "$utelefono"; ?>
                                        </p>
                                        
                                        <h5 class="mt-0">Direccion: </h5>
                                        <p>
                                          <?php echo "$sdireccion"; ?>
                                        </p>
                                        
                                        <h5 class="mt-0">Provincia: </h5>
                                        <p>
                                         
                                         <?php
                                             /*ACA HAGO LO MISMO SI ESTA VACIO*/
                                                         if (!empty($uidpro)) { // <= si es false se va al else

                                                            $mysqli = new mysqli('localhost', 'root', '', 'arservicios');
                                                             /*https://www.baulphp.com/llenar-select-html-con-mysql-php-ejemplos/*/
                                                            $query = $mysqli->query("SELECT * FROM provincia WHERE id_provincia = ('$uidpro')");
                                                                 while ($valores = mysqli_fetch_array($query)) {
                                                                    echo '<option value="'.$valores[id_provincia].'">'.$valores[nombre].'</option>';
                                                                }

                                                        } else {

                                                            $valores="Sin Informacion";
                                                             echo $valores;

                                                        }     
                                        ?>  
                                        </p>
                                        
                              
                                     
                                      </div>
                                      
                                      <h5 class="mt-0">Ubucacion en Google Maps:       </h5>
                                      <br>
                                    <p>
                                        <?php echo "$smaps"; ?>
                                    </p>
                                    
                                    <!--CALIFICACION Y COMENTARIOS-->
                                    
                                    <!--A FUTURO SI SE QUIERE AGREGAR ESTO, MIRAR procesar_leer_mas.php-->
                                   
                  
                            </div>
                                  
                        </div>
                        
                  
                       </center>
                       

  
  
   
    
    <?php else : ?>
    
    
    
    <div class='card-deck'>
                               
                                      <?php
                                       
                                       
                                          /*include '../conexion/errores.php';
                                          include '../conexion/validarfoto2.php';
                                          include '../conexion/database.php';
                                          require_once '../conexion/config.php';
                                          spl_autoload_register( function($clase){
                                              require_once "../conexion/$clase.php";
                                               });*/
                        
                                
                        
                        
                                       /*VAMOS A USAR OTRA CONSULTA, DEL VIDEO 267*/  /*ESTO ES PARA MOSTRAR 5 RESULTADOS NADA MAS*/
                                       $db = new database( DB_HOST, DB_USER, DB_PASS, DB_NAME );
                                       $db->preparar("SELECT COUNT(id_servicio) FROM servicio WHERE servicio.id_categoria=$variable "); /*AGREGANDO EL WHERE servicio.id_categoria=15 LE DIGO QUE TRAIGA TODOS LOS SERVICIOS PERO CON ESE ID. sino hiciera esto, me va a traer todos los servicios y el contador va a mostrar mas resultados de los que hay. Para entender esto se puede eliminar WHERE servicio.id_categoria=15 y ver como el contador de paginas va a estar mal*/
                                       $db->ejecutar();
                                       $db->prep()->bind_result($contador);
                                       $db->resultado();
                                       $db->liberar();
                                       $porPagina = 10;
                                       $paginas =  ceil($contador/$porPagina);
                                       $pagina = (isset ($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                       $iniciar = ($pagina-1) * $porPagina;
            
                                       
                                       
                                       
                                       
                                        /*ESTA CONSULTA DE BASE DE DATOS, ME AHORRA HACER LAS VALIDACIONES PARA LAS PROVINCIAS, SEXO Y ROLES. OSEA ME PERMITE TRAER DIRECTAMENTE EL NOMBRE EN VEZ DE TRAER EL NUMERO Y TENER QUE VALIDAD A QUE PERTENECE CADA NUMERO*/

                                        $db->preparar("SELECT servicio.id_servicio, servicio.nombre, servicio.id_categoria, servicio.direccion, servicio.maps, servicio.imagens, categoria.nombre as categoriaName FROM servicio  INNER JOIN categoria ON servicio.id_categoria=categoria.id_categoria  WHERE servicio.id_categoria=$variable LIMIT $iniciar, $porPagina"); /*Le agrego WHERE servicio.id_categoria=15 para que solo me traiga los servicios con ese id de categoria*/
                                        $db->ejecutar();
                                        $db->prep()->bind_result( $dbid, $dbnombre, $dbcategoria, $dbdireccion, $dbmaps, $dbimagens, $dbcategorianame);
                                        /*$db->resultado();*/

                                       /*ACA TUVE UN PROBLEMA Y ES QUE EL $dbid NO ME ENTREGABA NINGUN VALOR, ESTO ERA PORQUE NO DECLARE LA LLAMADA A LA BASE DE DATOS Y TAMPOCO LA VARIABLE, ENTONCES ME MANDABA 0 Y NO ME DEJABA EDITAR*/
                                            $conteo=$iniciar; /*final del video 267 explica porque le pongo $iniciar*/
                                               
                                       
                                       while( $db->resultado() ){
                                                $conteo++; 
                                           /*le asigno a probando el valor de conteo, cuando sea multiplo de 3*/
                                           $probando = $conteo;
                                            $probando= $probando / 3;
                                           
                                           /*EN <a class='btn btn-success' href='mostrar2.php?editar=$dbid&id=$variable&nombre=$nombreser'>Ver</a> TUVE QUE MANDAR LA ID Y NOMBRE PORQUE AL APRETAR EN VER, SE BORRAN ESOS VALORES. PARA EVITAR ESO LOS ENVIO DE NUEVO Y LISTO*/
                                                echo "
                                                 
                                                 <div class='card col-sm-12 col-md-4 col-lg-4 col-xl-4'>
                                                    <img width='284' height='284' src='../index/$dbimagens' class='card-img-top ' alt='Imagen de instituciones' >
                                                    <div class='card-body'>
                                                      <h5 class='card-title' style='text-align:center;'>$dbnombre</h5>
                                                      <p class='card-text'>Direccion: $dbdireccion</p>
                                                    </div>
                                                    <div class='card-body' style='text-align:center;'>
                                                      <a class='btn btn-success' href='mostrar2.php?editar=$dbid&id=$variable&nombre=$nombreser'>Ver</a> 
                                                    </div>
                                                  </div>
                                                  
                                               
                                                ";
                                                  
                                           /*Esto es para saber si el numero es multiplo de 3, si llega a ser multiplo de 3 nos va a dar 0 y va a entrar al if, sino, no va a pasar nada. Hago esto para que se muestren de 3 en 3 servicios    https://www.adaweb.es/numeros-multiplos-en-php/       https://es.stackoverflow.com/questions/335891/multiplos-de-3-entre-2-y-20-php     */
                                                if ($conteo%3==0){
                                                  echo "<div class='w-100'></div> <br>";
                                                  }
                                                    
                                                    
                                                     
                                            }
                                        
                                                  
                                       
                                            $db->liberar();
                                       ?>
                                       
                                        </div>    
                               <?php 
                               
                               $anterior = ($pagina-1);
                               $siguiente = ($pagina+1);
                               
                               ?>
                               <a href="../secciones_generales/mostrar2.php"></a>
                               <nav aria-label="Page navigation example">
                                  <ul class="pagination">
                                  
                                   <?php if( !($pagina<=1)) :?>
                                   
                                    <li class="page-item"><a class="page-link" href='<?php echo "?pagina=$anterior" ?>'>Anterior</a></li>

                                    <?php endif; ?>  
                                    
                                    <?php
                                      if( $paginas >=1){
                                          for($x=1; $x<=$paginas; $x++){
                                              echo ($x == $pagina) ? "<li class='page-item'><a class='page-link' href='?pagina=$x'>$x</a></li>" : "<li class='page-item'><a class='page-link' href='?pagina=$x'>$x</a></li>";
                                          }
                                      }
                                      
                                      ?>
                                    
                                    
                                    
                                    <?php if( !($pagina>=$paginas)) :?>
                                 
                                    <li class="page-item"><a class="page-link" href='<?php echo "?pagina=$siguiente" ?>'>Siguiente</a></li>
                                    <?php endif; ?>
                                  </ul>
                                </nav>
                               
                           
    
    
    
     <?php endif; ?> 
    
    
   
    <!--     FOOTER     -->
    
    <?php include("../secciones_generales/footer.php"); ?>
    
    <!-- Footer -->
 
     
  <!--script de jquery para que funcione el boton de inicio por ejemplo-->
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5db1674db6.js" crossorigin="anonymous"></script> <!--PARA LOS LOGOS DE CERRAR SESION, pagina de https://fontawesome.com/ donde el juanpi me ayudo con los iconos-->
    
</body>
</html>
                                                 

                       