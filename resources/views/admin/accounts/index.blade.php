@extends('admin.layouts.master')

@section('title')
    Account List
@endsection

@section('style-libs')
    <!-- Custom styles for this page -->
    <link href="{{asset('themes/admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('script-libs')
    <!-- Page level plugins -->
    <script src="{{asset('themes/admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('themes/admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('themes/admin/js/demo/datatables-demo.js')}}"></script>

@endsection

@section('content')
    {{-- @if(session('message'))
        <h4>{{session('message')}}</h4>
    @endif
    @if(session('error'))
        <h4>{{session('error')}}</h4>
    @endif --}}

    <a class="d-flex justify-content-end my-3 text-decoration-none" href="{{route('admin.accounts.create')}}"><button class="btn btn-success">+ Add new</button></a>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Game category</th>
                                            <th>User name</th>
                                            <th>Password</th>
                                            <th>Price</th>
                                            <th>SKU</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>
                                                {{-- {{$item->image}} --}}
                                                @if (!empty($item->image))
                                                <div class="" style="width: 100px; height: 100px">
                                                    <img src="{{asset('storage/' . $item->image) }}" alt="anhsp" style="max-width: 100px; max-height: 100px" class="rounded-2">
                                                </div>
                                                @else
                                                    <p class="text-danger">No Photo!</p>
                                                @endif
                                            </td>
                                            <td>{{$item->game->name}}</td>
                                            <td>{{$item->username}}</td>
                                            <td>{{$item->password}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->sku}}</td>
                                            <td>
                                                {!! $item->status ? '<span class="badge bg-success text-white">Còn hàng</span>' : '<span class="badge bg-danger text-white">Hết hàng</span>' !!}
                                            </td>
                                            <td>
                                                <a href="{{route('admin.accounts.show', $item)}}"><button class="btn btn-info mb-2">View</button></a> <br>
                                                <a href="{{route('admin.accounts.edit', $item)}}"><button class="btn btn-warning mb-2">Edit</button></a> <br>
                                                <form action="{{route('admin.accounts.destroy', $item)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection
