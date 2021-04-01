<?php
/*
  Plugin Name:       Prescription Book
  Plugin URI:        https://roshansapkota.com
  Description:       This plugin will store the prescriptions given by the physiotherapists.
  Version:           0.0.2
  Requires at least: 5.2
  Requires PHP:      7.2
  Author:            Roshan Sapkota
  Author URI:        https://roshansapkota.com
  License:           GPL3
  License URI:       https://www.gnu.org/licenses/gpl-3.0
  Text Domain:       prescriptionbook
  Domain Path:       /languages
 

Prescription Book is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Prescription Book is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Prescription Book. If not, see https://www.gnu.org/licenses/gpl-3.0
*/
/**
 * Register Prescription post types
 */
require_once plugin_dir_path(__FILE__) . 'includes/posttypes.php';
register_activation_hook( __FILE__, 'prescriptionbook_rewrite_flush');

/**
 * Register Prescriptionbook user roles
 */
require_once plugin_dir_path(__FILE__) . 'includes/roles.php';
register_activation_hook( __FILE__, 'prescriptionbook_register_role');
register_deactivation_hook( __FILE__, 'prescriptionbook_deregister_role');

/**
 * Add capabilities
 */

register_activation_hook( __FILE__, 'prescriptionbook_add_capabilities');
register_deactivation_hook( __FILE__, 'prescriptionbook_remove_capabilities');

/**
 * Adding CMB2 for custom fields
 */
require_once plugin_dir_path(__FILE__) . 'includes/CMB2-functions.php';


/**
 * Granting prescription access for index page for certain users
 */

 add_action( 'pre_get_posts', 'prescriptionbook_grant_access');

 function prescriptionbook_grant_access( $query) {
      if (isset($query->query_vars['post_type'])){
        if ($query->query_vars['post_type'] == 'prescription'){
          if (defined( 'REST_REQUEST') && REST_REQUEST){
           if (current_user_can('editor') || current_user_can('administrator')){
              $query->set('post_status', 'private');

            } elseif ( current_user_can('physiotherapist')){
            $query->set('post_status', 'private');
            
           } elseif (current_user_can ('patient')){
              $query->set('post_status', 'private');
              $query->set('meta_key', 'prescriptionbook_patient');
              $query->set('meta_value', get_current_user_id());
            } 

          
          
          }
        }
      }


 }

 //adding filter to content
 add_filter('the_content' , 'rest_access_filter_content');
 function rest_access_filter_content($content){
   if (current_user_can('administrator') || current_user_can('editor') || current_user_can('physiotherapist')){
     return $content;
   } elseif (current_user_can('patient')){
     // if('meta_key' == 'prescriptionbook_patient' && 'meta_value' == get_current_user_id()){
      global $post;
      $check_id = $post->ID;
     // remove_filter( 'get_post_metadata', 'rest_access_filter_metadata', 100 );
      $check_patient = get_post_meta($check_id, 'prescriptionbook_patient', true);
      if($check_patient == get_current_user_id()){
        return $content;
      } else {
        $content = 'Not authorised to access data.';
        return $content;
      }
   }

 }

 //adding filter to title
 add_filter('private_title_format' , 'rest_access_filter_title');
 function rest_access_filter_title($title){
   if (current_user_can('administrator') || current_user_can('editor') || current_user_can('physiotherapist')){
     return $title;
   } elseif (current_user_can('patient')){
     // if('meta_key' == 'prescriptionbook_patient' && 'meta_value' == get_current_user_id()){
      global $post;
      $check_id = $post->ID;
      //remove_filter( 'get_post_metadata', 'rest_access_filter_metadata', 100 );
      $check_patient = get_post_meta($check_id, 'prescriptionbook_patient', true);
      if($check_patient == get_current_user_id()){
        
        return $title;
      } else {
        $content = 'Not authorised to access data.';
        return $content;
      }
   }

 }

 //adding filter to custom post meta data
 function rest_access_filter_metadata($metadata, $object_id, $meta_key, $single){
//add more meta data to the following array
  $the_meta =['prescriptionbook_patient', 'prescriptionbook_videos'];
  foreach($the_meta as $meta_needed){
  // Here is the catch, add additional controls if needed (post_type, etc)
  //$meta_needed = 'prescriptionbook_patient';
  
        if ( isset( $meta_key ) && $meta_needed == $meta_key ){
          if (current_user_can('administrator') || current_user_can('editor') || current_user_can('physiotherapist')){
            return $metadata;
          }
          if (current_user_can('patient')){
            
            remove_filter( 'get_post_metadata', 'rest_access_filter_metadata', 100 );
            $patient_meta = get_post_meta( $object_id, 'prescriptionbook_patient', TRUE );
            add_filter ('get_post_metadata', 'rest_access_filter_metadata', 100, 4 );
            //global $post;
            //$check_id = $post->ID;
               // $check_patient = get_post_meta($check_id, 'prescriptionbook_patient', true);
                if($patient_meta == get_current_user_id()){
                  return $metadata;
                      } else {
                       //use $wpdb to get the value
        //global $wpdb;
        //$value = $wpdb->get_var( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id = $object_id AND  meta_key = '".$meta_key."'" );
                        $hidden_meta = 'Not authorised to access data.';
                        return $hidden_meta;
                      }
                      
                }            
         }   
  // Return original if the check does not pass
}
return $metadata;
}

add_filter( 'get_post_metadata', 'rest_access_filter_metadata', 100, 4 );

add_filter( 'the_title', 'prescriptionbook_remove_private_prefix');

function prescriptionbook_remove_private_prefix($title){
  $title = str_replace('Private: ', '', $title);
  return $title;
}