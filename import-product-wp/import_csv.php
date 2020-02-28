<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
require_once( ABSPATH . 'wp-admin/includes/file.php' );

// Upload file
if(isset($_POST['btnSubmit'])){

  if($_FILES['file']['name'] != ''){
    $uploadedfile = $_FILES['file'];
    $upload_overrides = array( 'test_form' => false );
    $filename=$_FILES["upload"]["name"];

    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
    $csvFile = fopen($movefile['url'], 'r');
    var_dump($csvFile);
    $row = 1;
    if ($csvFile !== FALSE) {
      while(($line = fgetcsv($csvFile, 1000, ",")) !== FALSE){
        $num = count($line);
        var_dump($num);
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $line[$c]. "<br />\n";
        }
      }
    }
    $imageurl = "";
    if ( $movefile && ! isset( $movefile['error'] ) ) {
       $imageurl = $movefile['url'];
       echo "url : ".$imageurl;
    } else {
       echo $movefile['error'];
    }
  }

}
// if(isset($_POST['btnSubmit'])) {
//   // Allowed mime types
//     $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel',
//      'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
//   if(!empty($_FILES['upload']['name']) && in_array($_FILES['upload']['type'], $csvMimes)) {
//     if(!$_FILES['upload']['error']){
//       var_dump("ok file");
//
//       //validate the file
//       $new_file_name = strtolower($_FILES['upload']['tmp_name']);
//       $filename=$_FILES["upload"]["name"];
//       var_dump($filename);
//       //can't be larger than 300 KB
//       if($_FILES['upload']['size'] > (300000)) {
//         //wp_die generates a visually appealing message element
//         wp_die('Your file size is to large.');
//       }
//       else {
//         //the file has passed the test
//         //These files need to be included as dependencies when on the front end.
//         require_once( ABSPATH . 'wp-admin/includes/image.php' );
//         require_once( ABSPATH . 'wp-admin/includes/file.php' );
//         require_once( ABSPATH . 'wp-admin/includes/media.php' );
//
//         // Let WordPress handle the upload.
//         // Remember, 'upload' is the name of our file input in our form above.
//         $file_id = media_handle_upload( 'upload', 0 );
//         // $uploadedfile = $_FILES['upload'];
//
//         // $upload_overrides = array( 'test_form' => false );
//         // $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
//         // var_dump($movefile);
//
//         // Open uploaded CSV file with read-only mode
//         $csvFile = fopen(get_template_directory() .$filename, 'r');
//         var_dump($csvFile);
//         // Skip the first line
//         // fgetcsv($csvFile, 1000, ",");
//         // Parse data from CSV file line by line
//         $row = 1;
//         if ($csvFile !== FALSE) {
//           while(($line = fgetcsv($csvFile, 1000, ",")) !== FALSE){
//             $num = count($line);
//             var_dump($num);
//             $row++;
//             for ($c=0; $c < $num; $c++) {
//                 echo $line[$c]. "<br />\n";
//             }
//           }
//         }
//         if ( is_wp_error( $file_id ) ) {
//            wp_die('Error loading file!');
//         } else {
//           wp_die('Your menu was successfully imported.');
//         }
//       }
//     }
//     else {
//       //set that to be the returned message
//       wp_die('Error: '.$_FILES['upload']['error']);
//     }
//   }
// }
// Redirect to the listing page
// header("Location: index.php".$qstring);
?>
<h1>Import Product Brands</h1>

<!-- Form -->
<form method='post' action='' name='myform' enctype='multipart/form-data'>
  <table>
    <tr>
      <td>From Computer</td>
      <td><input type='file' name='file'></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type='submit' name='btnSubmit' value='Submit'></td>
    </tr>
  </table>
</form>
<!-- <h1>Excel Upload Form</h1> -->
<p>Choose an Excel file to upload.</p>
<form id="upload_form" action="" enctype="multipart/form-data" method="post" target="messages">
  <p><input name="file" id="upload" type="file"/></p>
  <p><input id="btnSubmit" name="btnSubmit" type="submit" value="Upload Selected Spreadsheet" /></p>
  <iframe name="messages" id="messages"></iframe>
  <p><input id="reset_upload_form" type="reset" value="Reset form" /></p>
</form>
