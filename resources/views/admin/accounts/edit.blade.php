@extends('admin.layouts.master')

@section('title')
    Edit Account
@endsection

@section('style-libs')
    <link href="{{ asset('themes/admin/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script-libs')
    <!-- ckeditor -->
    <script src="{{ asset('themes/admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <!-- dropzone js -->
    <script src="{{ asset('themes/admin/libs/dropzone/dropzone-min.js') }}"></script>

    <script src="{{ asset('themes/admin/js/create-product.init.js') }}"></script>
@endsection

@section('content')
    @if (session('error'))
        <div class="alert alert-success" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if (session('message_create_product'))
        <div class="alert alert-success" role="alert">
            {{ session('message_create_product') }}
        </div>
    @endif
    <a href="{{ route('admin.accounts.index') }}"><button class="btn btn-secondary my-3">Back</button></a>
    <form action="{{ route('admin.accounts.update', $account) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Left content -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <a href="#collapseAccountInfo" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Account main information</h6>
                    </a>
                    <div class="collapse show" id="collapseAccountInfo">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="account-title-input" class="form-label">User name</label>
                                <input type="text" class="form-control" name="username" id="account-title-input"
                                    placeholder="Enter account user name" value="{{ $account->username }}">
                                {{-- @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                            </div>
                            <div class="mb-3">
                                <label for="account-title-input" class="form-label">Password</label>
                                <input type="text" class="form-control" name="password" id="account-title-input"
                                    placeholder="Enter account password" value="{{ $account->password }}">
                                {{-- @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                            </div>
                            <div class="d-flex justify-content-between gap-3">
                                <div class="mb-3 w-100">
                                    <label for="account-title-input" class="form-label">Price</label>
                                    <input type="text" class="form-control" name="price" id=""
                                        placeholder="Enter price" value="{{ $account->price }}">
                                    {{-- @error('price')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror --}}
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                            <label class="form-label">Account attribute</label>
                            <textarea id="ckeditor-classic" name="description">

                            </textarea>
                        </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <a href="#collapseAccountAttribute" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Account Attribute</h6>
                    </a>
                    <div class="collapse show" id="collapseAccountAttribute">
                        <div class="card-body">
                            <div class="container mt-3">
                                <h3>Add Account Attributes</h3>
                                <div id="attributes-container">
                                    @foreach ($accountAttribute as $attribute)
                                        <div class="attribute-group mb-3">
                                            <label for="attribute_name" class="form-label">Attribute Name</label>
                                            <input type="text" class="form-control" name="attribute_name[]" required
                                                value="{{ $attribute->attribute_name }}">
                                            <label for="attribute_value" class="form-label">Attribute Value</label>
                                            <input type="text" class="form-control" name="attribute_value[]" required
                                                value="{{ $attribute->attribute_value }}">
                                            <button type="button"
                                                class="btn btn-danger remove-attribute mt-2">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-primary" id="add-attribute">Add Attribute</button>
                            </div>

                            <script>
                                document.getElementById('add-attribute').addEventListener('click', function() {
                                    const container = document.getElementById('attributes-container');

                                    const newAttribute = `
                                    <div class="attribute-group mb-3">
                                        <label for="attribute_name" class="form-label">Attribute Name</label>
                                        <input type="text" class="form-control" name="attribute_name[]" required>
                                        <label for="attribute_value" class="form-label">Attribute Value</label>
                                        <input type="text" class="form-control" name="attribute_value[]" required>
                                        <button type="button" class="btn btn-danger remove-attribute mt-2">Remove</button>
                                    </div>
                                `;

                                    container.insertAdjacentHTML('beforeend', newAttribute);
                                });

                                // Event delegation for removing attributes
                                document.getElementById('attributes-container').addEventListener('click', function(e) {
                                    if (e.target.classList.contains('remove-attribute')) {
                                        e.target.parentElement.remove();
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <a href="#collapseAccountGallery" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Account Image</h6>
                    </a>
                    <div class="collapse show" id="collapseAccountGallery">
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="fs-14 mb-1">Account Image</h5>
                                <p class="text-muted">Add Account main Image.</p>
                                <img src="{{ asset('storage/' . $account->image) }}" alt=""
                                    style="width: 100px; height: 100px" class="mb-2">
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div>
                                <div class="container mt-3">
                                    <h3>Add Account Gallery Images</h3>
                                    <div id="images-container">
                                        @foreach ($accountGallery as $gallery)
                                            <div class="image-group mb-3">
                                                <label for="image" class="form-label">Gallery Image</label>
                                                <img src="{{ asset('storage/' . $gallery->image_path) }}" alt=""
                                                    style="width: 100px; height: 100px" class="mb-2">
                                                <input type="file" class="form-control" name="images[]"
                                                    accept="image/*">
                                                <label for="caption" class="form-label">Caption</label>
                                                <input type="text" class="form-control" name="caption[]" required
                                                    value="{{ $gallery->caption }}">
                                                <button type="button"
                                                    class="btn btn-danger remove-image mt-2" data-gallery-id="{{ $gallery->id }}">Remove</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary" id="add-image">Add Image</button>
                                </div>

                                <script>
                                    document.getElementById('add-image').addEventListener('click', function() {
                                        const container = document.getElementById('images-container');

                                        const newImageInput = `
                                        <div class="image-group mb-3">
                                            <label for="image" class="form-label">Gallery Image</label>
                                            <input type="file" class="form-control" name="images[]" accept="image/*"
                                                required>
                                            <label for="caption" class="form-label">Caption</label>
                                            <input type="text" class="form-control" name="caption[]" required>
                                            <button type="button"
                                                class="btn btn-danger remove-image mt-2" data-gallery-id="{{ $gallery->id }}">Remove</button>
                                        </div>
                                    `;

                                        container.insertAdjacentHTML('beforeend', newImageInput);
                                    });

                                    // Event delegation for removing images
                                    document.getElementById('images-container').addEventListener('click', function(e) {
                                        if (e.target.classList.contains('remove-image')) {
                                            const galleryId = e.target.dataset.galleryId;
                                            e.target.parentElement.remove();
                                            // deleteGalleryImage(galleryId);
                                        }
                                    });

                                    // function deleteGalleryImage(galleryId) {
                                    //     fetch(`/account-gallery/${galleryId}`, {
                                    //             method: 'DELETE',
                                    //             headers: {
                                    //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    //             }
                                    //         })
                                    //         .then(response => {
                                    //             if (response.ok) {
                                    //                 // Xóa phần tử tương ứng trong UI
                                    //                 document.querySelector(`[data-gallery-id="${galleryId}"]`).remove();
                                    //             } else {
                                    //                 // Xử lý lỗi
                                    //                 console.error('Failed to delete gallery image');
                                    //             }
                                    //         })
                                    //         .catch(error => {
                                    //             // Xử lý lỗi
                                    //             console.error('Error deleting gallery image:', error);
                                    //         });
                                    // }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- Right content -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <a href="#collapseStatus" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Account status</h6>
                    </a>
                    <div class="collapse show" id="collapseStatus">
                        <div class="card-body">
                            <label for="choices-category-input" class="form-label">Game Category</label>
                            <select class="form-control" aria-label="Default select example" id="choices-category-input"
                                name="game_id">
                                <option value="">--Select game category--</option>
                                @foreach ($gameCategory as $gameCategoryItem)
                                    <option value="{{ $gameCategoryItem->id }}"
                                        {{ old('game_id') == $gameCategoryItem->id || (isset($game) && $game->id == $gameCategoryItem->id) ? 'selected' : '' }}>
                                        {{ $gameCategoryItem->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="choices-publish-status-input" class="form-label">Status</label>
                            <select class="form-control form-select-lg mb-3" id="choices-publish-status-input"
                                aria-label="Default select example" name="status">
                                <option value="available"
                                    {{ old('status') == $account->status || $account->status == 'available' ? 'selected' : '' }}>
                                    Available
                                </option>
                                <option value="sold"
                                    {{ old('status') == $account->status || $account->status == 'sold' ? 'selected' : '' }}>
                                    Sold</option>
                                <option value="pending"
                                    {{ old('status') == $account->status || $account->status == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                            </select>
                            <label for="choices-publish-type-input" class="form-label">SKU Product</label>
                            <input type="text" class="form-control" value="{{ $account->sku }}" name="sku"
                                readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
