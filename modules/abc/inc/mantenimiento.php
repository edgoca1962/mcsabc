<?php

/******************************************************************************
 * 
 * 
 * Creación de páginas generales.
 * 
 * 
 *****************************************************************************/
$principal = get_posts([
   'post_type' => 'page',
   'post_status' => 'publish',
   'name' => 'sca-principal',
]);
if (count($principal) > 0) {
} else {
   $post_data = array(
      'post_type' => 'page',
      'post_title' => 'Sistema de Control de Acuerdos',
      'post_name' => 'sca-principal',
      'post_status' => 'publish',
   );
   wp_insert_post($post_data);
}
