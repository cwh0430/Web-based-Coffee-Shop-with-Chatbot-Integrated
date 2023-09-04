// document.addEventListener("DOMContentLoaded", function () {
//     const slider = document.getElementById("customRange");
//     const valueDisplay = document.getElementById("sliderValue");

//     slider.addEventListener("input", function () {
//         const value = parseFloat(slider.value).toFixed(2);
//         valueDisplay.textContent = "RM" + value;
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    const slider = document.getElementById("test5");
    const minPrice = document.getElementById("min-price");
    const maxPrice = document.getElementById("max-price");
    const rangeMaxPrice = document.getElementById("range-max-price");

    const minPriceValue = parseFloat(
        minPrice.innerHTML.replace(/[^\d.-]/g, "")
    );

    const maxPriceValue = parseFloat(
        maxPrice.innerHTML.replace(/[^\d.-]/g, "")
    );

    const minPriceInput = document.getElementById("min-price-input");
    const maxPriceInput = document.getElementById("max-price-input");
    const resetButton = document.getElementById("resetButton");

    noUiSlider.create(slider, {
        start: [parseInt(minPriceValue), parseInt(maxPriceValue)],
        connect: true,
        step: 1,
        range: {
            min: 0,
            max: parseInt(rangeMaxPrice.innerHTML),
        },
        format: wNumb({
            decimals: 2,
            prefix: "RM",
        }),
    });

    slider.noUiSlider.on("update", function () {
        const handleValue = slider.noUiSlider.get();
        showResetButton(handleValue);
        minPriceInput.value = handleValue[0];
        maxPriceInput.value = handleValue[1];

        console.log(maxPriceInput.value);

        minPrice.innerHTML = handleValue[0];
        maxPrice.innerHTML = handleValue[1];
        // add additional inputs if you have more than two handles...
    });

    function reset() {
        slider.noUiSlider.set([0, parseInt(rangeMaxPrice.innerHTML)]);

        minPriceInput.value = 0;
        maxPriceInput.value = parseInt(rangeMaxPrice.innerHTML);
        minPrice.innerHTML = "RM" + minPrice.toFixed(2);
        maxPrice.innerHTML = "RM" + maxPrice.toFixed(2);
        const handleValue = slider.noUiSlider.get();
        showResetButton(handleValue);
    }

    function showResetButton(values) {
        var minPrice = values[0];
        var maxPrice = values[1];

        var rangeMaxPriceString =
            "RM" + parseInt(rangeMaxPrice.innerHTML).toFixed(2);
        if (minPrice !== "RM0.00" || maxPrice !== rangeMaxPriceString) {
            if (resetButton.classList.contains("hidden")) {
                resetButton.classList.remove("hidden");
            }
        } else {
            resetButton.classList.add("hidden");
            console.log(minPrice);
        }
    }

    resetButton.addEventListener("click", reset);
});
