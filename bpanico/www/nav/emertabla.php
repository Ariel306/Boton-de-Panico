<!-- Apartado Emergencias, comprobacion y carga de informacion -->
<table class="table">
                <thead>
                    <tr style="background: #ff8000; text-align:center; ">
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo de Emergencia</th>
                        <th scope="col">Ubicacion Usuario</th>
                        <th scope="col">IP Usuario</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Informacion</th>
                    </tr>
                </thead>
                <tbody>
                        
                        <?php
                        //Creo 2 objetos, uno para la table ap y otra ubiemer que estan en la base de datos
                            //es de la tabla AP
                            $prueba = mysqli_query($conexion, $usuarios);
                            //es de la tabla ubiemer
                            $prueba2 = mysqli_query($conexion, $Ubiemer);
                            //es de la tabla users
                            $compara = mysqli_query($conexion, $userss);
                            //Ahora recorremos el objeto ubiemer que tiene las IPs temporales que los usuarios mandan
                            while($row=mysqli_fetch_assoc($prueba2)){
                                /*Esto lo coloco para que me muestre la IP en la base de datos en caso
                                de que el dispositivo no este conectado o no se encuentre la ip en la API
                                Entonces los mensajes que me tenia que mostrar en caso de estan vacions no
                                los dejo y los comento
                                */  
                                //$prueip = $row["ip"];
                        ?>
                        <!-- vertical-align:middle; es para ponerlo al medio del cuadro  -->
                        <!-- text-align:center; es para centrar  -->
                            <tr style="vertical-align:middle; text-align:center;">
                        
                                <?php
                               //$ip = "Alerta";
                               $macap="Nada";
                               $ubicacion = "Sin Datos";
                               $nombre = "Sin registrar";
                               $imagen = null;
                               $color = "background-color:floralwhite";
                               $datoEmer = "Ya no esta en la facultad";
                                
                            foreach ($thearray as $shifts){

                                /*Al primer valor de ese objeto verifico que sea igual a los datos de la API
                                Si llegan a ser igual la Ip de la table con la de la API, que me traiga y guarde
                                en una variable la IP de ese dispositivo, la MAC y la MAC del AP */ 

                                /*Este “error” es mas bien un aviso, que nos alerta que por ejemplo existe una 
                                variable que no tiene información o alguna, que tengas en cuenta que hay una propiedad 
                                que la clase no tiene o que no esta definida.Cuando nos muestre este error el 
                                código se seguira ejecutando pero se debe corregirlo con un if para validar 
                                o colocando antes de la variable el simbolo @ con esto lo solucionamos.
                                */
                                if (@$shifts->ip == $row["ip"]){
                                    if($row["tipo"] == 1){
                                        $color = "background-color: darkgoldenrod";
                                        $datoEmer = "Necesito Ayuda";
                                    }else if ($row["tipo"] == 2){
                                        $color = "background-color: brown ";
                                        $datoEmer = "Urgencia";
                                    }else if ($row["tipo"] == 3){
                                        $color = "background-color: blueviolet";
                                        $datoEmer = "Violencia de Genero";
                                    }else{
                                        $color = "background-color:floralwhite";
                                    }  
                                    $ip = $shifts->ip;
                                    $macuser = $shifts->mac;
                                    $macap = $shifts->ap_mac;
                                    $codigo = $row["tipo"];
                                    $pruebas = $row["iden"];
                                    $dbip = $row["ip"];
                                } 
                            }

                            //esto es de la tabla users en mysql, aca lo que hago es recibir el iden
                            //de row (prueba2 que a su vez es de ubiemer)
                            foreach($compara as $chife){

                                //Este empty ya no hace falta, ya que arriba y abajo cargo el mensaje que va a 
                                //decir si la ip no si encuentra y demas datos 
                                if (empty($macap)){
                                    $nombre = "Sin registrar";
                                    //Agrego esto para guardar la IP porque no se muestra cuando esta desconectado
                                    $ip=$row["ip"];
                                }else{
                                }
                                
                                if ($chife["iden"] == $row["iden"]){
                                    $nombre = $chife["name"];
                                    //Agrego esto para guardar la IP porque no se muestra cuando esta desconectado
                                    $ip=$row["ip"];   
                                }
                            }
                            /* Ahora recorremos el objeto de la tabla AP y le digo que si la macap es igual a la
                            mac que tengo en esa table, que me traiga el nombre y la imagen que tiene esa mac
                            en esa table ap  */

                            /* 
                            Aca tuve un problema, esta usando un while y tenia que usar un foreash
                            */
                            foreach($prueba as $chiff){

                                //Este empty ya no hace falta, ya que arriba y abajo cargo el mensaje que va a 
                                //decir si la ip no si encuentra y demas datos 
                                if (empty($macap)){
                                    $macap = "El dispositivo no esta en la Facultad";
                                }else{
                                }
                                
                                if ($chiff["mac"] == $macap){
                                    $ubicacion = $chiff["nombre"];
                                    $imagen = $chiff["imagen"];   
                                }
                            }
                                ?>
                                <!-- Por ultimo solo imprimo las variables -->
                              <?php
                                    //aca esta el nombre que traigo si el usuario esta registrado, sino
                                    //no me muestra su nombre
                                    if (empty($nombre)){
                                        $nombre = "El dispositivo no esta en la Facultad";
                                        echo "<td>" . $nombre ."</td>";
                                    }else{
                                        echo "<td>" . $nombre ."</td>";
                                    }
                                    
                                    //Tampoco hace falta este empty
                                    if (empty($macap)){
                                        $macap = "Sin informacion";
                                        echo "<td>" . $macap ."</td>";
                                    }else{
                                        echo "<td style='$color'>" . $datoEmer ."</td>";
                                    }
                                    //Tampoco hace falta este empty
                                    if (empty($ubicacion)){
                                        $ubicacion = "Sin informacion";
                                        echo "<td>" . $ubicacion ."</td>";
                                    }else{
                                        echo "<td>" . $ubicacion ."</td>";
                                    }
                                    //Este empty ya no hace falta, ya que arriba y abajo cargo el mensaje que va a 
                                    //decir si la ip no si encuentra y demas datos
                                    if (empty($ip)){
                                        /*Si IP esta vacio, que guarde en IP la ip que esta en la base da datos, en la
                                        tabla de Ubiemer*/
                                        $ip=$row["ip"];
                                        echo "<td>" . $ip ."</td>";
                                    }else{
                                        echo "<td>" . $ip ."</td>";
                                    }
                              ?>
                                

                        
                            <td><img width="450" height="150" src="<?php echo $imagen ?>" alt="Sin Imagen"></td>
                            
                            <?php

                                //Este va a ser el Boton para traer las ultimas Ubicaciones de ese Usuario
                               //echo "<td>" . "<button type='button' type='submit' class='btn btn-outline-primary'>Resuelto</button>"."</td>";
                                //echo "<td>" . "<input type='hidden' name='id_cliente' value=''>"."</td>";
                               
                                    echo "<td><a class='btn btn-danger' href='index.php?eliminar=$ip'><i class='fas fa-trash'></i>Resuelto</a></td>";
                                //echo "<from action='eliminar.php' method='post'><input type='submit' name='submit' value='submit' /></form>";
                            ?>
                                <!-- No hace falta por el momento, esta definido arriba los valores -->
                                <?php
                                    //$ip = "Alerta";
                                    $macap="Nada";
                                    $ubicacion = "Sin Datos";
                                    $nombre = "Sin registrar";
                                    $imagen = null;
                                    $color = "background-color:floralwhite";

                                ?>

                            </tr>
                          
                        <?php } ?>
                        
                </tbody>
</table>

