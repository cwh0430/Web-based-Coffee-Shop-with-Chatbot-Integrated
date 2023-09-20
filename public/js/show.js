document.addEventListener("DOMContentLoaded", function () {
    const reviewForm = document.getElementById("review-form");
    const stars = document.querySelectorAll(".star");
    const ratingInput = document.getElementById("rating");

    reviewForm.addEventListener("submit", function (event) {
        const selectedRating = parseInt(ratingInput.value);

        if (selectedRating === 0) {
            event.preventDefault(); // Prevent form submission
            alert("Please select a star rating before submitting.");
        }
    });

    stars.forEach((star) => {
        star.addEventListener("mouseover", function () {
            const ratingValue = star.getAttribute("data-rating");
            highlightStars(ratingValue);
        });

        star.addEventListener("mouseout", function () {
            const currentRating = parseInt(ratingInput.value);
            console.log(currentRating);
            highlightStars(currentRating);
        });

        star.addEventListener("click", function () {
            const ratingValue = star.getAttribute("data-rating");
            ratingInput.value = parseInt(ratingValue);
            highlightStars(ratingValue);
        });
    });
});

function highlightStars(rating) {
    const stars = document.querySelectorAll(".star");
    console.log(rating);
    if (rating > 0) {
        stars.forEach((star) => {
            const starRating = star.getAttribute("data-rating");
            const starIcon = star.querySelector(".fa-star");
            if (starRating <= rating) {
                if (starIcon) {
                    if (starIcon.classList.contains("star-inactive")) {
                        starIcon.classList.remove("star-inactive");
                    }
                    starIcon.classList.add("star-active");
                }
            } else {
                if (starIcon) {
                    if (starIcon.classList.contains("star-active")) {
                        starIcon.classList.remove("star-active");
                    }
                    starIcon.classList.add("star-inactive");
                }
            }
        });
    } else {
        stars.forEach((star) => {
            const starRating = star.getAttribute("data-rating");
            const starIcon = star.querySelector(".fa-star");

            if (starIcon) {
                if (starIcon.classList.contains("star-active")) {
                    starIcon.classList.remove("star-active");
                }
                starIcon.classList.add("star-inactive");
            }
        });
    }
}

function addQuantity() {
    var quantityInput = document.getElementById("quantityInput");
    var initialQuantity = quantityInput.value;
    quantityInput.value = parseInt(initialQuantity) + 1;
}

function minusQuantity() {
    var quantityInput = document.getElementById("quantityInput");
    if (quantityInput.value > quantityInput.min) {
        var initialQuantity = quantityInput.value;
        quantityInput.value = parseInt(initialQuantity) - 1;
    }
}
