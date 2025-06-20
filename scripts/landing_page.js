// This is for banner slider

const banners = document.querySelectorAll(".banner");
const btnSliderRight = document.querySelector(".btn-slider-right");
const btnSliderLeft = document.querySelector(".btn-slider-left");

let curSlide = 0;
let maxSlide = banners.length;

goToSlide(curSlide);
btnSliderRight.addEventListener("click", () => {
    if (curSlide === maxSlide - 1) {
        curSlide = 0;
    } else {
        curSlide++;
    }
    goToSlide(curSlide);
});
btnSliderLeft.addEventListener("click", () => {
    if (curSlide > 0) {
        curSlide--;
    } else {
        curSlide = maxSlide - 1;
    }
    goToSlide(curSlide);
});
function goToSlide(slide) {
    banners.forEach((val, i) => {
        val.style.transform = `translateX(${100 * (i - slide)}%)`;
    });
}
