document.addEventListener("DOMContentLoaded", main);

function main(){


   
    tamañoDiv();
    

}


  function tamañoDiv() {

    document.getElementById('tamañocolor').addEventListener("mousemove", function() {
        let abstract = document.getElementById('tamañocolor');
        if (abstract.style.backgroundColor === "red") {
            abstract.style.backgroundColor = "blue"; 
        } else {
            abstract.style.backgroundColor = "red"; 
        }
    });
    let fontSize = 16; 
    let contador = Math.pow(fontSize, 2);
    let content = document.getElementById('tamañocolor');

    content.addEventListener("mousemove", function () {
        if (content.style.fontSize === "2em") {
            while (fontSize < contador) {
                fontSize += 1;
                content.style.fontSize = fontSize + "px";
            }
            content.style.fontSize = "1em";
        } else {
            content.style.fontSize = "2em";
        }
    });
}

