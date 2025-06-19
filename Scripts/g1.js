const parrafos = [
    "Cuando llegó la carta final, Ellio, abrumado por el miedo, decidió no involucrarse en la batalla. Pero, antes de partir, Morgana apareció con un desafío final: un juego de memoria."
    ];
    
    const imagenes = [
        "../Images/scenes/oscuridad2.jpg",
    ];
    
    let parrafoIndex = 0;
    let charIndex = 0;
    let mostrandoTexto = false;
    
    function mostrarTexto() {
        mostrandoTexto = true;
        if (charIndex < parrafos[parrafoIndex].length) {
            document.getElementById("story-text").innerHTML += parrafos[parrafoIndex].charAt(charIndex);
            charIndex++;
            setTimeout(mostrarTexto, 50); 
        } else {
            mostrandoTexto = false;
        }
    }
    
    function siguienteParrafo() {
        if (mostrandoTexto) {
            document.getElementById("story-text").innerHTML = parrafos[parrafoIndex];
            charIndex = parrafos[parrafoIndex].length;
            mostrandoTexto = false;
        } else if (parrafoIndex < parrafos.length - 1) {
            parrafoIndex++;
            charIndex = 0;
            document.getElementById("story-text").innerHTML = "";
            document.querySelector(".game-image").src = imagenes[parrafoIndex];
            mostrarTexto();
        } else {
            window.location.href = "../Game/Memoria2.html"
        }
    }
    
    window.onload = function() {
        document.getElementById("story-text").style.textAlign = "justify";
        mostrarTexto();
    };
    
    document.getElementById('next-button').addEventListener('click', siguienteParrafo);