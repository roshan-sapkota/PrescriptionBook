<?php

use ParagonIE\Sodium\Core\Curve25519\Ge\P2;

/**
 * Register physiotherapist and patient role 
 */

 function prescriptionbook_register_role() {
     add_role('physiotherapist', 'Physiotherapist');
     add_role('patient', 'Patient');
     add_role('thadmin', 'TeleHealth Admin');
 }

 /**
 * DeRegister physiotherapist and patient role 
 */

function prescriptionbook_deregister_role(){
    remove_role('physiotherapist', 'Physiotherapist');
    remove_role('patient', 'Patient');
      remove_role('thadmin', 'TeleHealth Admin');
}

/**
 * Adjusting Capabilities of roles between administrator, thadmin, physiotherapist and patient
 */

 function prescriptionbook_add_capabilities(){
     $roles = array('administrator', 'thadmin', 'physiotherapist', 'patient');
    
     foreach($roles as $the_role){
         $role = get_role($the_role);
         $role->add_cap('read');
         

     }
     // giving access to patients to read private prescription but will be limited to access when they try to access from rest api
     $p_role = get_role('patient');
     $p_role-> add_cap('read_private_prescriptions');
     
     $u_roles = array('administrator','thadmin', 'physiotherapist');

     foreach ($u_roles as $the_role){
        $role = get_role($the_role);
        $role->add_cap('edit_prescriptions');
        $role->add_cap('publish_prescriptions');
        $role->add_cap('edit_published_prescriptions');
        $role->add_cap('delete_private_prescriptions');
        $role->add_cap('delete_prescriptions');
        $role->add_cap('upload_files');
        $role->add_cap('delete_published_prescriptions'); 
        
     }

     $su_roles = array('administrator','thadmin');

     foreach ($su_roles as $the_role){
        $role = get_role($the_role);
        $role->add_cap('read_private_prescriptions');
        $role->add_cap('edit_others_prescriptions');
        $role->add_cap('edit_private_prescriptions');               
        $role->add_cap('delete_others_prescriptions');
        $role->add_cap('upload_files');    

     }
// setting up the capabilities for telehealth admin
     $thadmin_role = get_role('thadmin');
     $thadmin_role-> add_cap('list_users');
     $thadmin_role-> add_cap('promote_users');
     $thadmin_role-> add_cap('remove_users');
     $thadmin_role-> add_cap('edit_files');
     $thadmin_role-> add_cap('edit_users');
     $thadmin_role-> add_cap('add_users');
     $thadmin_role-> add_cap('create_users');
     $thadmin_role-> add_cap('delete_users');
     
 


 /**
 * Removing Capabilities of roles between administrator, thadmin, when the plugin is deactivates
 */

function prescriptionbook_remove_capabilities(){
    $roles = array('administrator', 'thadmin');
   
    foreach($roles as $the_role){
       $role = get_role($the_role);
        $role->remove_cap('read');
        $role->remove_cap('read_private_prescriptions');
       $role->remove_cap('edit_others_prescriptions');
        $role->remove_cap('edit_private_prescriptions');               
        $role->remove_cap('delete_others_prescriptions');       
        $role->remove_cap('edit_prescriptions');
        $role->remove_cap('publish_prescriptions');
        $role->remove_cap('edit_published_prescriptions');
        $role->remove_cap('delete_private_prescriptions');
        $role->remove_cap('delete_prescriptions');
        $role->remove_cap('delete_published_prescriptions');
   


    }
}
 }