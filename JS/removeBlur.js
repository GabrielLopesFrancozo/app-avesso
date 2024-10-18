const mainDiv = document.getElementById('main');
const seguidor = document.getElementById('seguidor');
const blurDiv = document.querySelector('.blur');

let isInside = false;

mainDiv.addEventListener('mouseenter', () => {
    isInside = true;
});

mainDiv.addEventListener('mouseleave', () => {
    isInside = false;
});

mainDiv.addEventListener('mousemove', (event) => {
    if (isInside) {
        const rect = mainDiv.getBoundingClientRect();
        const x = event.clientX - rect.left - (seguidor.offsetWidth / 2);
        const y = event.clientY - rect.top - (seguidor.offsetHeight / 2);

        // Atualiza a posição do seguidor
        seguidor.style.left = `${x}px`;
        seguidor.style.top = `${y}px`;

        // Atualiza o mask para fazer o "furo" no blur
        blurDiv.style.maskImage = `radial-gradient(circle at ${x + seguidor.offsetWidth / 2}px ${y + seguidor.offsetHeight / 2}px, transparent 10px, black 100px)`;
    }
});