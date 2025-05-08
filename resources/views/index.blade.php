<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <title>CHM</title>





</head>

<body>
    <div class="" id="wrapper">
        <!-- Button to trigger the modal -->

        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="">
            <div class="d-flex align-items-center justify-content-center mt-5 flex-column">
                <img style="width: 170px" src="{{ asset('img/logo.png') }}" alt="" />
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="{{ route('dashboard') }}"
                    class="list-group-item list-group-item-action bg-transparent text-white mb-2 d-flex align-items-center rounded   ">
                    <i class="ri-store-2-fill" style="font-size: 1.5em; margin-right: 10px;"></i> <span
                        style="padding-right: 20px">Dashboard</span>
                </a>
                <a href="{{ route('orders.index') }}"
                    class="list-group-item list-group-item-action  mb-2 text-white d-flex align-items-center rounded   "
                    style="background-color: #e1b924">
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
        </div>

        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg" style="background-color: #0f0f17; color: white; padding: 5rem 0 ">
                <div class="container-fluid px-5">
                    <h3>Orders</h3>
                </div>
            </nav>

            <div class="container-fluid mt-5 px-5">
                <div class="card">
                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Order Method</th>
                                    <th>Payment Method</th>
                                    <th>Cash</th>
                                    <th>Change</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <span
                                                style="background-color: #0e302a; color: #58b793; padding: 2px 9px; border-radius: 12px">
                                                {{ $order->order_id }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('M j, Y | h:i:s A') }}</td>
                                        </td>
                                        <td>{{ $order->type }}</td>
                                        <td>{{ $order->paymentMethod }}</td>
                                        <td>P{{ $order->payment }}</td>
                                        <td>P{{ $order->change }}</td>
                                        <td> <span
                                                style="background-color: #0e302a; color: #58b793; padding: 2px 9px; border-radius: 12px">
                                                P{{ $order->total }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm view-btn" data-bs-toggle="modal"
                                                data-bs-target="#receiptModal" data-order-id="{{ $order->order_id }}">
                                                <img src="{{ asset('img/search-file.png') }}" alt="View"
                                                    class="btn-icon"> View
                                            </a>
                                            <button class="btn btn-sm print-btn"
                                                onclick="generatePDF('{{ $order->order_id }}', 112)">
                                                <img src="{{ asset('img/printer (3).png') }}" alt="Print"
                                                    class="btn-icon"> Print
                                            </button>


                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Additional rows can be added here if needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="receiptModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="order-details"></div>
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#receiptModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var orderId = button.data('order-id');

                if (!orderId) {
                    console.error('Order ID is undefined');
                    return;
                }

                $.ajax({
                    url: '/orders/' + orderId,
                    method: 'GET',
                    success: function(data) {
                        if (data.error) {
                            console.error(data.error);
                            return;
                        }

                        var orderDetails = '';
                        var subtotal = 0;
                        var orderDate = '';

                        data.forEach(function(order) {
                            var price = parseFloat(order.price);
                            var itemTotal = order.quantity * price;
                            subtotal += itemTotal;
                            orderDate = new Date(order.created_at);

                            orderDetails += `
                        <div class="mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span style="background-color: #232b42; color: #cdb447; font-size: 1.5em; padding: 0 7px; border-radius: 5px">${order.dish_name}</span>
                                <span class="total">P${itemTotal.toFixed(2)}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>${order.quantity} x P${price.toFixed(2)}</span>
                            </div>  
                        </div>
                        <hr>
                    `;
                        });
                        var paymentMethod = data[0]
                            .paymentMethod; // Fetch payment method from the data

                        $('#receiptModalLabel').html(`
                    ${data[0].order_id} <span>
                        <p style="font-size: 12px; margin: 0 12px; background-color: #232b42; padding: 2px 5px; color: #cdb447; border-radius: 7px">
                            ${orderDate.toLocaleString('en-US', { month: 'short', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true })}
                        </p>
                    </span>
                `);

                        $('#order-details').html(`
                    ${orderDetails}
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span class="total">P${subtotal.toFixed(2)}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Payment Method</span>
                        <span>${paymentMethod}</span> <!-- Display payment method -->
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between total-section">
                        <span>TOTAL</span>
                        <span class="total">P${parseFloat(data[0].total).toFixed(2)}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Cash</span>
                        <span>P${parseFloat(data[0].payment).toFixed(2)}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Change</span>
                        <span>P${parseFloat(data[0].change).toFixed(2)}</span>
                    </div>
                `);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching order details:', textStatus, errorThrown);
                    }
                });
            });
        });
    </script>
</body>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script>
    function generatePDF(orderId, paperWidth) {
        $.ajax({
            url: '/orders/' + orderId,
            method: 'GET',
            success: function(data) {
                if (data.error) {
                    console.error(data.error);
                    return;
                }

                // Calculate dynamic height
                const baseHeight = 80; // Base height for header, logo, and footer
                const itemHeight = 10; // Height for each order item
                const additionalHeight =
                    200; // Height for subtotal, total, payment, change, and thank you message
                const totalItems = data.length;
                const calculatedHeight = baseHeight + (totalItems * itemHeight) + additionalHeight;
                const totalHeight = Math.max(calculatedHeight,
                    200); // Use 200mm as default height if calculated height is less

                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: [paperWidth, totalHeight], // Dynamically set the height
                });

                // Add store logo
                const logoImg = new Image();
                logoImg.src = '{{ asset('img/image (3).png') }}'; // Adjust the path to your store logo
                logoImg.onload = function() {
                    const pageWidth = doc.internal.pageSize.getWidth();
                    const centerX = pageWidth / 2;

                    const logoWidth = 50;
                    const logoHeight = 50;
                    doc.addImage(logoImg, 'PNG', centerX - logoWidth / 2, 5, logoWidth, logoHeight);

                    let y = 60; // Initial Y position after the logo

                    // Add store information
                    doc.setFontSize(10);
                    doc.text("Store Location: Nabua", centerX, y, {
                        align: 'center'
                    });
                    y += 15;

                    // Add receipt header
                    doc.setFontSize(12);
                    doc.text("***OFFICIAL RECIEPT***", centerX, y, {
                        align: 'center'
                    });
                    y += 10;
                    doc.setFontSize(10);
                    doc.text(`Order ID: ${data[0].order_id}`, centerX, y, {
                        align: 'center'
                    });
                    y += 5;
                    doc.text(`Date: ${new Date(data[0].created_at).toLocaleString('en-US')}`, centerX,
                        y, {
                            align: 'center'
                        });
                    y += 5;
                    doc.text("===================================", centerX, y, {
                        align: 'center'
                    });
                    y += 10;

                    // Add order details
                    let subtotal = 0;
                    data.forEach(function(order) {
                        const itemTotal = order.quantity * parseFloat(order.price);
                        subtotal += itemTotal;

                        doc.text(`${order.dish_name}`, 10, y);
                        doc.text(`P${itemTotal.toFixed(2)}`, paperWidth - 10, y, {
                            align: 'right'
                        });
                        y += 5;
                        doc.text(`${order.quantity} x P${parseFloat(order.price).toFixed(2)}`,
                            10, y);
                        y += 10;
                    });

                    // Add subtotal, total, payment, and change
                    // Add subtotal, total, payment, and change
                    y += 5;
                    doc.text("===================================", centerX, y, {
                        align: 'center'
                    });
                    y += 10;
                    doc.text(`Subtotal:`, 10, y);
                    doc.text(`P${parseFloat(data[0].total).toFixed(2)}`, paperWidth - 10, y, {
                        align: 'right'
                    });
                    y += 5;
                    doc.text(`Total:`, 10, y);
                    doc.text(`P${parseFloat(data[0].total).toFixed(2)}`, paperWidth - 10, y, {
                        align: 'right'
                    });
                    y += 5;
                    doc.text(`Cash:`, 10, y);
                    doc.text(`P${parseFloat(data[0].payment).toFixed(2)}`, paperWidth - 10, y, {
                        align: 'right'
                    });
                    y += 5;
                    doc.text(`Change:`, 10, y);
                    doc.text(`P${parseFloat(data[0].change).toFixed(2)}`, paperWidth - 10, y, {
                        align: 'right'
                    });

                    // Add a thank you message
                    y += 15;
                    doc.text("===================================", centerX, y, {
                        align: 'center'
                    });
                    y += 10;
                    doc.text("Thank you for your purchase!", centerX, y, {
                        align: 'center'
                    });
                    y += 5;
                    doc.text("Come again!", centerX, y + 5, {
                        align: 'center'
                    });
                    y += 10;
                    doc.text("Visit our Facebook page!", centerX, y, {
                        align: 'center'
                    });
                    y += 10;
                    doc.text("CHM DINING HOUSE!", centerX, y, {
                        align: 'center'
                    });


                    // Save the PDF
                    doc.save(`Receipt_Order_${data[0].order_id}.pdf`);
                };
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching order details:', textStatus, errorThrown);
            }
        });
    }
</script>




</body>

</html>
