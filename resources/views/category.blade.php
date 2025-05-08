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
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                    class="list-group-item list-group-item-action  bg-transparent text-white mb-2 d-flex align-items-center rounded   ">
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
                    class="list-group-item list-group-item-action  mb-2 text-white d-flex align-items-center rounded   "
                    style="background-color: #e1b924">
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
                    <h3>Category</h3>
                </div>
            </nav>

            <div class="container-fluid mt-5 px-5">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h5 class="card-title"></h5>
                            <button style="background-color: #f4700d; color: #ffead3" class="btn btn"
                                data-bs-toggle="modal" data-bs-target="#categoryModal">New
                                Category</button>
                        </div>
                        <table id="">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            @if ($category->image)
                                                <img src="{{ asset('storage/img/' . $category->image) }}"
                                                    alt="{{ $category->name }}" width="50">
                                            @endif

                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->status }}</td>

                                        <td>
                                            <a class="btn btn-sm" style="background-color: #5112d2; color: #ffead3;"
                                                data-bs-toggle="modal" data-bs-target="#editCategory"
                                                data-category-id="{{ $category->id }}"
                                                data-category-name="{{ $category->name }}"
                                                data-category-status="{{ $category->status }}"
                                                data-category-image="{{ asset('storage/img/' . $category->image) }}">Edit</a>

                                            <form id="deleteForm{{ $category->id }}"
                                                action="{{ route('categories.destroy', $category->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm delete-btn"
                                                    style="background-color: #ee436e; color: #ffead3"
                                                    type="button">Delete</button>
                                            </form>

                                            <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel{{ $category->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $category->id }}">Confirmation
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this category?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="button"
                                                                class="btn btn-danger delete-confirm">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <script>
                                                $(document).ready(function() {
                                                    $(".delete-btn").click(function() {
                                                        var categoryId = $(this).closest('form').attr('id').replace('deleteForm', '');
                                                        $("#deleteModal" + categoryId).modal('show');
                                                    });

                                                    $(".delete-confirm").click(function() {
                                                        var categoryId = $(this).closest('.modal').attr('id').replace('deleteModal', '');
                                                        $("#deleteForm" + categoryId).submit();
                                                    });
                                                });
                                            </script>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>

        </div>


    </div>
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" action="{{ route('categories.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryImage" class="form-label">Image</label>
                            <div class="image-preview" id="imagePreview">
                                <img src="" alt="Image Preview" class="image-preview__image"
                                    style="display: none;">
                                <span class="image-preview__default-text">Image Preview</span>
                            </div>
                            <input type="file" class="form-control" id="categoryImage" name="image"
                                accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
                            <div class=" text-warning form-text">Allowed file types: png, jpg, jpeg.</div>
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryStatus" class="form-label">Status</label>
                            <select class="form-select" id="categoryStatus" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="addCategoryForm" class="btn btn-primary">Add Category</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="categoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="categoryImage" class="form-label">Image</label>
                            <div class="image-preview" id="imagePreview">
                                <img src="" alt="Image Preview" class="image-preview__image"
                                    id="imagePreviewImg" style="display: none;">
                                <span class="image-preview__default-text" id="imagePreviewText"
                                    style="display: block;">Image Preview</span>
                            </div>
                            <input type="file" class="form-control" id="categoryImage" name="image"
                                accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
                            <div class="text-warning form-text">Allowed file types: png, jpg, jpeg.</div>
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryStatus" class="form-label">Status</label>
                            <select class="form-select" id="categoryStatus" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="editCategoryForm" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


</body>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="../js/bootstrap.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editCategoryModal = document.getElementById('editCategory');
        editCategoryModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var categoryId = button.getAttribute('data-category-id');
            var categoryName = button.getAttribute('data-category-name');
            var categoryStatus = button.getAttribute('data-category-status');
            var categoryImage = button.getAttribute('data-category-image');

            var modalTitle = editCategoryModal.querySelector('.modal-title');
            var categoryNameInput = editCategoryModal.querySelector('#categoryName');
            var categoryStatusInput = editCategoryModal.querySelector('#categoryStatus');
            var imagePreview = editCategoryModal.querySelector('#imagePreviewImg');
            var imagePreviewText = editCategoryModal.querySelector('#imagePreviewText');
            var editCategoryForm = editCategoryModal.querySelector('#editCategoryForm');

            modalTitle.textContent = 'Edit Category';
            categoryNameInput.value = categoryName;
            categoryStatusInput.value = categoryStatus;

            if (categoryImage) {
                imagePreview.src = categoryImage;
                imagePreview.style.display = 'block';
                imagePreviewText.style.display = 'none';
            } else {
                imagePreview.style.display = 'none';
                imagePreviewText.style.display = 'block';
            }

            editCategoryForm.action = `/categories/${categoryId}`;
        });
    });

    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        const previewImage = preview.querySelector('.image-preview__image');
        const previewDefaultText = preview.querySelector('.image-preview__default-text');

        const reader = new FileReader();
        reader.onload = function() {
            const result = reader.result;
            previewImage.src = result;
            previewImage.style.display = 'block';
            previewDefaultText.style.display = 'none';
        }

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        } else {
            previewImage.style.display = 'none';
            previewDefaultText.style.display = 'block';
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#addCategoryForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    toastr.success('Category added successfully!');
                    setTimeout(function() {
                        $('#categoryModal').modal(
                            'hide'); // Close the modal after 1 second
                        window.location.href =
                            "{{ route('categories.index') }}"; // Redirect to the index route
                    }, 1000);
                },
                error: function(error) {
                    toastr.error('Error adding category!');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#editCategoryForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    toastr.success('Category edited successfully!');
                    setTimeout(function() {
                        $('#editCategory').modal(
                            'hide'); // Close the modal after 1 second
                        window.location.href =
                            "{{ route('categories.index') }}"; // Redirect to the index route
                    }, 1000);
                },
                error: function(error) {
                    toastr.error('Error editing category!');
                }
            });
        });
    });
</script>

</body>

</html>
