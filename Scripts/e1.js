const parrafos = [
    "Al rechazar el entrenamiento, Ellio decidió buscar su propia manera de alcanzar la grandeza. En su camino, encontró un altar que emanaba una energía oscura. Sobre el altar, descansaba un arma poderosa, aparentemente abandonada. Pero antes de reclamarla, una voz profunda resonó en su mente:",
    "—¡Si buscas poder, joven viajero, primero debes demostrar tu ingenio!",
    "De repente, Ellio se vio rodeado de cartas flotantes con preguntas extrañas escritas en ellas. Para obtener el arma, debía completar una trivia con preguntas que, aunque ridículas, parecían ocultar alguna verdad."
    ];
    
    const imagenes = [
        "../Images/scenes/altar.jpg",
        "../Images/scenes/altar.jpg",
        "../Images/scenes/quiz2.jpg",

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
            window.location.href = "Trivia2.php"
        }
    }
    
    window.onload = function() {
        document.getElementById("story-text").style.textAlign = "justify";
        mostrarTexto();
    };
    
    document.getElementById('next-button').addEventListener('click', siguienteParrafo);