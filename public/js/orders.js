function toggleOrderType(orderType) {
    const dineIn = document.getElementById("dine-in");
    const takeOut = document.getElementById("take-out");

    if (orderType.toLowerCase() === "dine-in") {
        dineIn.classList.add("active-order-type");
        dineIn.style.border = "1px dotted yellow";
        takeOut.classList.remove("active-order-type");
        takeOut.style.border = "1px dotted rgba(63, 63, 61, 0.425)";
    } else if (orderType.toLowerCase() === "take-out") {
        takeOut.classList.add("active-order-type");
        takeOut.style.border = "1px dotted yellow";
        dineIn.classList.remove("active-order-type");
        dineIn.style.border = "1px dotted rgba(63, 63, 61, 0.425)";
    }

    document.getElementById("type").value = orderType;
}

function addDishToOrder(dishCard) {
    const dishImage = dishCard.querySelector("img").src;
    const dishName = dishCard.querySelector(".dish-name").innerText;
    const dishPriceText = dishCard.querySelector(".dish-price").innerText;
    const initialDishPrice = parseFloat(dishPriceText.replace("P", ""));

    const orderList = document.getElementById("order-list");
    const existingDish = Array.from(
        orderList.querySelectorAll(".dish-container")
    ).find((container) => {
        return container.querySelector("p.m-0").innerText === dishName;
    });

    if (existingDish) {
        // Update quantity if dish is already in the order list
        const quantityElement = existingDish.querySelector(".quantity");
        let quantity = parseInt(quantityElement.innerText);
        quantityElement.innerText = quantity + 1;
        updateDishPrice(existingDish, initialDishPrice, quantity + 1);
    } else {
        // Add new dish to the order list
        const dishContainer = document.createElement("div");
        dishContainer.className = "dish-container";

        dishContainer.innerHTML = `
            <button class="remove-dish-btn" onclick="removeDish(this)">×</button>
            <img src="${dishImage}" alt="${dishName}">
            <p class="m-0 dish-name">${dishName}</p>
            <div class="quantity-control">
                <a onclick="changeQuantity(this, -1, ${initialDishPrice})">-</a>
                <span class="quantity">1</span>
                <a onclick="changeQuantity(this, 1, ${initialDishPrice})">+</a>
            </div>
            <h4 class="m-0 text-warning fw-bold dish-total">P${initialDishPrice.toFixed(
                2
            )}</h4>
            <input type="hidden" name="dish_name[]" id="dish_name" value="${dishName}">
            <input type="hidden" class="dish-quantity" name="quantity[]" id="quantity" value="1">
            <input type="hidden" class="dish-price" name="price[]" id="price" value="${initialDishPrice.toFixed(
                2
            )}">
        `;

        orderList.appendChild(dishContainer);
    }

    updateTotal();
    updateChange();
    updateOrderButtons();

    // Add selected class to the clicked dish card
    const dishCards = document.querySelectorAll(".dish-card");
    dishCards.forEach((card) => card.classList.remove("selected"));
    dishCard.classList.add("selected");
}

function changeQuantity(button, amount, price) {
    const quantityElement = button.parentElement.querySelector(".quantity");
    let quantity = parseInt(quantityElement.innerText);
    quantity = Math.max(1, quantity + amount);
    quantityElement.innerText = quantity;

    const dishContainer = button.closest(".dish-container");
    const quantityInput = dishContainer.querySelector(".dish-quantity");
    quantityInput.value = quantity; // Update the hidden input field with the new quantity

    updateDishPrice(dishContainer, price, quantity);
    updateTotal();
    updateChange();
}

function updateDishPrice(dishContainer, unitPrice, quantity) {
    const priceElement = dishContainer.querySelector(".dish-total");
    const totalPrice = unitPrice * quantity;
    priceElement.innerText = `P${totalPrice.toFixed(2)}`;

    // Update the hidden input field with the new total price
    const priceInput = dishContainer.querySelector(".dish-price");
    priceInput.value = totalPrice.toFixed(2);
}

function updateDishPrice(dishContainer, unitPrice, quantity) {
    const priceElement = dishContainer.querySelector(".dish-total");
    const totalPrice = unitPrice * quantity;
    priceElement.innerText = `P${totalPrice.toFixed(2)}`;
}

function updateTotal() {
    const orderList = document.getElementById("order-list");
    let total = 0;
    const dishes = orderList.querySelectorAll(".dish-container");
    dishes.forEach((dish) => {
        const priceText = dish.querySelector(".dish-total").innerText;
        const price = parseFloat(priceText.replace("P", ""));
        total += price;
    });

    document.getElementById("total").value = `P${total.toFixed(2)}`;
}

function updateOrderButtons() {
    const orderList = document.getElementById("order-list");
    const paymentInput = document.getElementById("payment");
    const placeOrderButton = document.getElementById("place-order-btn");

    // Disable payment input and place order button if there are no dishes
    if (orderList.children.length === 0) {
        document.getElementById("payment").value = "0.00";
        document.getElementById("change").value = "0.00";
        paymentInput.disabled = true;
        placeOrderButton.disabled = true;
    } else {
        paymentInput.disabled = false;
        placeOrderButton.disabled = false;
    }
}

// Call updateOrderButtons initially to set initial state
updateOrderButtons();

function removeDish(button) {
    const dishContainer = button.parentElement;
    dishContainer.remove();
    updateTotal();
    updateChange();
    updateOrderButtons();
}

function updateTotal() {
    const orderList = document.getElementById("order-list");
    let total = 0;
    const dishes = orderList.querySelectorAll(".dish-container");
    dishes.forEach((dish) => {
        const priceText = dish.querySelector("h4").innerText;
        const price = parseFloat(priceText.replace("P", ""));
        total += price;
    });

    document.getElementById("total").value = `${total.toFixed(2)}`;
}

function updateChange() {
    const totalElement = document.getElementById("total");
    const paymentElement = document.getElementById("payment");
    const changeElement = document.getElementById("change");
    const warningElement = document.getElementById("warning-message");

    const total = parseFloat(totalElement.value.replace("P", ""));
    const payment = parseFloat(paymentElement.value);

    if (payment < total) {
        changeElement.value = "";
        warningElement.innerText =
            "The payment entered is less than the total.";
    } else {
        const change = payment - total;
        changeElement.value = `${change.toFixed(2)}`;
        warningElement.innerText = "";
    }
}

// Event listener for the payment input
document.getElementById("payment").addEventListener("input", updateChange);
