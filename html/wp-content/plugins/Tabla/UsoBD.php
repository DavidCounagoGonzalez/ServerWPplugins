<?php

/*
Plugin Name: MalsonantesDB
Plugin URI: http://www.danielcastelao.org/
Description: Experimentación de varias técnicas para hacer un plugin
Version: 1.0
*/

function myplugin_update_db_check() {
    // Objeto global del WordPress para trabajar con la BD
    global $wpdb;

    // recojemos el
    $charset_collate = $wpdb->get_charset_collate();

    // le añado el prefijo a la tabla
    $table_name = $wpdb->prefix . 'dam';

    // creamos la sentencia sql
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // libreria que necesito para usar la funcion dbDelta
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );


    // insertamos valores

    $name='Pepe';
    $text='Hola Mundo';

    $result = $wpdb->insert(
        $table_name,
        array(
            'time' => current_time( 'mysql' ),
            'name' => $name,
            'text' => $text,
        )
    );

    error_log("Plugin DAM insert: " . $result);
}

/**
 * Ejecuta 'myplugin_update_db_check', cuando el plugin se carga
 */
add_action( 'plugins_loaded', 'myplugin_update_db_check' );