<?php

/*
Plugin Name: Plugin MalsonanteDB
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Busca en la página palabras malsonantes y las cambia por otras gracias a una BD
Author: DAM21
Version: 1.7.2
Author URI: http://ma.tt/
*/

function renym_wordpress_typo_fix( $text ) {
    // Objeto global del WordPress para trabajar con la BD
    global $wpdb;

    // recojemos el
    $charset_collate = $wpdb->get_charset_collate();

    // le añado el prefijo a la tabla
    $table_name = $wpdb->prefix . 'dam';

    // recogemos todos los datos de la tabla
    // los metemos en un array asociativo, en vez de indices numericos,
    // los indices son los nombres de las columnas de la tabla
    $resultado = $wpdb->get_results("SELECT * FROM " . $table_name, ARRAY_A);

    // recorremos el resultado
    foreach($resultado as $fila)
    {
        // mostramos el resultado en los logs
        error_log("Recorremos resultado: " . $fila['time']);
    }

    return str_replace( 'WordPress', 'WordPressDAM', $text );
}

/**
 * Añadimos la función renym_wordpress_typo_fix al filtro 'the_content'
 * Se ejecutará cada vez que se cargue un post
 */
add_filter( 'the_content', 'renym_wordpress_typo_fix' );

function plugin_db_update() {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $table_name = $wpdb->prefix . 'dam';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    name tinytext NOT NULL,
    text text NOT NULL,
    url varchar(55) DEFAULT '' NOT NULL,
    PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

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
add_action( 'plugins_loaded', 'plugin_db_update' );
