@extends('admin.layouts.master')

@section('title')
    Order list
@endsection

@section('style-libs')
    <!-- Custom styles for this page -->
    <link href="{{ asset('themes/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('script-libs')
    <!-- Page level plugins -->
    <script src="{{ asset('themes/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('themes/admin/js/demo/datatables-demo.js') }}"></script>
@endsection

@section('content')
    @if (session('message'))
        <h4>{{ session('message') }}</h4>
    @endif

    <a class="d-flex justify-content-end my-3 text-decoration-none" href="{{ route('admin.orders.create') }}"><button
            class="btn btn-success">+ Add new</button></a>

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
                            <th>User</th>
                            <th>Account</th>
                            <th>Total price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->username }}</td>
                                <td>{{ $order->account->username }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->status }}</td>

                                <td class="d-flex">
                                    <a href="{{ route('admin.orders.edit', $order) }}"><button
                                            class="btn btn-warning mr-2">Edit</button></a>
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger mr-2" type="submit"
                                            onclick="return confirm('Bạn có chắc là muốn xóa không?')">Delete</button>
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
