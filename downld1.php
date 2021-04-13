<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Directory</title>
    <link rel="stylesheet" href="assets/d-page.css">
    <link rel="shortcut icon" href="assets/favicon.png" >
    <!--Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; 

if(isset($_GET['f'])){
    echo '<!--Nice connection-->';

    if($_GET['f']==null){
        echo '<p class="danger">Connection closed</p>';
        die('____');
    }else{
                                /** define the directory **/
                                $dir = "./uploads/{$_GET['f']}/";

                                /*** cycle through all files in the directory ***/
                                foreach (glob($dir."*.*") as $file) {
        
                                /*** if file is 24 hours (86400 seconds) old then delete it ***/
                                if(time() - filectime($file) > 86400){
                                    unlink($file);
                                    }
                                }
    }
}else{
    echo '<p class="danger">Connection closed</p>';
    die('____');
}


?>
    <h2>Thank you for using this Service</h2>
    <p>You can download files by clicking on the <b>Download</b> Button </p>
<a href="<?php echo $fieltod_file;?>" download style="display:none;">Download file</a>

<div class="directory">
    <?php 
    $iploadopen = false;
    if ($handle = opendir('./uploads/'.$_GET['f'])) {

        while (false !== ($entry = readdir($handle))) {
    
            
            if ($entry != "." && $entry != "..") {
                echo '<form action="downld" >';
                echo '<input value="'.$_GET['f'].'/'."$entry".'" type="hidden" name="f">';
                echo '<span>'."$entry\n ".'</span>';
                echo '<button>Download</button></form>';
                
            }
        }
    
        closedir($handle);
        $iploadopen = true ;
    }else{
        echo '<p class="danger">Error on fetching data</p>';
    }
   
    ?>
</div>
<?php

if($iploadopen == true){

}else{
    die('<p class="danger"> Wrong url, or try again later</p>');
}

?>

<form id="fileform" action="./srvr/upload.php" enctype="multipart/form-data">
        <input type="file" name="anms-file" id="filetoupld">
        <button type="submit">Upload</button>
    </form>
    

    <div id="servr-mssg">
        <p >Choose a file</p>
    </div>


    <script>
        
var myForm = document.getElementById('fileform');  // Our HTML form's ID
var myFile = document.getElementById('filetoupld');  // Our HTML files' ID
var statusP = document.getElementById('servr-mssg');

myForm.onsubmit = function(event) {
    event.preventDefault();

    statusP.innerHTML = '<i class="fa fa-cog fa-spin fa-3x fa-fw"></i> <span class="sr-only">Loading...</span><span style="font-family:sans-serif">Uploading..</span>';

	if(myFile.files.length == 0){
    statusP.innerHTML = '<p class="danger">Please select a file first</p>' ;
    }

    // Get the files from the form input
    var files = myFile.files;

    // Create a FormData object
    var formData = new FormData();

    // Select only the first file from the input array
    var file = files[0]; 

   var fldr = "<?php echo $_GET['f']; ?>" ;

    // Add the file to the AJAX request
    formData.append('anms-file', file, file.name);
    formData.append('fldr', fldr);

    

    // Set up the request
    var xhr = new XMLHttpRequest();

    // Open the connection
    xhr.open('POST', './srvr/upload.php', true);

    // Set up a handler for when the task for the request is complete
    xhr.onload = function () {
      if (xhr.status == 200) {
        statusP.innerHTML = '<p class="success">Image Sent to server successfully! Waiting for server response...</p>';
        statusP.innerHTML = xhr.response ;
        myForm.innerHTML = '<h2>Done (Refresh the page to se changes) </h2>';
      } else {
        statusP.innerHTML = '<p class="danger">Upload error. Try again.</p>';
      }
    }
    

    xhr.addEventListener('load', function(e) {
			// window.alert(request.response);
		});
    // Send the data.
    xhr.send(formData);
}
</script>


</body>
</html>