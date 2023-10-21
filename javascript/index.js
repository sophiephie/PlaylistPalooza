let forwardButton = document.getElementById("forwardButton");
let backButton = document.getElementById("backButton");
let slide1 = document.getElementById("slide1");
let slide2 = document.getElementById("slide2");
let slide3 = document.getElementById("slide3");
let slideText1 = document.getElementById("slideText1");
let slideText2 = document.getElementById("slideText2");
let slideText3 = document.getElementById("slideText3");
let imgPos = 1;


window.addEventListener("load", pageLoad);

forwardButton.addEventListener("click", nextImage);
backButton.addEventListener("click", previousImage);

function pageLoad() {
    slide1.style.display = "inline";
    slideText1.style.display = "inline";
}

function nextImage() {
    if (imgPos == 1) {
        slide1.style.display = "none";
        slideText1.style.display = "none";
        slide2.style.display = "inline";
        slideText2.style.display = "inline";
    } else if (imgPos == 2) {
        slide2.style.display = "none";
        slideText2.style.display = "none";
        slide3.style.display = "inline";
        slideText3.style.display = "inline";
    }

    if (imgPos < 3) {
        imgPos += 1;
    }
}

function previousImage() {
    if (imgPos == 3) {
        slide3.style.display = "none";
        slideText3.style.display = "none";
        slide2.style.display = "inline";
        slideText2.style.display = "inline";
    } else if (imgPos == 2) {
        slide2.style.display = "none";
        slideText2.style.display = "none";
        slide1.style.display = "inline";
        slideText1.style.display = "inline";
    }

    if (imgPos > 1) {
        imgPos -= 1;
    }
}

