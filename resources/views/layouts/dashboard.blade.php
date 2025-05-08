<style>
    /* CSS for the scrollable content */
    .scrollable-content {
        cursor: pointer;
        border: 2px solid #333340;
        ;
        padding: 10px;
        transition: border 0.3s ease;
    }

    /* CSS for the active state */
    .scrollable-content.active {
        border: 2px solid yellow;
    }
</style>

<div class="container-fluid">
    <div class="container-fluid px-5">
        <div class="row g-3 my-2">
            <div class="col dashboard">
                @foreach ($categories as $category)
                    @if ($category->status == 'active')
                        <!-- Adjust the condition based on your actual status value (e.g., 1 or 'active') -->
                        <div id="category-{{ $category->id }}" class="scrollable-content" ondblclick="enableDrag(event)">
                            <img src="{{ asset('storage/img/' . $category->image) }}" alt="{{ $category->name }}" />
                            <h5 class="text-uppercase fw-bold">{{ $category->name }}</h5>
                        </div>
                    @endif
                @endforeach

            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    // Select the first child element and add the active class
                    const firstContent = document.querySelector('.scrollable-content:first-child');
                    if (firstContent) {
                        firstContent.classList.add('active');
                        filterProducts(firstContent.id.split('-')[1]); // Filter products by the first category ID
                    }

                    // Add event listeners to all scrollable-content elements
                    document.querySelectorAll('.scrollable-content').forEach(element => {
                        element.addEventListener('click', handleClick);
                    });
                });

                // JavaScript to handle click event
                function handleClick(event) {
                    // Remove active class from all scrollable-content elements
                    const allContent = document.querySelectorAll('.scrollable-content');
                    allContent.forEach(content => content.classList.remove('active'));

                    // Add active class to the clicked element
                    const clickedElement = event.currentTarget;
                    clickedElement.classList.add('active');

                    // Log the ID of the clicked element to the console
                    const categoryId = clickedElement.id.split('-')[1];
                    console.log('Clicked element ID:', categoryId);

                    // Filter products based on the category ID
                    filterProducts(categoryId);
                }

                function filterProducts(categoryId) {
                    const allProducts = document.querySelectorAll('.product');
                    allProducts.forEach(product => {
                        if (product.dataset.categoryId === categoryId) {
                            product.style.display = 'block';
                        } else {
                            product.style.display = 'none';
                        }
                    });
                }

                function enableDrag(event) {
                    // Function to enable drag functionality if needed
                }
            </script>




        </div>
    </div>
    <div class="container-custom container-fluid px-5">

        <div class="row row-cols-1 row-cols-md-3 g-4 scrollable-container">
            @foreach ($products as $product)
                <div class="col text-center product" data-category-id="{{ $product->category_id }}">
                    <div class="dish-card" onclick="addDishToOrder(this)">
                        @if ($product->image)
                            <img src="{{ asset('storage/img/' . $product->image) }}" alt="{{ $product->dish_name }}" />
                        @else
                            <img src="{{ asset('storage/img/default.jpg') }}" alt="Default Image" />
                        @endif
                        <div class="dish-details">
                            <p class="dish-name">{{ $product->dish_name }}</p>
                            <p class="dish-price">P{{ $product->price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- 
                <div class="col text-center">
                    <div class="dish-card" onclick="addDishToOrder(this)">
                        <img src="{{ asset('img/fried-chicken (4).png') }}" alt="Chicken Dish 2" />
                        <div class="dish-details">
                            <p class="dish-name">Fried Chicken</p>
                            <p class="dish-price">P399</p>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="dish-card" onclick="addDishToOrder(this)">
                        <img src="{{ asset('img/fried-chicken (3).png') }}" alt="Chicken Dish 3" />
                        <div class="dish-details">
                            <p class="dish-name">C1 Chicken</p>
                            <p class="dish-price">P799</p>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="dish-card" onclick="addDishToOrder(this)">
                        <img src="{{ asset('img/fried-chicken (5).png') }}" alt="Chicken Dish 4" />
                        <div class="dish-details">
                            <p class="dish-name">Crispy Chicken</p>
                            <p class="dish-price">P399</p>
                        </div>
                    </div>
                </div> --}}
        </div>
    </div>

</div>
<div class="order-form-container">
    <div class="order-form-card">
        <form id="order-form" action="{{ route('orders.store') }}" method="POST">
            @csrf
            <input type="hidden" id="type" name="type" value="dine-IN">

            <h2>Order Form</h2>
            <div class="row mb-3">
                <div class="col d-flex gap-4">
                    <div id="dine-in"
                        class="inactive-order-type d-flex align-items-center justify-content-center gap-2"
                        style="border: 1px dotted yellow; width: 50%; border-radius: 22px;"
                        onclick="toggleOrderType('dine-in')">
                        <img src="{{ asset('img/arrow-down.png') }}" alt="Dine In">
                        <div>
                            <p class="fs-4">DINE IN</p>
                            <small style="color: #696868;">This order is dine in</small>
                        </div>
                    </div>
                    <div id="take-out"
                        class="inactive-order-type d-flex align-items-center justify-content-center gap-2"
                        style="border: 1px dotted rgba(63, 63, 61, 0.425); width: 50%; border-radius: 22px; padding: 0.7rem 1rem; cursor: pointer;"
                        onclick="toggleOrderType('take-out')">
                        <img src="{{ asset('img/arrow-down (1).png') }}" alt="Take Out">
                        <div>
                            <p class="fs-4">TAKE OUT</p>
                            <small style="color: #696868;">This order is take out</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div id="order-list" class="col mt-3">
                    <!-- Dynamic dish containers will be added here -->
                </div>
            </div>
            <hr>


            <div class="form-group">
                <label for="total">Total</label>
                <input type="text" name="total" id="total" class="form-control" readonly value="0.00"
                    style="background-color: #1c1b2b; color: white;">
            </div>
            <div class="form-group">
                <label for="payment">Payment</label>
                <input type="text" name="payment" id="payment" class="form-control"
                    style="background-color: #1c1b2b; color: white;">
            </div>
            <div id="warning-message" style="color: red; margin-top: 10px;"></div>
            <div class="form-group">
                <label for="change">Change</label>
                <input type="text" name="change" id="change" class="form-control" readonly value="0.00"
                    style="background-color: #1c1b2b; color: white;">
            </div>
            <div class="form-group">
                <label for="paymentMethod">Payment Method</label>
                <select id="paymentMethod" name="paymentMethod" class="form-control"
                    style="background-color: #1c1b2b; color: white;">
                    <option value="creditCard">Credit Card</option>
                    <option value="cash">Cash</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>
            <button id="place-order-btn" type="submit" class="btn" style="background-color: #50cd8b;" disabled>Place
                Order</button>
        </form>


    </div>

</div>
</div>
<script>
    var username = "{{ $username }}";
    console.log("Username:", username);
</script>
<script>
    document.getElementById('order-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message, 'Order Success, Please enjoy your meal❤️❤️❤️', {
                        timeOut: 3000,
                        onHidden: function() {
                            window.location.href = '{{ route('orders.index') }}';
                        }
                    });
                } else {
                    toastr.error('Please make a payment!', 'Error');
                }
            })
            .catch(error => {
                toastr.error('An error occurred. Please try again.', 'Error');
            });
    });
</script>
