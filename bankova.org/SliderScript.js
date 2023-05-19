document.getElementById('slider-left').onclick = sliderLeft;
document.getElementById('slider-right').onclick = sliderRight;

var left = 0;
var timer;

autoSlider();

function autoSlider() {
    if (sliderLeft || sliderRight == True) {
        clearTimeout(timer);
    }

    timer = setTimeout(sliderLeft, 4000);
}

function sliderLeft() {
    var polosa = document.getElementById('polosa');
    left = left - 1903;

    if (left < -3806) {
        left = 0;
        clearTimeout(timer);
        
    }

    autoSlider();
    polosa.style.left = left + "px";
}

function sliderRight() {
    var polosa = document.getElementById('polosa');
    Right = Right  +1903;

    if (Right > + 3806) {
        Right = 0;
        clearTimeout(timer);
        
    }

    autoSlider();
    polosa.style.Right = Right + "px";
}