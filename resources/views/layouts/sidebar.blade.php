<div id="sidebar-wrapper" class="relative">

    <div class="d-flex align-items-center justify-content-center mt-5 flex-column">
        <img style="width: 170px" src="{{ asset('img/logo.png') }}" alt="" />
    </div>
    <div class="list-group list-group-flush my-3">
        <a href="{{ route('dashboard') }}"
            class="list-group-item list-group-item-action text-white mb-2 d-flex align-items-center rounded   "
            style="background-color: #e1b924">
            <i class="ri-store-2-fill" style="font-size: 1.5em; margin-right: 10px;"></i> <span
                style="padding-right: 20px">Dashboard</span>
        </a>
        <a href="{{ route('orders.index') }}"
            class="list-group-item list-group-item-action bg-transparent mb-2 text-white d-flex align-items-center rounded   ">
            <i class="ri-calendar-line" style="font-size: 1.5em; margin-right: 10px;"></i> <span
                style="padding-right: 20px">Orders</span>

        </a>
        <a href="{{ route('products.index') }}"
            class="list-group-item list-group-item-action bg-transparent mb-2 text-white d-flex align-items-center rounded   ">
            <i class="ri-calendar-line" style="font-size: 1.5em; margin-right: 10px;"></i> <span
                style="padding-right: 20px">Products</span>


        </a>
        <a href="{{ route('categories.index') }}"
            class="list-group-item list-group-item-action bg-transparent mb-2 text-white d-flex align-items-center rounded   ">
            <i class="fas fa-tags" style="font-size: 1.5em; margin-right: 10px;"></i> <span
                style="padding-right: 20px">Category</span>


        </a>

    </div>
    <div class="">
        <a href="{{ route('logout') }}"
            class="list-group-item list-group-item-action bg-transparent text-danger fw-bold mb-5">
            <i class="fas fa-power-off me-2"></i>Logout
        </a>
    </div>

    <div class="username"> Cashier Name: {{ $username }}</div>

</div>

<style>
    #sidebar-wrapper {
        /* Your existing styles */
    }

    .username {

        width: 90%;
        border-radius: 10px;
        background: #50cd8b;
        padding: 5px 10px;
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        color: #fff;
        font-size: .9em;
        /* Adjust font size as needed */
    }
</style>
