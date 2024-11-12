@extends('admin.layouts.master')

@section('title')
    Add New Account
@endsection

@section('style-libs')
<link href="{{asset('themes/admin/libs/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('script-libs')
<!-- ckeditor -->
<script src="{{asset('themes/admin/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
<!-- dropzone js -->
<script src="{{asset('themes/admin/libs/dropzone/dropzone-min.js')}}"></script>

<script src="{{asset('themes/admin/js/create-product.init.js')}}"></script>

{{-- <script>
    let variantIndex = 1;

    $('#addMoreVariant').click(function() {
        let newVariant = `<tr class="variant">
                            <td>
                                <select class="form-control" name="product_variant[${variantIndex}][size]" >
                                    @foreach ($sizes as $size_id => $size_name)
                                        <option value="{{$size_id}}" {{ old('product_variant.${variantIndex}.size') == $size_id ? 'selected' : '' }}>{{$size_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="product_variant[${variantIndex}][color]" >
                                    @foreach ($colors as $color_id => $color_name)
                                        <option value="{{$color_id}}" {{ old('product_variant.${variantIndex}.color') == $color_id ? 'selected' : '' }}>{{$color_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input class="form-control" type="file" name="product_variant[${variantIndex}][image]">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="product_variant[${variantIndex}][quantity]" value="{{ old('product_variant.${variantIndex}.quantity') }}">
                                @error('product_variant.${variantIndex}.quantity')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </td>
                            <td>
                                <input class="form-control" type="text" name="product_variant[${variantIndex}][price]" value="{{ old('product_variant.${variantIndex}.price') }}">
                                @error('product_variant.${variantIndex}.price')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </td>
                            <td><div class="btn btn-danger removeVariant">X</div></td>
                        </tr>`;
        $('#variantsContainer').append(newVariant);
        variantIndex++;
    });

    $('#variantsContainer').on('click', '.removeVariant', function() {
        $(this).closest('tr').remove();
    });

    $(document).ready(function() {
        $('#variantsContainer .variant:first-child .removeVariant').hide();
    });
</script> --}}

@endsection

@section('content')
   {{-- @if(session('message_create_product'))
        <h4>{{session('message_create_product')}}</h4>
    @endif --}}
<a href="{{route('admin.accounts.index')}}"><button class="btn btn-secondary my-3">Back</button></a>
<form action="{{route('admin.accounts.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <!-- Left content -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <a href="#collapseAccountInfo" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Account main information</h6>
                </a>
                <div class="collapse show" id="collapseAccountInfo">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="account-title-input" class="form-label">Product Title</label>
                            <input type="text" class="form-control" name="name" id="account-title-input" placeholder="Enter account title" value="{{ old('name') }}">
                            {{-- @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror --}}
                        </div>
                        <div class="d-flex justify-content-between gap-3">
                            <div class="mb-3 w-100">
                                <label for="account-title-input" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" id="" placeholder="Enter price" value="{{ old('price') }}">
                                {{-- @error('price')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror --}}
                            </div>
                            <div class="mb-3 w-100">
                                <label for="account-title-input" class="form-label">Price Sale</label>
                                <input type="text" class="form-control" id="" name="price_sale" placeholder="Enter price sale" value="{{ old('price_sale') }}">
                                {{-- @error('price_sale')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Account Description</label>
                            <div id="ckeditor-classic" name="description">
                                <ul>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Product Material</label>
                            <textarea name="material" id="" cols="30" rows="5" class="form-control">{{ old('material') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Use Manual</label>
                            <textarea name="use_manual" id="" cols="30" rows="5" class="form-control">{{ old('use_manual') }}</textarea>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <a href="#collapseAccountGallery" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Account Image</h6>
                </a>
                <div class="collapse show" id="collapseAccountGallery">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="fs-14 mb-1">Account Image</h5>
                            <p class="text-muted">Add Account main Image.</p>
                            <input type="file" class="form-control" name="img_thumb">
                        </div>
                        <div>
                            <h5 class="fs-14 mb-1">Account Gallery</h5>
                            <p class="text-muted">Add Account Gallery Images.</p>
                            <input type="file" class="form-control" name="product_galleries[]" multiple>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card shadow mb-4">
                <a href="#collapseAccountVariants" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Product Variants</h6>
                </a>
                <div class="collapse show" id="collapseAccountVariants">
                    <div class="card-body">
                        <div class="mb-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Image</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="variantsContainer">
                                    @foreach(old('product_variant', [['size' => '', 'color' => '', 'image' => '', 'quantity' => '', 'price' => '']]) as $index => $variant)
                                        <tr class="variant">
                                            <td>
                                                <select class="form-control" name="product_variant[{{$index}}][size]">
                                                    @foreach ($sizes as $size_id => $size_name)
                                                        <option value="{{$size_id}}" {{ $variant['size'] == $size_id ? 'selected' : '' }}>{{$size_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="product_variant[{{$index}}][color]">
                                                    @foreach ($colors as $color_id => $color_name)
                                                        <option value="{{$color_id}}" {{ $variant['color'] == $color_id ? 'selected' : '' }}>{{$color_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control" type="file" name="product_variant[{{$index}}][image]">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="product_variant[{{$index}}][quantity]" value="{{ $variant['quantity'] }}">
                                                @error("product_variant.${index}.quantity")
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="product_variant[{{$index}}][price]" value="{{ $variant['price'] }}">
                                                @error("product_variant.${index}.price")
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </td>
                                            <td><div class="btn btn-danger removeVariant">X</div></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="btn btn-info" id="addMoreVariant">Add more variant</div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="d-flex justify-content-end mb-3">
                <button type="submit" class="btn btn-success w-sm">Submit</button>
            </div>
        </div>
        <!-- Right content -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <a href="#collapseStatus" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Product status</h6>
                </a>
                <div class="collapse show" id="collapseStatus">
                    <div class="card-body">
                        <label for="choices-category-input" class="form-label">Product Category</label>
                        <select class="form-control" aria-label="Default select example"
                                id="choices-category-input" name="category_id">
                            {{-- @foreach($categories as $id => $name)
                                <option value="{{$id}}" {{ old('category_id') == $id ? 'selected' : '' }}>{{$name}}</option>
                            @endforeach --}}
                        </select>
                        <label for="choices-publish-status-input" class="form-label">Status</label>
                        <select class="form-control form-select-lg mb-3" id="choices-publish-status-input" aria-label="Default select example" name="is_active">
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Còn hàng</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Hết hàng</option>
                        </select>
                        @php
                            $types = [
                                'is_best_sale' => 'Bán chạy',
                                'is_40_sale' => 'Giảm 40%',
                                'is_hot_online' => 'Hot online'
                            ];
                        @endphp
                        <label for="choices-publish-type-input" class="form-label">Product Type</label>
                        <div class="d-flex justify-content-between align-items-center">
                            @foreach ($types as $key => $value)
                                <div class="form-group custom-control custom-checkbox small d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="customCheck-{{$key}}" value="{{$key}}" name="{{$key}}" {{ old($key) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customCheck-{{$key}}">{{$value}}</label>
                                </div>
                            @endforeach
                        </div>
                        <label for="choices-publish-type-input" class="form-label">SKU Product</label>
                        <input type="text" class="form-control" value="{{ old('sku', strtoupper(\Str::random(8))) }}" name="sku" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
