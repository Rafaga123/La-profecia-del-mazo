
// Párrafos de la historia
const parrafos = [
    "En un cálido sábado de verano. Ellio, un adolescente de espíritu optimista y ojos brillantes como el sol, se aventuró con su familia al bosque cercano a su hogar. La curiosidad y la emoción llenaban el aire mientras exploraban cada rincón del lugar. Sin embargo, lo que comenzó como una simple excursión familiar pronto se transformó en una aventura más allá de sus sueños.",
    "Mientras los demás recogían flores y buscaban pequeñas criaturas, Ellio se alejó un poco, atraído por una luz brillante que emergía de entre los arbustos. Al acercarse, se encontró con un viejo baúl de madera cubierto de polvo y enredaderas. Con el corazón latiendo con fuerza, lo abrió, revelando un mazo de cartas antiguas con extraños símbolos y colores vibrantes.",
    "Sin pensarlo dos veces, decidió barajar las cartas.",
    "De repente, una luz lo envolvió y, en un abrir y cerrar de ojos, se encontró en un mundo medieval deslumbrante. Los colores eran más vivos, los sonidos más intensos, y la magia estaba en cada rincón.",
    "Confundido pero emocionado, Ellio exploró el nuevo entorno hasta que se topó con una figura enigmática: Morgana, la conocida bruja de la leyenda, quien ocultaba misterios en sus profundidades.",
    "—Bienvenido, joven viajero —dijo Morgana, con una voz suave pero poderosa—. Tus cartas han determinado tu llegada aquí. Este mundo necesita tu ayuda, y tú serás quien decida su destino.",
    "Ellio sintió una mezcla de temor y asombro, pero un destello de determinación iluminó su corazón. Sabía que esta era su oportunidad de hacer algo grande. Morgana le explicó que las cartas no solo guiaban su camino, sino que cada una representaba decisiones cruciales que afectarían a todos a su alrededor.",
    "Mientras Morgana explicaba las reglas del mundo mágico, una ráfaga de luz salió de su báculo y formó un círculo de cartas flotantes a su alrededor. “Antes de comenzar tu viaje, joven Ellio, debes probar tu ingenio respondiendo unas preguntas. ¡Prepárate!” dijo con una sonrisa misteriosa.",
];

// Imágenes para cada párrafo
const imagenes = [
    "../Images/scenes/Praderas.jpg",
    "../Images/scenes/baul.jpg",
    "../Images/scenes/cofretarot.jpg",
    "../Images/scenes/reino.jpg",
    "../Images/scenes/presencia.jpg",
    "../Images/scenes/morgana.jpg",
    "../Images/scenes/presencia.jpg",
    "../Images/scenes/quiz1.jpg",
];

// Function to play audio
function playAudio(src) {
    const audio = new Audio(src);
    audio.loop = true;
    audio.play();
    return audio;
}

// Function to stop audio
function stopAudio(audio) {
    if (audio) {
        audio.pause();
        audio.currentTime = 0;
    }
}

// Audio sources
const audioSources = [
    "../Soundtrack/calm_start.mp3", // For the first 3 paragraphs
    "../Soundtrack/calm2.mp3", // For the next 2 paragraphs
    "../Soundtrack/morgana.mp3"  // For the remaining paragraphs
];

// Variables para controlar el texto y el audio
let parrafoIndex = 0;
let charIndex = 0;
let mostrandoTexto = false;

// Play audio for the first 3 paragraphs
let currentAudio = playAudio(audioSources[0]);

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

// Función para cambiar el audio basado en el índice del párrafo
function changeAudio(index) {
    if (index === 3) {
        stopAudio(currentAudio);
        currentAudio = playAudio(audioSources[1]);
    } else if (index === 5) {
        stopAudio(currentAudio);
        currentAudio = playAudio(audioSources[2]);
    }
}

// Funcion que permite pasar al siguiente parrafo
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
        changeAudio(parrafoIndex);
    } else {
        window.location.href = "trivia1.php"; // Redirigir a trivia1.php después del último párrafo
    }
}

// Mostrar el texto al cargar la página
window.onload = function() {
    document.getElementById("story-text").style.textAlign = "justify";
    mostrarTexto();
};

document.getElementById('next-button').addEventListener('click', siguienteParrafo);