const sr = ScrollReveal({
    distance: '60px',
    duration: 2500,
    delay: 400,
    reset: true
})

sr.reveal('.text', { delay: 200, origin: 'top' })
sr.reveal('.heading', { delay: 200, origin: 'top' })
sr.reveal('.services-container .box', { delay: 600, origin: 'top' })
sr.reveal('.about-container .about-img', { delay: 600, origin: 'left' })
sr.reveal('.about-container .about-text', { delay: 600, origin: 'right' })


function hideCarsSec() {
    let x = document.getElementsByClassName('services');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    }
}


function text(x) {
    if (x == 0) document.getElementById("mycode").style.display = "block";
    else document.getElementById("mycode").style.display = "none";
    return;

}
