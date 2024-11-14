@extends('admin.layouts.master')

@section('title')
    Show Account
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
                                placeholder="Enter account user name" value="{{ $account->username }}" readonly>
                            {{-- @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror --}}
                        </div>
                        <div class="mb-3">
                            <label for="account-title-input" class="form-label">Password</label>
                            <input type="text" class="form-control" name="password" id="account-title-input"
                                placeholder="Enter account password" value="{{ $account->password }}" readonly>
                            {{-- @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror --}}
                        </div>
                        <div class="d-flex justify-content-between gap-3">
                            <div class="mb-3 w-100">
                                <label for="account-title-input" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" id=""
                                    placeholder="Enter price" value="{{ $account->price }}" readonly>
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
                <a href="#collapseAccountAttribute" class="d-block card-header py-3" data-toggle="collapse" role="button"
                    aria-expanded="true" aria-controls="collapseCardExample">
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
                                        <input type="text" class="form-control" name="attribute_name[]" readonly
                                            value="{{ $attribute->attribute_name }}">
                                        <label for="attribute_value" class="form-label">Attribute Value</label>
                                        <input type="text" class="form-control" name="attribute_value[]" readonly
                                            value="{{ $attribute->attribute_value }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
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
                                style="width: 100px; height: 100px">
                        </div>
                        <div>
                            <div class="container mt-3">
                                <h3>Add Account Gallery Images</h3>
                                <div id="images-container">
                                    @foreach ($accountGallery as $gallery)
                                        <div class="image-group mb-3">
                                            <label for="image" class="form-label">Gallery Image</label>
                                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt=""
                                                style="width: 100px; height: 100px"><br>
                                            <label for="caption" class="form-label">Caption</label>
                                            <input type="text" class="form-control" name="caption[]" readonly
                                                value="{{ $gallery->caption }}">
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <input type="text" class="form-control" value="{{ $game->name }}"
                            name="game_id" readonly>
                        <label for="choices-publish-status-input" class="form-label">Status</label>
                        <input type="text" value="{{ $account->status }}" class="form-control" readonly >
                        <label for="choices-publish-type-input" class="form-label">SKU Product</label>
                        <input type="text" class="form-control" value="{{ $account->sku }}"
                            name="sku" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
