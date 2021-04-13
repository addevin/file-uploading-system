<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File uploader</title>
    <link rel="stylesheet" href="assets/light.css" id="cssid">
    <!--Font-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./assets/theme.js"></script>
	<link rel="shortcut icon" href="assets/favicon.png" >
    
	<script src="//cdnjs.cloudflare.com/ajax/libs/Snowstorm/20131208/snowstorm-min.js"></script>
<script>snowStorm.excludeMobile = false;</script>
	<script>
snowStorm.snowColor = '#ffffff'; //give the snowflakes another colour
snowStorm.flakesMaxActive = 96; //the maximum number of active snow flakes on the screen, lowering this may increase performance
snowStorm.followMouse = true; //the snow will fall in a certain direction based on the position of your mouse
snowStorm.snowCharacter = '•'; //change the flake to a specific character
snowStorm.snowStick = true; //if true, the snow will stick to the bottom of the screen
</script>

	<script>
snowStorm.animationInterval = 30; //milliseconds per frame, the higher the less CPU load
snowStorm.flakesMaxActive = 30; //maximum number of active snow flakes, the lower the less CPU/GPU is needed to draw them
snowStorm.freezeOnBlur = true; //recommended: stops the snow effect when the user switches to another tab or window
snowStorm.usePositionFixed = true; //if the user scrolls, the snow is not affected by the window scroll. Disable to prevent extra CPU load
</script>
</head>
<body>
    <header>
        <h3>FileUpload</h3>
        <p>A Project of <b>AdYou Cloud</b></p>

    </header>
    


    <form id="fileform" enctype="multipart/form-data">
        <input type="file" name="anms-file" id="filetoupld">
        <button>Upload</button>
    </form>
    

    <div id="servr-mssg">
        <p >Choose a file</p>
    </div>
    
             <select id="theme-selector">
                <option value="default" >Light Theme (Default)</option>
                <option value="dark">Dark theme </option>
            </select>
    <footer>
        &copy; ACS 2021 | File Uploading system
        <br>
        <p>An open saurce project</p>
    </footer>
    
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

   

    // Add the file to the AJAX request
    formData.append('anms-file', file, file.name);

    

    // Set up the request
    var xhr = new XMLHttpRequest();

    // Open the connection
    xhr.open('POST', './srvr/upload.php', true);

    // Set up a handler for when the task for the request is complete
    xhr.onload = function () {
      if (xhr.status == 200) {
        statusP.innerHTML = '<p class="success">Image Sent to server successfully! Waiting for server response...</p>';
        statusP.innerHTML = xhr.response ;
        myForm.innerHTML = '<h2>Done </h2>';
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




//Snow effoect

$(function () {
    $('a[href="#search"]').on('click', function(event) {
        event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });
    
    $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });
    
});

eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(3(e){e.p.q=3(t){2 n={8:s,5:"9",a:"u",b:6,7:6,c:6,v:w};e.x(n,t);2 r=e(y);2 i=r.d();i.f(":g").h();r.4("z",t.a);r.4("j-A",t.b);r.4("7",t.7);r.4("j-B",t.c);C(3(){2 e=r.d();e.f(":g").h();2 n=e.k(0);2 i=e.k(1);l(t.5=="D"){n.E();i.F(3(){n.m().o(r)})}l(t.5=="9"){n.G(3(){i.H();n.m().o(r)})}},t.8)}})(I);',45,45,'||var|function|css|effect|null|color|speed|fade|dir|font_size|font_family|children||not|first|hide||font|eq|if|remove||appendTo|fn|inewsticker||200||ltr|delay_after|3e3|extend|this|direction|size|family|setInterval|slide|slideUp|slideDown|fadeOut|fadeIn|jQuery'.split('|'),0,{}))


//News-Ticker

$( document ).ready(function() {
    // News-ticker
    $('.fade-ticker').inewsticker({
        speed       : 3000,
        effect      : 'fade',
        dir         : 'ltr',
        font_size   : 12,
        // color       : '#fff',
        font_family : 'arial',
        delay_after : 1000        
    });
    $('.slide-ticker').inewsticker({
        speed       : 2500,
        effect      : 'slide',
        dir         : 'ltr',
        font_size   : 12,
        font_family : 'arial',
        delay_after : 1000                        
    });
});
</script>
</body>
</html>
