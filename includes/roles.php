<?php

use ParagonIE\Sodium\Core\Curve25519\Ge\P2;

/**
 * Register physiotherapist and patient role 
 */

 function prescriptionbook_register_role() {
     add_role('physiotherapist', 'Physiotherapist');
     add_role('patient', 'Patient');
 }

 /**
 * DeRegister physiotherapist and patient role 
 */

function prescriptionbook_deregister_role(){
    remove_role('physiotherapist', 'Physiotherapist');
    remove_role('patient', 'Patient');
   
}

/**
 * Adjusting Capabilities of roles between administrator, editor, physiotherapist and patient
 */

 function prescriptionbook_add_capabilities(){
     $roles = array('administrator', 'editor', 'physiotherapist', 'patient');
    
     foreach($roles as $the_role){
         $role = get_role($the_role);
         $role->add_cap('read');

     }
     
     $u_roles = array('administrator','editor', 'physiotherapist');

     foreach ($u_roles as $the_role){
        $role = get_role($the_role);
        $role->add_cap('edit_prescriptions');
        $role->add_cap('publish_prescriptions');
        $role->add_cap('edit_published_prescriptions');
        $role->add_cap('delete_private_prescriptions');
        $role->add_cap('delete_prescriptions');
        $role->add_cap('delete_published_prescriptions'); 
        
     }

     $su_roles = array('administrator','editor');

     foreach ($su_roles as $the_role){
        $role = get_role($the_role);
        $role->add_cap('read_private_prescriptions');
        $role->add_cap('edit_others_prescriptions');
        $role->add_cap('edit_private_prescriptions');               
        $role->add_cap('delete_others_prescriptions');


     }
 }

 /**
 * Removing Capabilities of roles between administrator, editor, when the plugin is deactivates
 */

function prescriptionbook_remove_capabilities(){
    $roles = array('administrator', 'editor');
   
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