document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const rating = document.getElementById("rating");

    stars.forEach((star) => {
        star.addEventListener("mouseover", function () {
            const ratingValue = this.getAttribute("data-rating");
            highlightStars(ratingValue);
        });
    });

    star.addEventListener("mouseout", function () {
        const currentRating = ratingInput.value;
        highlightStars(currentRating);
    });

    star.addEventListener("click", function () {
        const ratingValue = this.getAttribute("data-rating");
        ratingInput.value = ratingValue;
        highlightStars(ratingValue);
    });
});

function highlightStars(rating) {
    stars.forEach((star) => {
        const starRating = star.getAttribute("data-rating");
        if (starRating <= rating) {
            if (star.classList.contains("star-inactive")) {
                star.classList.remove("star-inactive");
            }
            star.classList.add("star-active");
        }
    });
}
