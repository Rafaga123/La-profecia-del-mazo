
// Texto de la historia
const parrafos = [
 "Morgana quedó satisfecha. “Bien hecho, Ellio. Has demostrado tener mente rápida. Ahora, continúa tu aventura.”",
 "Al avanzar en su travesía, Ellio se encontró con Liora, una niña curiosa y alegre que irradiaba luz en su presencia. Ella le sonrió, mostrándole una flor brillante que había encontrado. Pronto se hicieron amigos, compartiendo historias sobre sus mundos. Liora, con su energía contagiosa, le ayudó a ver la belleza que rodeaba su nueva vida, despertando un sentido de pertenencia en Ellio.",
 "Poco después, Ellio recibió su toma de opciones en forma de cartas. Al abrirla, descubrió dos opciones:"
];

// Imágenes para cada párrafo
const imagenes = [
    "../Images/scenes/presencia.jpg",
    "../Images/scenes/naturaleza.jpg",
    "../Images/scenes/eleccion1.jpg",
];

let parrafoIndex = 0;
let charIndex = 0;
let mostrandoTexto = false;

// Función para mostrar el texto letra por letra
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

// Función para avanzar al siguiente párrafo
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

// Mostrar el texto al cargar la página
window.onload = function() {
    document.getElementById("story-text").style.textAlign = "justify";
    mostrarTexto();
};

document.getElementById('next-button').addEventListener('click', siguienteParrafo);