<?php
/**
 * PHP API usage example
 *
 * contributed by: Art of WiFi
 * description:    example basic PHP script to pull current alarms from the UniFi controller and output in json format
 */

/**
 * using the composer autoloader
 */
require_once '../../../autoload.php';

/**
 * include the config file (place your credentials etc. there if not already present)
 * see the config.template.php file for an example
 */
require_once 'config.php';

/**
 * the site to use
 */
$site_id = '37gm9avi';

/**
 * initialize the UniFi API connection class and log in to the controller and do our thing
 */
$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$set_debug_mode   = $unifi_connection->set_debug($debug);
$loginresults     = $unifi_connection->login();
$data             = $unifi_connection->list_alarms();

/**
 * provide feedback in json format
 */
//echo json_encode($data, JSON_PRETTY_PRINT);
//echo $data[0]->ap_name;
foreach ($data as $alertas) {
    
        echo '<b>AP name:</b>' . $alertas->ap_name . ' <b>MAC:</b>' . $alertas->ap . ' <b>Fecha:</b>' . $alertas->datetime . ' <b>Alerta:</b>' . $alertas->msg . '<br>';
    
}