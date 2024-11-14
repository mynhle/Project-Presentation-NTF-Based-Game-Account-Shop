@extends('admin.layouts.master')

@section('title')
    Edit order
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
    <a href="{{ route('admin.orders.index') }}"><button class="btn btn-secondary my-3">Back</button></a>
    <!--   Main product information             -->
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!--   left content-->
            <div class="col-xl-5 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Main product information -->
                    <a href="#collapseProductInfo" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Order infomation</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseProductInfo">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="game-title-input" class="form-label">User</label>
                                <select class="form-select" name="user_id" id="">
                                    <option value="">Chọn</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            @if ($user->id == $order->user_id) selected @endif>
                                            {{ $user->username }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="game-title-input" class="form-label">Account</label>
                                <select class="form-select" name="account_id" id="">
                                    <option value="">Chọn</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}"
                                            @if ($account->id == $order->account_id) selected @endif>
                                            {{ $account->username }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="game-title-input" class="form-label">Status</label>
                                <select class="form-select" name="status" id="">
                                    <option value="">Chọn</option>
                                    <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                                    <option value="completed" @if($order->status == 'completed') selected @endif>Completed</option>
                                    <option value="canceled" @if($order->status == 'canceled') selected @endif>Canceled</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

            <div class="col-xl-7 col-lg-6">
                <!--    gallery -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseProductGallery" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Total price</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseProductGallery">
                        <div class="card-body">
                            <div class="mb-4">
                                <h5 class="fs-14 mb-1">Total price</h5>
                                <input type="number" value="{{$order->total_price}}" class="form-control" name="total_price">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button -->
                <div class="d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
        </div>

    </form>
@endsection
