document.getElementById("start").style.visibility = "hidden";

// Generate webpage content
var link = "";
function makePage() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      document.getElementById("link").innerHTML =
        "http://localhost/" + xmlhttp.responseText;
    link = xmlhttp.responseText;
    document.getElementById("generate-Button").style.visibility = "hidden";
    document.getElementById("start").style.visibility = "visible";
  };
  var content = "";
  xmlhttp.open("GET", "./generatePage.php?content=" + content, true);
  xmlhttp.send();
}

function start() {
  window.open(link);
}
