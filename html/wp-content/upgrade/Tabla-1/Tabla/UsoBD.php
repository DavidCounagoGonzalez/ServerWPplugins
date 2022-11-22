<?php

/*
Plugin Name: Plugin MalsonanteDB
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Busca en la página palabras malsonantes y las cambia por otras gracias a una BD
Author: DAM21
Version: 1.7.2
Author URI: http://ma.tt/
*/

global $jal_db_version;
$jal_db_version = '1.0';

function cambiar_malsonantes( $text ){
    $corregir = array('estúpido', 'Bienbenido', 'joder', 'caca');
    $corregido = array('tonto', 'Bienvenido', 'jolín', 'popo');
    return str_replace($corregir, $corregido, $text);

}
add_filter('the_content', 'cambiar_malsonantes');


function jal_install() {
    global $wpdb;
    global $jal_db_version;

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

}
add_action( 'plugins_loaded', 'jal_install' );
