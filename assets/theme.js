 



window.onload = function() {
    // Try to read from local storage, otherwise set to default
    let currentTheme = localStorage.getItem("mytheme") || "default";
    var stylesheet = document.getElementById('style-1');//be me (for enable or desable a theme) 
  
    setTheme("default", currentTheme);
    if(currentTheme == "dark"){
        var link = document.getElementById('cssid');
        link.setAttribute('href', 'assets/dark.css');
      
        }else{ //by me
            var link = document.getElementById('cssid');
            link.setAttribute('href', 'assets/light.css');
    
        }
    
  
    const themeSelector = document.getElementById("theme-selector");
    themeSelector.value = currentTheme;
  
    themeSelector.addEventListener("change", function(e) {
          
      const newTheme = e.currentTarget.value;
      setTheme(currentTheme, newTheme);

      if(currentTheme == "dark"){
        var link = document.getElementById('cssid');
        link.setAttribute('href', 'assets/dark.css');
      
        }else{ //by me
            var link = document.getElementById('cssid');
            link.setAttribute('href', 'assets/light.css');
    
        }
    });
  
    function setTheme(oldTheme, newTheme) {
      const body = document.getElementsByTagName("body")[0];
      
  
      body.classList.remove(oldTheme);
      body.classList.add(newTheme);
  
      currentTheme = newTheme;
  
      // Store the new theme in local storage
      localStorage.setItem("mytheme", newTheme);
    }
  };
  
  if(currentTheme == ""){
    localStorage.setItem("mytheme", dark);
  }
  
  