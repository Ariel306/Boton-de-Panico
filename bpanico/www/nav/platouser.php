<!-- https://getbootstrap.com/docs/5.0/components/accordion/ -->
<!-- Al crear el acordeon tuve que modificar algunas cosas, esto lo que va a hacer es que cuando se haga click para
ver una vista la otra se va a cerrar automaticamente-->
<div class="accordion" id="accordionExample">

<!-- Informacion APs -->
<!-- el id lo cambio y lo modifico en data-bs-target -->       
<div id="muestra" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
    <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">MAC del AP</th>
                        <th scope="col">Ubicacion AP</th>
                        <th scope="col">Imagen</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                           <?php
                                $resultado = mysqli_query($conexion, $usuarios);
                                while($row=mysqli_fetch_assoc($resultado)){
                                    
                                
                            ?>
                            <tr>
                            <td><?php echo $row["mac"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><img width="650" height="250" src="<?php echo $row["imagen"]; ?>" alt="platitos"></td>
                            
                            </tr>
                            
                            
                            
                            <?php } ?>
                        
                    </tbody>
                </table>
</div>



<!-- Informacion Usuarios -->
<div id="collapseExample" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="card card-body">  
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">IP del Dispositivo</th>
                        <th scope="col">MAC del Dispositivo</th>
                        <th scope="col">Hostname del Dispositivo</th>
                        <th scope="col">Nombre AP</th>
                        <th scope="col">Ubicacion AP</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $n = 1;
                        
                        foreach ($thearray as $shifts){
                            echo "<tr>";
                            //echo 'MAC de AP: ' . $shifts->ap_mac . '\n' ; esto era una prueba
                            //ahora muestro esa variable creada y le pongo un salto de linea al final
                            echo "<td>" . $n ."</td>"; 
                            /*voy a mostrar el Ip del dispositivo. La visualizacion es de la siguiente manera. 
                            se toma el array con los valores, el primer array[0] se asigna en $shifts
                            para poder ver adentro de ese array tengo que saber el nombre de las variables*/
                            //le agrego un salto de linea al final
                            //empty() determina si una variable está vacía
                            $SRed = "Sin Red";
                            if (empty($shifts->ip)){
                                echo "<td>". $SRed."</td>";
                            }else{
                                echo "<td>" . $shifts->ip ."</td>";
                            }
                            echo "<td>" . $shifts->mac ."</td>";
                            //aca hago una pregunta, si el hostname esta vacio que me muestro una cosa, sino esta vacio que haga otra
                            $Snombre = "Sin Nombre";
                            if (empty($shifts->hostname)){
                                echo "<td>" . $Snombre ."</td>";
                            }else{
                                echo "<td>" . $shifts->hostname ."</td>";
                            }
                            

                            //Nombre AP. Aca traigo el llamado a la base de datos y lo compruebo con
                            //los datos de la API, las mac que se parezcan me va a traer el nombre.
                            $resultados = mysqli_query($conexion, $usuarios);
                            while($row=mysqli_fetch_assoc($resultados)){
                                if ($shifts->ap_mac == $row["mac"]){
                                    echo "<td>" . $row["nombre"] ."</td>";   
                                }
                            }


                           
                            
                            //echo "<td>" . $shifts->ap_mac ."</td>";
                            //echo "\n";
                            //echo "\n"; 
                            $n++;
                            echo "<td>" . "<button type='button' class='btn btn-outline-primary'>Ver</button>". "<button type='button' class='btn btn-outline-primary'>MAC</button>" ."</td>";
                            echo "</tr>";
                            $cont = $n;
                        }
                    ?>
                    
                    </tbody>
                </table>
            </div>
          </div>
</div>


</div> 