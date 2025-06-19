const parrafos = [
    "Tras superar el desafío, Ellio tomó el arma, pero pronto descubrió que estaba maldita. Sin el conocimiento y la preparación que Cyrus habría ofrecido, Ellio no pudo controlar el poder del arma, y su esencia comenzó a desvanecerse, atrapada en una eterna lucha contra la criatura que guardaba el santuario.",
    "Le atrapó en un bucle interminable de lucha, donde cada derrota lo debilitaba más. Su arrogancia y falta de preparación sellaron su destino, dejando su espíritu atrapado en la ruina."
    ];
    
    const imagenes = [
        "../Images/scenes/criatura.jpg",
        "../Images/scenes/criatura.jpg",
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
            window.location.href = "../Game/x2.php";
        }
    }
    
    window.onload = function() {
        document.getElementById("story-text").style.textAlign = "justify";
        mostrarTexto();
    };
    
    document.getElementById('next-button').addEventListener('click', siguienteParrafo);