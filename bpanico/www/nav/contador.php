
<?php
//Contador Usuarios totales
    $n = 0;
    foreach ($thearray as $shifts){
        $n++;
    }
    //echo "Total Dispositivos: " . $n ."\n"; 

//Contador Routers Totales
    $resultado = mysqli_query($conexion, $usuarios);
    $rou=0;
    while($row=mysqli_fetch_assoc($resultado)){
        $rou++;
    }    
?>

<!-- Estadisticas -->
<div class="row">
    <!-- Para los iconos entramos a https://icons.getbootstrap.com/ -->
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="panel">
                     <div class="icono bg-rojo">
                         <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                     </div>
                     <div class="valor">
                         <h1 class="cantidad"><?php echo $n; ?></h1>
                         <p>Usuarios Totales</p>
                     </div> 
                  </div>  
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="panel">
                     <div class="icono bg-azul">
                     <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-router" viewBox="0 0 16 16">
                        <path d="M5.525 3.025a3.5 3.5 0 0 1 4.95 0 .5.5 0 1 0 .707-.707 4.5 4.5 0 0 0-6.364 0 .5.5 0 0 0 .707.707Z"/>
                        <path d="M6.94 4.44a1.5 1.5 0 0 1 2.12 0 .5.5 0 0 0 .708-.708 2.5 2.5 0 0 0-3.536 0 .5.5 0 0 0 .707.707ZM2.5 11a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1Zm4.5-.5a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0Zm2.5.5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1Zm1.5-.5a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0Zm2 0a.5.5 0 1 0 1 0 .5.5 0 0 0-1 0Z"/>
                        <path d="M2.974 2.342a.5.5 0 1 0-.948.316L3.806 8H1.5A1.5 1.5 0 0 0 0 9.5v2A1.5 1.5 0 0 0 1.5 13H2a.5.5 0 0 0 .5.5h2A.5.5 0 0 0 5 13h6a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5h.5a1.5 1.5 0 0 0 1.5-1.5v-2A1.5 1.5 0 0 0 14.5 8h-2.306l1.78-5.342a.5.5 0 1 0-.948-.316L11.14 8H4.86L2.974 2.342ZM14.5 9a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h13Z"/>
                        <path d="M8.5 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/>
                    </svg>
                     </div>
                     <div class="valor">
                         <h1 class="cantidad"><?php echo $rou; ?></h1>
                         <p>Roouters Funcionando</p>
                     </div> 
                  </div>  
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <div class="panel">
                     <div class="icono bg-amarillo">
                     <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                        <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                        <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                        </svg>
                     </div>
                     <div class="valor">
                         <h1 class="cantidad">3</h1>
                         <p>Logeados</p>
                     </div> 
                  </div>  
               </div>    
</div>

<!-- PARA VALIDAR SI LA TABLA DE EMERGENCIA ESTA VACIA O NO, esto le va a mostrar un mensaje o otro al usuario -->
<!-- https://www.lawebdelprogramador.com/foros/PHP/1767748-Comprobar-si-dato-de-tabla-mysql-esta-vacia-o-no.html -->
<?php
$q = $conexion->query("SELECT * FROM ubiemer");
if($q->num_rows > 0){
   //Colocamos aqui el código que se quiere ejecutar en caso que la consulta no devuelva vacío.
   ?>
   
   <!-- Slider infinito emergencia ALERTA-->
   <!-- https://www.youtube.com/watch?v=ZJHOrXZq11E -->
   <div class="contenedor">
       <div id="slider2"></div>
   </div>
   <?php
}else{
    ?>
    <!-- Slider infinito emergencia VIGILANDO-->
   <div class="contenedor">
       <div id="slider"></div>
   </div>
    <?php
}
?>