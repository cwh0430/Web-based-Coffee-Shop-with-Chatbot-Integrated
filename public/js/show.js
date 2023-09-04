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
