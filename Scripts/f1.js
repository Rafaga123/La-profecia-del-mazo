const parrafos = [
    "Con el fuego de la determinación ardiendo en su pecho, Ellio eligió unirse a Alaric. Se sintió honorable y poderoso al lado del príncipe, sabiendo que sus decisiones estaban guiadas por la luz que traía consigo. Juntos, formaron un grupo valiente, ayudados por Liora y Cyrus, enfrentándose a los desafíos con coraje y amistad.",
    "La batalla fue intensa, pero el corazón de Ellio brilló con fuerza. Gracias a sus elecciones, unió a la gente del reino, quienes lucharon codo a codo para restaurar la paz. Morgana observaba desde la distancia, satisfecha con el crecimiento de Ellio y la sabiduría que había adquirido a través de sus experiencias.",
    "Al final, las sombras fueron derrotadas, y el reino volvió a brillar como el sol. Ellio, ahora un verdadero héroe, miró a sus amigos, sintiendo una gratitud abrumadora por las decisiones tomadas y las conexiones forjadas. No solo había aprendido sobre valentía, sino también sobre la importancia de la amistad y la luz que cada uno podía traer en tiempos de oscuridad.",
    "Con el corazón lleno de esperanza, Ellio sabía que, aunque su viaje en este nuevo mundo llegara a su fin, las lecciones aprendidas y los lazos formados durarían para siempre.",
    "Morgana, al despedirse, le presentó una última carta. “Recuerda, querido Ellio”, dijo con una sonrisa, “las decisiones que tomas y las amistades que cultivas iluminan no solo tu camino, sino el de todos los que te rodean”.",
    "Con una resolución ardiente, Ellio regresó a su hogar, llevando consigo no solo un mazo de cartas, sino también la esencia de un mundo que cambiaría para siempre su vida."
    ];
    
    const imagenes = [
        "../Images/scenes/lucha.jpg",
        "../Images/scenes/lucha.jpg",
        "../Images/scenes/reino3.jpg",
        "../Images/scenes/reino3.jpg",
        "../Images/scenes/final.jpg",
        "../Images/scenes/final.jpg"
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
            window.location.href = "../Game/x4.php";
        }
    }
    
    window.onload = function() {
        document.getElementById("story-text").style.textAlign = "justify";
        mostrarTexto();
    };
    
    document.getElementById('next-button').addEventListener('click', siguienteParrafo);