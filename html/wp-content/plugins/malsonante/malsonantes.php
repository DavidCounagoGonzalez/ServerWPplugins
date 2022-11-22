<?php

/*
Plugin Name: Plugin Malsonante
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Busca en la página palabras malsonantes y las cambia por otras
Author: DAM21
Version: 1.7.2
Author URI: http://ma.tt/
*/

function cambiar_malsonantes( $text ){
    $corregir = array('estúpido', 'Bienbenido', 'joder', 'caca');
    $corregido = array('tonto', 'Bienvenido', 'jolín', 'popo');
    return str_replace($corregir, $corregido, $text);

}

add_filter('the_content', 'cambiar_malsonantes');
