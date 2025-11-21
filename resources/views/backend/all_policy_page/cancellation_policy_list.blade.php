@extends('backend.layouts.app')
@section('style')
    <style type="text/css">

    </style>
@endsection
@section('content')
    <!-- Container-fluid starts-->
    <div class="page-body">
        <div class="title-header title-header-1">
            <h5>Cancellation Policy</h5>
            <form class="d-inline-flex">
                <a href="{{ url('admin/cancellation_policy/add') }}" class="align-items-center btn btn-theme">
                    <i data-feather="plus-square"></i>Add New
                </a>
            </form>
        </div>
        <!-- All User Table Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        @include('_message')

                        <div class="card-body">
                            <div class="policy-page">
                                <div class="table-responsive table-desi">
                                    <table class="user-table table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title </th>
                                                <th>Description</th>
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($getRecord as $value)
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td>{{ $value->title }}</td>
                                                    <td style="word-break: break-all;">{{ $value->description }}</td>

                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/cancellation_policy/edit/' . $value->id) }}">
                                                            <span class="lnr lnr-pencil"></span>
                                                        </a>

                                                        <a href="{{ url('admin/cancellation_policy/delete/' . $value->id) }}">
                                                            <span class="lnr lnr-trash"></span>
                                                        </a>

                                                    </td>
                                                </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="100%">Record not found.</td>
                                                </tr>
                                            @endforelse



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="pagination-box">
                            <nav class="ms-auto me-auto " aria-label="...">
                                <ul class="pagination pagination-primary">

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- All User Table Ends-->

    </div>
    <!-- Container-fluid end -->


@endsection

@section('script')

    <script type="text/javascript">


    </script>

@endsection