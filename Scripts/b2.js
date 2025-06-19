const parrafos = [
    "La búsqueda se convirtió en una emocionante aventura, y, tras varios intentos fallidos, finalmente encontraron al pequeño gato escondido entre las hojas secas.",
    "El rostro de Liora se iluminó de alegría, y su risa resonó como música en el aire. La conexión entre ellos creció, y así Ellio comenzó a comprender el poder de la amistad y el impacto de sus elecciones.",
    "A medida que continuaban su viaje, Ellio se cruzó con Cyrus, un amigo leal y humorístico que siempre tenía una broma lista para aliviar la tensión.",
    "Cyrus compartió historias de valientes guerreros y de la importancia de reír, incluso en los momentos más oscuros. Ellio se sintió inspirado por su valor y decidieron explorar juntos las tierras misteriosas.",
    "Pronto, Ellio recibió otras opciones. Esta vez, las opciones eran:"
    ];
    
    const imagenes = [
        "../Images/scenes/gatobosque.jpg",
        "../Images/scenes/gatobosque.jpg",
        "../Images/scenes/camino.jpg",
        "../Images/scenes/camino.jpg",
        "../Images/scenes/eleccion2.jpg",
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
            document.getElementById('text-box').style.display = 'none';
            document.getElementById('option1').style.display = 'inline-block';
            document.getElementById('option2').style.display = 'inline-block';
            document.getElementById('next-button').style.display = 'none'; // Ocultar el botón "Next" después de hacer clic
        }
    }
    
    window.onload = function() {
        document.getElementById("story-text").style.textAlign = "justify";
        mostrarTexto();
    };
    
    document.getElementById('next-button').addEventListener('click', siguienteParrafo);