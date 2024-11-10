@extends('admin.layouts.master')

@section('title')
    Game List
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
    @if(session('message'))
        <h4>{{session('message')}}</h4>
    @endif

    <a class="d-flex justify-content-end my-3 text-decoration-none" href="{{route('admin.games.create')}}"><button class="btn btn-success">+ Add new</button></a>

    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Number of accounts</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Number of accounts</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                @if(!empty($item->image))
                                                    <div class="" style="width: 100px; height: 100px;">
                                                        <img src="{{Storage::url($item->image)}}" alt="" style="max-width: 100px; max-height: 100px;" class="rounded-2">
                                                    </div>
                                                @else
                                                        <p class="text-danger">No Photo!</p>
                                                @endif
                                            </td>
                                            <td>{{$item->accounts_count}}</td>
                                            <td>

                                                {!! $item->is_active ? '<span class="badge bg-success text-white p-2 fs-6">Active</span>' : '<span class="badge bg-danger text-white p-2 fs-6">Inactive</span>' !!}

                                            </td>


                                            <td class="d-flex">
                                                {{-- <a href="{{route('admin.games.show', $item)}}"><button class="btn btn-primary mr-2">View</button></a> --}}
                                                <a href="{{route('admin.games.edit', $item)}}"><button class="btn btn-warning mr-2">Edit</button></a>
                                                <form action="{{route('admin.games.destroy', $item)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger mr-2" type="submit" onclick="return confirm('Bạn có chắc là muốn xóa không?')">Delete</button>
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
