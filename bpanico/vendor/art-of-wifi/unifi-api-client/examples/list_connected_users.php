<?php
/**
 * PHP API usage example
 *
 * contributed by: @gahujipo
 * description:    example to pull connected users and their details from the UniFi controller and output the results
 *                 in JSON format
 */
/**
 * using the composer autoloader
 */
require_once '../../../autoload.php';


/**
 * include the config file (place your credentials etc there if not already present)
 * see the config.template.php file for an example
 */
require_once 'config.php';

/**
 * the short name of the site which you wish to query
 */
$site_id = '37gm9avi';

/**
 * initialize the UniFi API connection class and log in to the controller and pull the requested data
 */
$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$set_debug_mode   = $unifi_connection->set_debug($debug);
$loginresults     = $unifi_connection->login();
$clients_array    = $unifi_connection->list_clients();
//convertimos la lista de clientes en un array 
$thearray = (array) $clients_array; //NO HACE FALTA

//intentando sacar -> y ""
//$aReplace = array('(', ')', '[', ']');
//$coordsReplaced = str_replace(array( '(', ')' ), '', $thearray); 

/**
 * output the results in JSON format
 */
header('Content-Type: application/json; charset=utf-8');
//echo json_encode($clients_array);

//mostramos el resultado
//var_dump proporciona información sobre el tamaño y tipo de datos de la variable, pone los datos en ""
var_dump($clients_array);

//print_r no da información sobre el tamaño de la variable ni sobre el tipo de datos.
//print_r($clients_array[0]);
//print_r($thearray[0]);

//$indice = array_search('c8:f3:19:36:69:5b', $thearray);

//$probandoo = array_search('04:18:d6:20:94:2f', $thearray, false);
//print $probandoo;

//echo "El número de elementos en el array es: " . count($thearray);
//$nuevoArray = array_chunk($thearray,2);
//print_r($thearray[0]);
//echo "El número de elementos en el array es: " . $indice;

//$location = $thearray[0]->ap_mac;
//echo $location;


//https://stackoverflow.com/questions/22823883/foreach-loop-on-stdclass-object/22870867
//creo una variable para el numero de usuario
$n = 1;
foreach ($thearray as $shifts){
    //echo 'MAC de AP: ' . $shifts->ap_mac . '\n' ; esto era una prueba
    //ahora muestro esa variable creada y le pongo un salto de linea al final
    echo "Dispositivo: " . $n ."\n"; 
    /*voy a mostrar el Ip del dispositivo. La visualizacion es de la siguiente manera. 
    se toma el array con los valores, el primer array[0] se asigna en $shifts
    para poder ver adentro de ese array tengo que saber el nombre de las variables*/
    //le agrego un salto de linea al final
    //empty() determina si una variable está vacía
    if (empty($shifts->ip)){
        echo "IP del Dispositivo: Sin acceder a la Red"."\n";
    }else{
        echo "IP del Dispositivo: " . $shifts->ip ."\n";
    }
    echo "MAC del Dispositivo: " . $shifts->mac ."\n";
    //aca hago una pregunta, si el hostname esta vacio que me muestro una cosa, sino esta vacio que haga otra
    if (empty($shifts->hostname)){
        echo "Hostname del Dispositivo: Sin nombre"."\n";
    }else{
        echo "Hostname del Dispositivo: " . $shifts->hostname ."\n";
    }

    //Nombre AP prueba de nombre
    if ($shifts->ap_mac == "24:a4:3c:b0:13:ca"){
        echo "MAC de AP: P1 ALA SUR AULA 11 y 12" ."\n";
    }else{
        echo "MAC de AP: " . $shifts->ap_mac ."\n"; 
    }
    
    //echo "MAC de AP: " . $shifts->ap_mac ."\n";
    echo "\n";
    echo "\n"; 
    $n++;
}