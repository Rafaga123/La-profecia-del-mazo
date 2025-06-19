const parrafos = [
    "Aunque completó el juego, decidió ignorar las advertencias. Al no unirse a la lucha, permitió que las sombras ganaran, sumiendo al reino en una eterna oscuridad. Morgana, decepcionada, intentó advertirle sobre las consecuencias de su elección, pero era demasiado tarde.",
    "Con el tiempo, Ellio se dio cuenta de que su inacción había llevado a la destrucción de todo lo que podría haber salvado. Aislado y atormentado por la culpa, deambuló por un mundo desolado, donde las risas y la luz de sus amigos eran solo recuerdos lejanos.",
    "Los sobrevivientes del reino intentan rebelarse contra las sombras, pero lo ven como un traidor. Atrapado entre las fuerzas oscuras y la ira del pueblo, Ellio decició tomar decisiones desesperadas para sobrevivir asi huyendo lo más posible, con cada acción erosionando aún más su alma, torturado por el remordimiento, Ellio vagó en soledad, recordando lo que podría haber sido..."
    ];
    
    const imagenes = [
        "../Images/scenes/reinoperdido.jpg",
        "../Images/scenes/oscuridad.jpg",
        "../Images/scenes/oscuridad.jpg",
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
            window.location.href = "x3.php";
        }
    }
    window.onload = function() {
        document.getElementById("story-text").style.textAlign = "justify";
        mostrarTexto();
    };
    
    document.getElementById('next-button').addEventListener('click', siguienteParrafo);
