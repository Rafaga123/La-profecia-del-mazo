const parrafos = [
    "Ellio decidió ignorar el pedido de Liora. Aunque el bosque parecía lleno de promesas de aventuras, la soledad pronto comenzó a pesarle.",
    "Se adentró en una cueva oscura donde encontró un misterioso artefacto: un espejo antiguo.",
    "Al tocarlo, una figura sombría emergió, susurrando tentaciones y falsas promesas de poder. Sin el apoyo de Liora ni la guía de nadie, Ellio sucumbió a las manipulaciones de la sombra.",
    "El espejo le mostró visiones de grandeza, pero el precio era alto. Lentamente, su esencia comenzó a desvanecerse, atrapado en un ciclo interminable de ilusiones.", 
    "Sin la calidez de la amistad que Liora habría ofrecido, Ellio quedó perdido, con su corazón consumido por la soledad y el arrepentimiento."
    ];
    
    const imagenes = [
        "../Images/scenes/cuevaespejo.jpg",
        "../Images/scenes/cuevaespejo.jpg",
        "../Images/scenes/cuevaespejo.jpg",
        "../Images/scenes/cuevaespejo.jpg",
        "../Images/scenes/cuevaespejo.jpg",
        "../Images/scenes/cuevaespejo.jpg"
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
            window.location.href = "../Game/x1.php";
        }
    }
    
    window.onload = function() {
        document.getElementById("story-text").style.textAlign = "justify";
        mostrarTexto();
    };
    
    document.getElementById('next-button').addEventListener('click', siguienteParrafo);