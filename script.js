document.addEventListener("mousemove", function(event) {
    const blurBackground = document.getElementById('blur-background');
    const mouseX = event.pageX;
    const mouseY = event.pageY;
    const blurValue = Math.sqrt(Math.pow(window.innerWidth / 2 - mouseX, 2) + Math.pow(window.innerHeight / 2 - mouseY, 2)) / 30;
    blurBackground.style.filter = `blur(${blurValue}px)`;
});
