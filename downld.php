<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download-document</title>
    <link rel="stylesheet" href="assets/d-page.css">
    <link rel="shortcut icon" href="assets/favicon.png" >
</head>
<body>
<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; 


if( !empty( $_GET['f'] ) )
{
  // check if user is logged    

    $file_name1 = preg_replace( '#[^-\w]#', '', $_GET['f'] );
    $file_name = $_GET['f'] ;
    $fieltod_file1 = "./uploads/{$file_name}";
  $fieltod_file = "{$actual_link}/uploads/{$file_name}";
  $file_parts = pathinfo($fieltod_file);

    if( file_exists( $fieltod_file1 ) )
  {
    
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($fieltod_file1));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fieltod_file1));
    ob_clean();
    flush();
    readfile($fieltod_file1);
    echo filesize($fieltod_file1) ;
    exit;

   }else{
       echo 'The file is not exist on the server <br>';
       echo 'the file is deleted or it\'s a worng url, please check the link again! ';

       exit;
   }
  
}else{
    echo 'Something going on wrong..';
    exit;
}
//die( "ERROR: invalid song or you don't have permissions to download it." );

?>
    <h2>Thank you for using this Service</h2>
    <p>Your File will downloaded autoamatically </p>
    <b>Downloading <?php echo basename($fieltod_file) ?>...</b>
<a href="<?php echo $fieltod_file;?>" download style="display:none;">Download file</a>




</body>
</html>