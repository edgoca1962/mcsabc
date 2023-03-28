<?php

/******************************************************************************
 * 
 * 
 * Obtener Atributos de las páginas y los posts.
 * 
 * 
 *****************************************************************************/
if (!function_exists('themeframework_get_page_att')) {
   function themeframework_get_page_att($postType = '', $fullpage = false)
   {
      $atributos = [];
      $usuario = wp_get_current_user();
      $usuarioRoles = $usuario->roles;
      $userAdmin = false;
      $pag = '';
      $pag_ant = '';
      $imagen = '';
      $height = '';
      $fontweight = '';
      $display = '';
      $displaysub = '';
      $displaysub2 = '';
      $titulo = '';
      $subtitulo = '';
      $subtitulo2 = '';
      $div0 = '';
      $div1 = '';
      $div2 = '';
      $div3 = '';
      $div4 = '';
      $div5 = '';
      $agregarpost = '';
      $barra = '';
      $regresar = '';
      $templateParts = '';
      $templatePartsSingle = '';
      $prefijo = '';
      $consecutivo = '';
      $num_actas = '';
      $comite_id = '';
      $num_acuerdos = '';
      $status = '';
      $asignar_id = '';
      $parametros = '';
      if (in_array('administrator', $usuarioRoles) || in_array('author', $usuarioRoles)) {
         $userAdmin = true;
      } else {
         $userAdmin = false;
      }
      if (isset($_GET['cpt'])) {
         $postType = sanitize_text_field($_GET['cpt']);
      }
      if (isset(explode("/", $_SERVER['REQUEST_URI'])[3])) {
         if (explode("/", $_SERVER['REQUEST_URI'])[3] != '') {
            if (explode("/", $_SERVER['REQUEST_URI'])[3] == 'page') {
               $pag = 0; //explode("/", $_SERVER['REQUEST_URI'])[4];
            } else {
               $pag = explode("/", $_SERVER['REQUEST_URI'])[3];
            }
         } else {
            $pag = 0;
         }
      } else {
         $pag = '1';
      }
      if (isset($_GET['pag'])) {
         $pag_ant = sanitize_text_field($_GET['pag']);
      } else {
         $pag_ant = '1';
      }
      if (get_the_post_thumbnail_url()) {
         $imagen = get_the_post_thumbnail_url();
      } else {
         $imagen = get_template_directory_uri() . '/assets/img/bg.jpg';
      }
      if ($fullpage) {
         $height = "100vh";
         $fullpage = true;
      } else {
         $height = '60vh';
         $fullpage = false;
         $div1 = 'container py-5';
      }
      if (is_front_page()) {
         $templateParts = 'modules/core/template-parts/cor/';
      } else {
         if (get_the_ID()) {
            $templateParts = 'modules/' . substr(get_post(get_the_ID())->post_name, 0, 3) . '/template-parts/';
         } else {
            $templateParts = 'modules/core/template-parts/';
         }
      }
      $fontweight = 'fw-lighter';
      $display = 'display-4';
      $titulo = get_the_title();
      $subtitulo = 'Estamos dando Mantenimiento al Sitio';
      $displaysub = 'display-4';


      if (isset($_GET['comite_id'])) {
         $comite_id = sanitize_text_field($_GET['comite_id']);
         $titulo = 'Acuerdos ' . get_post($comite_id)->post_title;
      }
      if (isset($_GET['asignar_id'])) {
         $asignar_id = sanitize_text_field($_GET['asignar_id']);
         $titulo = 'Acuerdos Asignados a ' . get_user_by('ID', $asignar_id)->display_name;
      }
      if ($postType != 'page') {
         switch ($postType) {
            case 'post':
               if (is_single()) {
                  $titulo = 'Blog';
                  $subtitulo = get_the_title();
               } else {
                  $titulo = 'Blog';
                  $div3 = 'row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4';
               }
               if (get_the_archive_title() != 'Archives') {
                  $subtitulo = str_replace('Tag', 'Clasificación', get_the_archive_title(), $count);
               }
               $templateParts = 'modules/pst/template-parts/' . $postType;
               $templatePartsSingle = 'modules/pst/template-parts/' . $postType . '-single';
               $fontweight = 'fw-lighter';
               $display = 'display-4';
               $height = '60vh';
               $regresar = 'post';
               break;
            case 'comite':
               if (is_single()) {
                  $titulo = get_the_title();
               } else {
                  $titulo = 'Comités';
               }
               if (get_the_archive_title() != 'Archives') {
                  $subtitulo = '';
               } else {
                  $subtitulo = str_replace('Tag', 'Clasificación', get_the_archive_title(), $count);
               }
               $fontweight = 'fw-lighter';
               $display = 'display-4';
               $height = '60vh';
               $div0 = 'container py-5';
               $div1 = "row";
               $div2 = "col-xl-8";
               $div3 = "row row-cols-1 row-cols-lg-2 g-2 g-lg-5";
               $div5 = 'col-xl-4';
               $templateParts = 'modules/sca/template-parts/' . $postType;
               $templatePartsSingle = 'modules/sca/template-parts/' . $postType . '-single';
               $agregarpost = 'modules/sca/template-parts/' . $postType . '-mantenimiento';
               $barra = 'modules/sca/template-parts/sca-busquedas';
               $regresar = 'comite';
               break;
            default:
               $titulo = 'Indefinido';
               $div0 = 'container py-5';
               $div1 = 'row';
               $div2 = 'col';
               break;
         }
      }
      $atributos['userAdmin'] = $userAdmin;
      $atributos['pag'] = $pag;
      $atributos['pag_ant'] = $pag_ant;
      $atributos['imagen'] = $imagen;
      $atributos['height'] = $height;
      $atributos['fontweight'] = $fontweight;
      $atributos['display'] = $display;
      $atributos['displaysub'] = $displaysub;
      $atributos['displaysub2'] = $displaysub2;
      $atributos['titulo'] = $titulo;
      $atributos['subtitulo'] = $subtitulo;
      $atributos['subtitulo2'] = $subtitulo2;
      $atributos['div0'] = $div0;
      $atributos['div1'] = $div1;
      $atributos['div2'] = $div2;
      $atributos['div3'] = $div3;
      $atributos['div4'] = $div4;
      $atributos['div5'] = $div5;
      $atributos['template-parts'] = $templateParts;
      $atributos['agregarpost'] = $agregarpost;
      $atributos['barra'] = $barra;
      $atributos['template-parts-single'] = $templatePartsSingle;
      $atributos['regresar'] = $regresar;
      $atributos['prefijo'] =  $prefijo;
      $atributos['consecutivo'] = $consecutivo;
      $atributos['comite_id'] = $comite_id;
      $atributos['num_actas'] = $num_actas;
      $atributos['num_acuerdos'] = $num_acuerdos;
      $atributos['status'] = $status;
      $atributos['asignar_id'] = $asignar_id;
      $atributos['parametros'] = $parametros;
      return $atributos;
   }
}
