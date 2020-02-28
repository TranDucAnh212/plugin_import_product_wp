<?php
/********************************************************************************************
 * Plugin Name: Import Product Brands
 * Description: Import product brands infomation include ACF field into DB.
 * Version: 6.0.5
 * Text Domain: import-product-brands
 * Author: huynguyen201287
 * Plugin URI: https:papagroup.net
 * Author URI: huynguyen201287@gmail.com
 *******************************************************************************************/
 // Add menu
function import_product_brands_plugin_menu() {

  add_menu_page("Import Product Brands Plugin", "Import Product Brands","manage_options", "import_product_brands", "import_csv",plugins_url('/import-product-brands/img/icon.png'));
}
add_action("admin_menu", "import_product_brands_plugin_menu");

function import_csv() {
  include "import_csv.php";
}
