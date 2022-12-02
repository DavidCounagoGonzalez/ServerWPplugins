<?php

/*
Plugin Name: MalsonantesDB
Plugin URI: http://www.danielcastelao.org/
Description: Experimentación de varias técnicas para hacer un plugin
Version: 1.0
*/

function crea_tablas() {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $table_name = $wpdb->prefix . 'malsonantes';

    // crea sentencia sql
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        malsonante text NOT NULL,
        correccion text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // librería función dbDelta
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
add_action("plugins_loaded", "crea_tablas");

function insertar_valores(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'malsonantes';

    $mal1 = "INSERT INTO $table_name (id, malsonante, correccion) VALUES (1, 'tonto', 'listo')";
    $mal2 = "INSERT INTO $table_name (id, malsonante, correccion) VALUES (2, 'joder', 'jopelines')";
    $mal3 = "INSERT INTO $table_name (id, malsonante, correccion) VALUES (3, 'gilipollas', 'guapo')";
    $mal4 = "INSERT INTO $table_name (id, malsonante, correccion) VALUES (4, 'mierda', 'excremento')";
    $mal5 = "INSERT INTO $table_name (id, malsonante, correccion) VALUES (5, 'cabrón', 'carbón')";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($mal1);
    dbDelta($mal2);
    dbDelta($mal3);
    dbDelta($mal4);
    dbDelta($mal5);
}
add_action("plugins_loaded", "insertar_valores");



function cambiar_malsonantes( $text ){
    global $wpdb;
    $table_name = $wpdb->prefix . 'malsonantes';

    $correciones = $wpdb->get_results("SELECT correccion from $table_name");
    $malsonantes = $wpdb->get_results("SELECT malsonante from $table_name");

    $corregir = array();
    for ($i = 0; $i < sizeof($malsonantes); $i++) {
        $corregir[] = $malsonantes[$i]->text;
    }

    $correcion = array();
    for ($i = 0; $i < sizeof($correciones); $i++) {
        $correcion[] = $correciones[$i]->text;
    }

    return str_replace($corregir, $correcion, $text);
}
/**
 * Ejecuta 'cambiar_malsonantes', cuando el plugin se carga
 */
add_filter( 'the_content', 'cambiar_malsonantes' );