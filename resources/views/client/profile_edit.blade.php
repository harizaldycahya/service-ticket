@extends('layouts.app')

@section('content')
    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        @include('inc.client.sidebar')
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
        
                <!-- Top Bar Start -->
                @include('inc.client.navbar')
                <!-- Top Bar End -->
        
                <div class="page-content-wrapper ">

                    <div class="container-fluid ">
                        <div style="min-height: 5vh;"></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card m-b-30 p-4">
                                    <div class="card-body">
                                        <form action="{{route('client.update')}}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12 pl-4 pr-4">
                                                    <h4 class="mt-0 header-title">Profile</h4>
                                                    <p class="text-muted">Berikut adalah informasi pribadi anda.</p>
                                                </div>
                                                {{-- <div class="col-lg-6">
                                                    <div class="card m-b-30">
                                                        <div class="card-body">
                                                            <h4 class="mt-0 header-title">Logo Perusahaan</h4>
                                                            <div class="">
                                                                <img src="{{asset('assets/images/small/img-2.jpg')}}" class="img-fluid" alt="Responsive image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="col-lg-6">
                                                    <div class="form-group col-lg-12">
                                                        <label>Nama</label>
                                                        <input name="name" value="{{$client->name}}" type="text" class="form-control" required placeholder="Type something"/>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>Perusahaan </label>
                                                        <input name="company" value="{{$client->company}}" type="text" class="form-control"  required placeholder="Type something"/>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label>No. Telp</label>
                                                        <input name="phone" value="{{$client->phone}}" type="text" class="form-control" required placeholder="Type something"/>
                                                    </div>
                                                    <div class="form-group col-lg-12 text-center">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light pl-5 pr-5"> 
                                                            <i class="mdi mdi-pencil"></i>
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->  

                    </div><!-- container fluid -->

                </div> <!-- Page content Wrapper -->
        
            </div> <!-- content -->
        
        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->
@endsection
