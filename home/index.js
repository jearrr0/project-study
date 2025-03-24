let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("slides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}

let hotelSlideIndex = 1;
showHotelSlides(hotelSlideIndex);

function plusHotelSlides(n) {
    showHotelSlides(hotelSlideIndex += n);
}

function currentHotelSlide(n) {
    showHotelSlides(hotelSlideIndex = n);
}

function showHotelSlides(n) {
    let i;
    let slides = document.getElementsByClassName("hotel-slides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {hotelSlideIndex = 1}
    if (n < 1) {hotelSlideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[hotelSlideIndex-1].style.display = "block";
    dots[hotelSlideIndex-1].className += " active";
}
