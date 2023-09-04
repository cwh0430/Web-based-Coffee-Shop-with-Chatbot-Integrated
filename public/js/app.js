function openNav() {
    document.getElementById("navSidebar").style.width = "250px";
}

function closeNav() {
    document.getElementById("navSidebar").style.width = "0";
    document.getElementById("sidebarList").style.marginRight = "0";
}

$(document).ready(function () {
    loadProductCartModal();
    loadBeverageCartModal();
});

function loadProductCartModal() {
    $.ajax({
        method: "GET",
        url: "/getproductcartmodal",
        success: function (response) {
            var keys = Object.keys(response.cartItems);
            var orderSubTotal = document.getElementById("product-cart-total");
            var productCartItemDiv =
                document.getElementById("productCartItems");
            var cartItemList = document.getElementById("productCartItemList");
            var count = document.getElementById("product-cart-count");
            var responsiveCount = document.getElementById(
                "product-cart-count-responsive"
            );
            var productViewCartBtn =
                document.getElementById("product-view-cart");
            if (keys.length > 0) {
                orderSubTotal.innerHTML = "RM" + response.orderSubTotal;

                count.innerHTML = keys.length;
                responsiveCount.innerHTML = keys.length;
                var htmlContent = "";

                for (var i = 0; i < keys.length; i++) {
                    var cartItem = response.cartItems[keys[i]];
                    htmlContent += `
                    <li class="cart-modal-item">
                        <div class="cart-item-img-width">
                        <img src="/storage/${cartItem.img}"
                            alt="img" />
                        </div>
                        <div class="item-details">
                            <span class="item-name">${cartItem.name}</span>
                            <div class="item-info">
                                <span class="item-price">RM${cartItem.price}</span>
                                <span class="item-quantity text-muted" id="productCartModalQuantity-${cartItem.id}">Quantity: ${cartItem.quantity}</span>
                            </div>
                        </div>
                    </li>`;
                }

                cartItemList.innerHTML = htmlContent;
            } else {
                htmlContent = `<div class="empty-msg">Your Cart Is Empty</div>`;
                count.classList.add("hidden");
                responsiveCount.classList.add("hidden");
                orderSubTotal.innerHTML = "RM0";
                productCartItemDiv.innerHTML = htmlContent;
                cartItemList.classList.add("hidden");
                productViewCartBtn.classList.add("hidden");
            }
        },
    });
}

function loadBeverageCartModal() {
    $.ajax({
        method: "GET",
        url: "/getbeveragecartmodal",
        success: function (response) {
            var keys = Object.keys(response.cartItems);
            var orderSubTotal = document.getElementById("beverage-cart-total");
            var productCartItemDiv =
                document.getElementById("beverageCartItems");
            var cartItemList = document.getElementById("beverageCartItemList");
            var count = document.getElementById("beverage-cart-count");
            var responsiveCount = document.getElementById(
                "beverage-cart-count-responsive"
            );
            var beverageViewCartBtn =
                document.getElementById("beverage-view-cart");
            if (keys.length > 0) {
                orderSubTotal.innerHTML = "RM" + response.orderSubTotal;

                count.innerHTML = keys.length;
                responsiveCount.innerHTML = keys.length;
                var htmlContent = "";

                for (var i = 0; i < keys.length; i++) {
                    var cartItem = response.cartItems[keys[i]];
                    htmlContent += `
                    <li class="cart-modal-item">
                        <div class="cart-item-img-width">
                        <img src="/storage/${cartItem.img}"
                            alt="img" />
                        </div>
                        <div class="item-details">
                            <span class="item-name">${cartItem.name}</span>
                            <div class="item-info">
                                <span class="item-price">RM${cartItem.price}</span>
                                <span class="item-quantity text-muted" id="beverageCartModalQuantity-${cartItem.id}">Quantity: ${cartItem.quantity}</span>
                            </div>
                        </div>
                    </li>`;
                }

                cartItemList.innerHTML = htmlContent;
            } else {
                htmlContent = `<div class="empty-msg">Your Cart Is Empty</div>`;
                count.classList.add("hidden");
                responsiveCount.classList.add("hidden");
                orderSubTotal.innerHTML = "RM0";
                productCartItemDiv.innerHTML = htmlContent;
                cartItemList.classList.add("hidden");
                beverageViewCartBtn.classList.add("hidden");
            }
        },
    });
}
