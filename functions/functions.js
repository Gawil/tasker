function createXHR()
{
  var req = null;
  if(window.XMLHttpRequest) {
    req = new XMLHttpRequest();
  }
  else if (window.ActiveXObject) {
    try {
      req = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
       try {
        req = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
            alert("XHR not created");
          }
      }
    }
    return req;
}

function submitForm()
{ 
  var xhr=createXHR();
  xhr.open("GET", "../database/todo.task",true);
  xhr.onreadystatechange=function()
  { 
    if(xhr.readyState == 4)
    {
      document.getElementById("zone").innerHTML= xhr.responseText;	
    } 
  }; 
  xhr.send(null); 
}
