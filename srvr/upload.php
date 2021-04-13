
<?php

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; 

if(isset($_FILES["anms-file"]) ){
    
        if(isset($_POST['fldr'])){
            
            $dirName = $_POST['fldr'] ;
        }else{
            function generateRandomString($length = 10) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            $dirName = generateRandomString();
            mkdir('../uploads/' . $dirName, 0700);
        }
    
    
    
   
    $uploadDir = '/uploads/' . $dirName .'/';
    $target_file = '../'.$uploadDir . basename($_FILES["anms-file"]["name"]);
    $uploadOk = 1;
    $anonymFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



    // Check if file already exists
    if (file_exists($target_file)) {
    echo '<p class="danger"> [ The file <b>'. htmlspecialchars( basename( $_FILES["anms-file"]["name"])).'</b> is already exists.  </p>';
    $uploadOk = 0;
    }
/*
    // Allow certain file formats
    if($anonymFileType == "exe" || $anonymFileType == "bat" ) {
    echo '<p class="danger">Sorry, The file isn\'t allowed ( File type = <b> '.$anonymFileType.' )</b></div>';
    $uploadOk = 0;
    }*/
    
    // Check file size
    if ($_FILES["anms-file"]["size"] > 15000000) { //15MB
    echo '<p class="danger">your file is too large. but uploaded. please try to decrease the file size in next upload ! </p>';
    $uploadOk = 1;
    }

   

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo '<p class="danger">Sorry, your file was not uploaded.</p>';
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["anms-file"]["tmp_name"], $target_file)) {
        echo '<p class="success">The file <b>'. htmlspecialchars( basename( $_FILES["anms-file"]["name"])). '</b> has been uploaded.</p>';
        echo ' <input type="text" value="'.$actual_link.'/downld1?f='.$dirName.'"><br>';
        echo '<a href="'.$actual_link.'/downld1?f='.$dirName.'" target="blank">See uploaded file</a>';
    } else {
        echo '<p class="danger">Sorry, there was an error uploading your file.</p>';
    }
    }
   
} else{
    echo '<p class="danger"> Who are you ? </p>';
}



?>
