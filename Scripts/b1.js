const parrafos = [
    "Sin dudarlo, Ellio eligió ayudar a Liora. Juntos buscaron al gato, recorriendo los senderos del bosque y escuchando el eco de los árboles. Durante la búsqueda del gato de Liora, Ellio y su nueva amiga encontraron una puerta mágica que solo podía abrirse al completar un desafío especial.",
    "“¡Es un juego de memoria!” exclamó Liora. “Mira, debemos encontrar los pares de cartas mágicas.”",
    ];
    
    const imagenes = [
        "../Images/scenes/puertamagica.jpg",
        "../Images/scenes/puertamagica.jpg",
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

            //funcion para redireccionar a la siguiente pagina al hacer click en el boton
            window.location.href = "Memoria1.html"
        }
    }
    
    window.onload = function() {
        document.getElementById("story-text").style.textAlign = "justify";
        mostrarTexto();
    };
    
    document.getElementById('next-button').addEventListener('click', siguienteParrafo);