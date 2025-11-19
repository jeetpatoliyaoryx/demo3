@extends('backend.layouts.app')
@section('style')
    <style type="text/css">
    </style>
@endsection
@section('content')


    <!-- Container-fluid starts-->
    <div class="page-body">
        <div class="title-header title-header-1">
            <h5>All Banner</h5>
            <form class="d-inline-flex">
                <a href="{{ url('admin/banner/add') }}" class="align-items-center btn btn-theme">
                    <i data-feather="plus-square"></i>Add New
                </a>
            </form>
        </div>
        <!-- All User Table Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body">
                            @include('_message')
                            <div class="home-banner-page">
                                <div class="table-responsive table-desi">
                                    <table class="user-table table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Desktop Banner</th>
                                                <th>Mobile Banner</th>
                                                <th>Title</th>
                                                <th>Sub Title </th>
                                                <th>Button Text </th>
                                                <th>Type </th>
                                                <th>Catalogue/Category </th>
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse($getRecord as $value)
                                                <tr>
                                                    <td>{{ $value->id }}</td>
                                                    <td style="min-width: 1px;">
                                                        @if(!empty($value->get_desktop_banner()))
                                                            <span>
                                                                <img src="{{ $value->get_desktop_banner() }}" alt="users">
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td style="min-width: 1px;">
                                                        @if(!empty($value->get_mobile_banner()))
                                                            <span>
                                                                <img src="{{ $value->get_mobile_banner() }}" alt="users">
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td>{{ $value->title }}</td>
                                                    <td>{{ $value->sub_title }}</td>
                                                    <td>{{ $value->button_text }}</td>
                                                    <td>
                                                        @if($value->type_catalogue_category == 1)
                                                            Catalogue
                                                        @elseif($value->type_catalogue_category == 2)
                                                            Category
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($value->type_catalogue_category == 1)
                                                            {{ !empty($value->getCatalogue->catalogue_name) ? $value->getCatalogue->catalogue_name : '' }}
                                                        @elseif($value->type_catalogue_category == 2)
                                                            {{ !empty($value->getCategory->name) ? $value->getCategory->name : '' }}
                                                        @endif
                                                    </td>


                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>

                                                    <td>
                                                        <ul>

                                                            <li>
                                                                <a href="{{ url('admin/banner/edit/' . $value->id) }}">
                                                                    <span class="lnr lnr-pencil"></span>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="{{ url('admin/banner/delete/' . $value->id) }}">
                                                                    <span class="lnr lnr-trash"></span>
                                                                </a>
                                                            </li>
                                                        </ul>
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