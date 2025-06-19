const parrafos = [
    "Esta vez, Ellio eligió entrenar con Cyrus. Armados con espadas de madera y corazones rebosantes de ambición, pasaron horas practicando técnicas de combate.",
    "Cyrus le enseñó a Ellio no solo cómo luchar, sino también a confiar en sí mismo y a ser responsable de sus decisiones. Al final de cada día, Ellio sentía que se acercaba un poco más a la persona valiente que anhelaba ser.",
    "Finalmente, el momento llegó para conocer a Alaric, el príncipe noble y valiente que gobernaba la región.",
    "Ellio se enteró de que el reino estaba en peligro, amenazado por fuerzas oscuras que buscaban desestabilizar la paz. Alaric, al enterarse de las hazañas de Ellio, lo convocó a su castillo.",
    "Al llegar, Ellio recibió su opción final, que le ofreció dos caminos:"
    ];
    
    const imagenes = [
        "../Images/scenes/entrenamiento.jpg",
        "../Images/scenes/entrenamiento.jpg",
        "../Images/scenes/reino2.jpg",
        "../Images/scenes/eleccion3.jpg",
        "../Images/scenes/eleccion3.jpg",
        "../Images/scenes/eleccion3.jpg"
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