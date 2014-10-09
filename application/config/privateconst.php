<?php

/* Questo file contiene informazioni riservate, da non rilasciare su GIT se contiene dati di produzione
 * Qui dovrebbero esserci tutit i delta di configurazione fra ambiente di sviluppo e di produzione
*/

define('BASE_URL',              'http://localhost:9999');
define('BASE_URL_CONSIDERING_MOBILE',   'http://localhost:9999');

define('DATABASE_USER',         'root');
define('DATABASE_PASSWORD',     '');
define('DATABASE_HOST',         'localhost');
define('DATABASE_NAME',         'smartpointer');


define('MAIL_HOST',             'smtp.aruba.it');
define('MAIL_USER',             'info@ecommuters.com');
define('MAIL_PASSWORD',         'mussa');
define('MAIL_PORT',             25);

define('ENVIRONMENT', 'development');
?>
