function addQuantity(index) {
    var quantityInput = document.getElementById("quantity-input-" + index);
    var responsiveQuantityInput = document.getElementById(
        "quantity-input-" + index + "-responsive"
    );
    var initialQuantity = parseInt(quantityInput.value);
    quantityInput.value = initialQuantity + 1;
    responsiveQuantityInput.value = quantityInput.value;
    var newQuantity = parseInt(quantityInput.value);
    var quantity = newQuantity - initialQuantity;
    var modelType = quantityInput.getAttribute("model-type");

    var url =
        modelType == "Beverage" ? "/updatebeveragecart" : "/updateproductcart";

    var modalTotal =
        modelType == "Beverage" ? "beverage-cart-total" : "product-cart-total";

    var modalQuantity =
        modelType == "Beverage"
            ? "beverageCartModalQuantity-" + index
            : "productCartModalQuantity-" + index;

    var modalNewQuantity = document.getElementById(modalQuantity);
    modalNewQuantity.textContent = "Quantity: " + newQuantity;
    console.log();
    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: csrfToken,
            id: index,
            quantity: quantity,
        },
        success: function (response) {
            var totalPrice = document.getElementById("total-price-" + index);
            var subTotal = document.getElementById("subtotal");
            var modalSubTotal = document.getElementById(modalTotal);

            totalPrice.textContent = "RM " + response.price.toFixed(2);
            subTotal.textContent = "RM " + response.subTotal.toFixed(2);
            modalSubTotal.textContent = "RM " + response.subTotal.toFixed(2);
        },
        error: function (xhr, status, error) {
            // Handle error
            console.log(error);
        },
    });
}

function minusQuantity(index) {
    var quantityInput = document.getElementById("quantity-input-" + index);
    var responsiveQuantityInput = document.getElementById(
        "quantity-input-" + index + "-responsive"
    );
    if (quantityInput.value > quantityInput.min) {
        var initialQuantity = parseInt(quantityInput.value);
        quantityInput.value = initialQuantity - 1;
        responsiveQuantityInput.value = quantityInput.value;
        var newQuantity = parseInt(quantityInput.value);
        var quantity = newQuantity - initialQuantity;

        var modelType = quantityInput.getAttribute("model-type");

        var url =
            modelType == "Beverage"
                ? "/updatebeveragecart"
                : "/updateproductcart";

        var modalTotal =
            modelType == "Beverage"
                ? "beverage-cart-total"
                : "product-cart-total";

        var modalQuantity =
            modelType == "Beverage"
                ? "beverageCartModalQuantity-" + index
                : "productCartModalQuantity-" + index;

        var modalNewQuantity = document.getElementById(modalQuantity);
        modalNewQuantity.textContent = "Quantity: " + newQuantity;

        var csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: csrfToken,
                id: index,
                quantity: quantity,
            },
            success: function (response) {
                var totalPrice = document.getElementById(
                    "total-price-" + index
                );
                var subTotal = document.getElementById("subtotal");
                var modalSubTotal = document.getElementById(modalTotal);

                totalPrice.textContent = "RM " + response.price.toFixed(2);
                subTotal.textContent = "RM " + response.subTotal.toFixed(2);
                modalSubTotal.textContent =
                    "RM " + response.subTotal.toFixed(2);
            },
            error: function (xhr, status, error) {
                // Handle error
                console.log(error);
            },
        });
    }
}

function userAddQuantity(index) {
    var quantityInput = document.getElementById("quantity-input-" + index);
    var responsiveQuantityInput = document.getElementById(
        "quantity-input-" + index + "-responsive"
    );
    quantityInput.value = parseInt(quantityInput.value) + 1;
    responsiveQuantityInput.value = quantityInput.value;
    var quantity = quantityInput.value;
    var modelType = quantityInput.getAttribute("model-type");

    var url =
        modelType == "Beverage" ? "/updatebeveragecart" : "/updateproductcart";

    var modalTotal =
        modelType == "Beverage" ? "beverage-cart-total" : "product-cart-total";

    var modalQuantity =
        modelType == "Beverage"
            ? "beverageCartModalQuantity-" + index
            : "productCartModalQuantity-" + index;

    var modalNewQuantity = document.getElementById(modalQuantity);
    modalNewQuantity.textContent = "Quantity: " + quantity;

    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: csrfToken,
            id: index,
            quantity: quantity,
        },
        success: function (response) {
            console.log(response.itemSubTotal);
            var totalPrice = document.getElementById("total-price-" + index);
            var subTotal = document.getElementById("subtotal");
            var modalSubTotal = document.getElementById(modalTotal);
            totalPrice.textContent = "RM " + response.itemSubTotal.toFixed(2);
            subTotal.textContent = "RM " + response.subTotal.toFixed(2);
            modalSubTotal.textContent = "RM " + response.subTotal.toFixed(2);
        },
        error: function (xhr, status, error) {
            // Handle error
            console.log(error);
        },
    });
}

function userMinusQuantity(index) {
    var numberFormatter = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "MYR", // Malaysian Ringgit
        minimumFractionDigits: 2,
    });
    var quantityInput = document.getElementById("quantity-input-" + index);
    var responsiveQuantityInput = document.getElementById(
        "quantity-input-" + index + "-responsive"
    );
    if (quantityInput.value > quantityInput.min) {
        var quantityInput = document.getElementById("quantity-input-" + index);
        quantityInput.value = parseInt(quantityInput.value) - 1;
        responsiveQuantityInput.value = quantityInput.value;
        var quantity = parseInt(quantityInput.value);
        var modelType = quantityInput.getAttribute("model-type");

        var url =
            modelType == "Beverage"
                ? "/updatebeveragecart"
                : "/updateproductcart";

        var modalTotal =
            modelType == "Beverage"
                ? "beverage-cart-total"
                : "product-cart-total";

        var modalQuantity =
            modelType == "Beverage"
                ? "beverageCartModalQuantity-" + index
                : "productCartModalQuantity-" + index;

        var modalNewQuantity = document.getElementById(modalQuantity);
        modalNewQuantity.textContent = "Quantity: " + quantity;

        var csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: csrfToken,
                id: index,
                quantity: quantity,
            },
            success: function (response) {
                var totalPrice = document.getElementById(
                    "total-price-" + index
                );
                var subTotal = document.getElementById("subtotal");
                var modalSubTotal = document.getElementById(modalTotal);

                totalPrice.textContent =
                    "RM " + response.itemSubTotal.toFixed(2);
                subTotal.textContent = "RM " + response.subTotal.toFixed(2);
                modalSubTotal.textContent =
                    "RM " + response.subTotal.toFixed(2);
            },
            error: function (xhr, status, error) {
                // Handle error
                console.log(error);
            },
        });
    }
}

// function showUpdateButton() {
//     var quantityInputs = document.querySelectorAll("[id^='quantity-input']");
//     var updateBtn = document.getElementById("update-btn");

//     for (var i = 0; i < quantityInputs.length; i++) {
//         var quantityInput = quantityInputs[i];
//         var initialQuantity = quantityInput.getAttribute("initial-quantity");

//         if (quantityInput.value !== initialQuantity) {
//             quantityChanged = true;
//             break;
//         } else {
//             quantityChanged = false;
//         }
//     }

//     if (quantityChanged) {
//         updateBtn.style.display = "block";
//     } else {
//         updateBtn.style.display = "none";
//     }
// }

// function minusQuantity(index) {
//     var quantityInput = document.getElementById("quantity-input-" + index);

//     // Decrease the quantity by 1, ensuring it doesn't go below the minimum value
//     if (quantityInput.value > quantityInput.min) {
//         quantityInput.value = parseInt(quantityInput.value) - 1;
//     }
//     showUpdateButton(index);
// }

// function showUpdateButton(index) {
//     var updateCartBtn = document.getElementById("update-btn");
//     var quantityInput = document.getElementById("quantity-input-" + index);
//     var initialQuantity = quantityInput.getAttribute("initial-quantity");

//     if (quantityInput.value !== initialQuantity) {
//         updateCartBtn.style.display = "block";
//     } else {
//         updateCartBtn.style.display = "none";
//     }
// }

// // document.addEventListener("DOMContentLoaded", function () {
// //     showUpdateButton(); // Call the function initially to set the initial display state of the button

// //     var quantityInput = document.getElementById("quantity-input");
// //     quantityInput.addEventListener("input", showUpdateButton);
// // });
