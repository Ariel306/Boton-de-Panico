<?php
/**
 * PHP API usage example
 *
 * contributed by: Art of WiFi
 * description:    example to pull connected user numbers for Access Points from the UniFi controller and output the results
 *                 in raw HTML format
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
$aps_array        = $unifi_connection->list_devices();

/**
 * output the results in HTML format
 * 
 * <b># connected clients:</b>' . $ap->num_sta
 */
header('Content-Type: text/html; charset=utf-8');
$n=1;
foreach ($aps_array as $ap) {
    
    if ($ap->type === 'uap') {
        echo "('" . $ap->mac . "' , '" . $ap->name . "' , '" . $n . "')," . '<br>';
    }
    $n++;
}