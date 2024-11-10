@extends('admin.layouts.master')

@section('title')
    Edit Game - {{$game->name}}
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

<!-- Main product information -->
<form action="{{route('admin.games.update', $game->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <!-- Left content -->
        <div class="col-xl-5 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Main product information -->
                <a href="#collapseProductInfo" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Game main information</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseProductInfo">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="game-title-input" class="form-label">Game Title</label>
                            <input type="text" class="form-control" name="name" id="game-title-input" placeholder="Enter game title" value="{{$game->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Status</label>
                            <select class="form-control form-select-lg mb-3" id="choices-publish-status-input" aria-label="Default select example" name="is_active">
                                <option value="1" @selected($game->is_active == 1)>Active</option>
                                <option value="0" @selected($game->is_active == 0)>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-7 col-lg-6">
            <!-- Gallery -->
            <div class="card shadow mb-4">
                <a href="#collapseProductGallery" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Game Image</h6>
                </a>
                <div class="collapse show" id="collapseProductGallery">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="fs-14 mb-1">Game Image</h5>
                            <p class="text-muted">Add Game Image.</p>
                            @if (!empty($game->image))
                                <img src="{{ Storage::url($game->image) }}" alt="Game Image" width="200" class="rounded-3 mb-3">
                            @else
                                <p class="text-danger">No Photo!</p>
                            @endif
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end mb-3">
                <button type="submit" class="btn btn-success w-sm">Submit</button>
            </div>
        </div>
    </div>
</form>

@endsection
