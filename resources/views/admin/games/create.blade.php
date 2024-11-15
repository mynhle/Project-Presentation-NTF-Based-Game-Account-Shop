@extends('admin.layouts.master')

@section('title')
    Create Game
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
@endsection

@section('content')
    <a href="{{route('admin.games.index')}}"><button class="btn btn-secondary my-3">Back</button></a>
    <!--   Main product information             -->
    <form action="{{route('admin.games.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!--   left content-->
                <div class="col-xl-5 col-lg-6">
                    <div class="card shadow mb-4">
                        <!-- Main product information -->
                        <a href="#collapseProductInfo" class="d-block card-header py-3" data-toggle="collapse"
                           role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Game main information</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseProductInfo">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="game-title-input" class="form-label">Gamne Title</label>
                                    <input type="text" class="form-control" name="name" id="game-title-input" placeholder="Enter game title" value="{{ old('name') }}">
                                    {{-- @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror --}}
                                </div>
                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Status</label>
                                    <select class="form-control form-select-lg mb-3" id="choices-publish-status-input" aria-label="Default select example" name="is_active">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
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
                        <a href="#collapseProductGallery" class="d-block card-header py-3" data-toggle="collapse"
                           role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">Game Image</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseProductGallery">
                            <div class="card-body">
                                <div class="mb-4">
                                    <h5 class="fs-14 mb-1">Game Image</h5>
                                    <p class="text-muted">Add Game Image.</p>

                                    <input type="file" class="form-control" name="image">
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
