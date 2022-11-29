<?php

/*
Plugin Name: MalsonantesDB
Plugin URI: http://www.danielcastelao.org/
Description: Experimentación de varias técnicas para hacer un plugin
Version: 1.0
*/

function crea_tablas() {
    // Objeto global del WordPress para trabajar con la BD
    global $wpdb;

    // recojemos el
    $charset_collate = $wpdb->get_charset_collate();

    // le añado el prefijo a la tabla
    $table_name = $wpdb->prefix . 'malsonantes';

    // creamos la sentencia sql
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        malsonante text NOT NULL,
        correccion text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // libreria que necesito para usar la funcion dbDelta
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
add_action("plugins_loaded", "crea_tablas");

function insertar_valores(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'malsonantes';

    $mal1 = "INSERT INTO $table_name (id, malsonante) VALUES (1, 'tonto')";
    $mal2 = "INSERT INTO $table_name (id, malsonante) VALUES (2, 'joder')";
    $mal3 = "INSERT INTO $table_name (id, malsonante) VALUES (3, 'gilipollas')";
    $mal4 = "INSERT INTO $table_name (id, malsonante) VALUES (4, 'mierda')";
    $mal5 = "INSERT INTO $table_name (id, malsonante) VALUES (5, 'cabrón')";

    $bien1 = "INSERT INTO $table_name (id, correccion) VALUES (1, 'listo')";
    $bien2 = "INSERT INTO $table_name (id, correccion) VALUES (2, 'jopelines')";
    $bien3 = "INSERT INTO $table_name (id, correccion) VALUES (3, 'guapo')";
    $bien4 = "INSERT INTO $table_name (id, correccion) VALUES (4, 'excremento')";
    $bien5 = "INSERT INTO $table_name (id, correccion) VALUES (5, 'carbón')";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($mal1);
    dbDelta($mal1);
    dbDelta($mal1);
    dbDelta($mal1);
    dbDelta($mal1);

    dbDelta($bien1);
    dbDelta($bien2);
    dbDelta($bien3);
    dbDelta($bien4);
    dbDelta($bien5);
}
add_action("plugins_loaded", "insertar_valores");



function cambiar_malsonantes( $text ){
    global $wpdb;
    $table_name = $wpdb->prefix . 'malsonantes';

    $correciones = "SELECT correccion from $table_name";
    $malsonantes = "SELECT malsonante from $table_name";

    $corregir = array();
    for ($i = 0; $i < sizeof($malsonantes); $i++) {
        $corregir[] = $malsonantes[$i]->text;
    }

    $correcion = array();
    for ($i = 0; $i < sizeof($correciones); $i++) {
        $malsonantes[] = $correciones[$i]->text;
    }

    return str_replace($corregir, $correciones, $text);
}
/**
 * Ejecuta 'cambiar_malsonantes', cuando el plugin se carga
 */
add_filter( 'the_content', 'cambiar_malsonantes' );