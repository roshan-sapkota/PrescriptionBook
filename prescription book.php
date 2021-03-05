<?php
/*
  Plugin Name:       Prescription Book
  Plugin URI:        https://roshansapkota.com
  Description:       This plugin will store the prescriptions given by the physiotherapists.
  Version:           0.0.1
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
