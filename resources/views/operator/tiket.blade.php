@extends('layouts.app')

@section('content')
    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        @include('inc.operator.sidebar')
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
        
                <!-- Top Bar Start -->
                @include('inc.operator.navbar')
                <!-- Top Bar End -->
        
                <div class="page-content-wrapper ">

                    <div class="container-fluid">
                        
                        <!-- end page title -->
                        <div style="min-height: 5vh;"></div>
                        <div class="row">
                            <div class="col-12">
                                
                                <div class="card m-b-30 p-4">
                                    <div class="col-xl-12">
                                        @include('inc.messages')
                                    </div>
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Daftar Pertanyaan divisi {{$division->division}} </h4>
                                        <p class="text-muted m-b-30">Berikut adalah daftar pertanyaan untuk divisi marketing</p>
                                        <div class="row mb-4">
                                            <div class="mr-auto mt-4 col-xl-5">
                                                <div class="dropdown m-1 d-inline-block">
                                                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownDivisi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Nama
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownDivisi">
                                                    <a class="dropdown-item" href="{{route('operator.tiket.index')}}">Semua</a>
                                                        @foreach ($namas as $nama)
                                                            @switch($nama->role_id)
                                                                @case(1)
                                                                    <a class="dropdown-item" href="{{route('operator.tiket.name_filter', $nama->user_name)}}">{{$nama->user_name}} (admin) </a>
                                                                    @break
                                                                    @case(2)
                                                                    <a class="dropdown-item" href="{{route('operator.tiket.name_filter', $nama->user_name)}}">{{$nama->user_name}} (operator) </a>
                                                                    @break
                                                                @default
                                                                <a class="dropdown-item" href="{{route('operator.tiket.name_filter', $nama->client_name)}}">{{$nama->client_name}}</a>
                                                            @endswitch
                                                        
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="dropdown m-1 d-inline-block">
                                                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Status
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownStatus">
                                                    <a class="dropdown-item" href="{{route('operator.tiket.index')}}">Semua</a>
                                                    <a class="dropdown-item" href="{{route('operator.tiket.status_filter', $status = 'Open')}}">Buka</a>
                                                    <a class="dropdown-item" href="{{route('operator.tiket.status_filter', $status = 'Close')}}">Tutup</a>
                                                    <a class="dropdown-item" href="{{route('operator.tiket.status_filter', $status = 'Operator reply')}}">Balasan Operator</a>
                                                    <a class="dropdown-item" href="{{route('operator.tiket.status_filter', $status = 'Client reply')}}">Balasan Client</a>
                                                    </div>
                                                </div>
                                                <form class="mt-1" id="form_search" action="{{route('operator.tiket.judul_search')}}" method="GET">
                                                    {{ csrf_field() }}
                                                    <div class="col-xl-4 d-inline">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                @if ( !empty($_GET['search']))
                                                                    <input placeholder="Cari judul"  name="search" value="{{ $_GET['search'] }}" type="text" class="form-control mt-1 p-3">
                                                                @else
                                                                    <input placeholder="Cari judul"  name="search" value="" type="text" class="form-control mt-1 p-3">
                                                                @endif
                                                                <button type="submit" class="input-group-append bg-custom b-0" style="border:none; padding:0;">
                                                                    <span class="input-group-text"><small> Search	&nbsp;</small> <i class="mdi mdi-magnify noti-icon"></i></span>
                                                                </button>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <form action="{{route('operator.tiket.update_filter')}}" class="ml-3 mt-3 col-xl-6">
                                                @csrf
                                                <label for="">Filter update terakhir</label>
                                                <hr>
                                                @if (empty($_GET['dari']) && empty($_GET['sampai']))
                                                    <div class="form-group d-inline-block ">
                                                        <label for="dari">Dari:</label>
                                                        <br>
                                                        <input type="date" id="dari" name="dari">
                                                    </div>
                                                    <div class="form-group d-inline-block mr-2">
                                                        <label for="sampai">Sampai:</label>
                                                        <br>
                                                        <input type="date" id="sampai" name="sampai">
                                                    </div>
                                                @else
                                                    <div class="form-group d-inline-block ">
                                                        <label for="dari">Dari:</label>
                                                        <br>
                                                        <input value="{{$_GET['dari']}}" type="date" id="dari" name="dari">
                                                    </div>
                                                    <div class="form-group d-inline-block mr-2">
                                                        <label for="sampai">Sampai:</label>
                                                        <br>
                                                        <input value="{{$_GET['sampai']}}" type="date" id="sampai" name="sampai">
                                                    </div>
                                                @endif
                                                
                                                <button type="submit" style="border:none; padding:0;">
                                                    <span class="input-group-text"><small>Filter &nbsp;</small> <i class="mdi mdi-magnify noti-icon"></i></span>
                                                </button>
                                            </form>
                                            
                                        </div>
                                        
                                        <div style="overflow-x:auto;">
                                            <table id="mainTable" class="table table-striped mb-0 mt-2">
                                                <thead>
                                                <tr>
                                                    <th>Nama Client</th>
                                                    <th>Judul</th>
                                                    <th>Status</th>
                                                    {{-- <th>Telah di balas</th> --}}
                                                    <th>Update terakhir</th>
                                                    <th colspan="2" class="text-center">Aksi</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($messages as $message)
                                                        <tr>
                                                            @if (empty($message->client_name))
                                                                @switch($message->role_id)
                                                                    @case(1)
                                                                        <td>{{$message->user_name}} (admin)</td>
                                                                        @break
                                                                    @case(2)
                                                                        <td>{{$message->user_name}} (operator)</td>
                                                                        @break
                                                                    @default
                                                                        
                                                                @endswitch
                                                            @else
                                                                <td> {{$message->client_name}} {{$message->user_name}} </td>
                                                            @endif
                                                            <td>{{$message->title}}</td>
                                                            @switch($message->status)
                                                                @case('Open')
                                                                    <td><i style="font-size: 1.5em;" class="mdi mdi-record text-success"></i> Buka</td>
                                                                    @break
                                                                @case('Close')
                                                                    <td><i style="font-size: 1.5em;" class="mdi mdi-record text-danger"></i> Tutup</td>
                                                                    @break
                                                                @case('Operator reply')
                                                                    <td><i style="font-size: 1.5em;" class="mdi mdi-record text-primary"></i> Balasan Operator</td>
                                                                    @break
                                                                @case('Client reply')
                                                                    <td><i style="font-size: 1.5em;" class="mdi mdi-record text-info"></i> Balasan Client</td>
                                                                    @break
                                                                @default
                                                                    <td><i style="font-size: 1.5em;" class="mdi mdi-record text-success"></i> Buka</td>
                                                                    @break
                                                            @endswitch
                                                            {{-- <td><i class="mdi mdi-record text-danger"></i> Belum </td> --}}
                                                            @if (empty($message->newest_reply))
                                                                <td>{{$message->created_at}}</td>
                                                            @else
                                                                <td>{{$message->newest_reply}}</td>
                                                            @endif
                                                            <td class="text-right">
                                                                <a href="{{route('operator.tiket.show', $message->id)}}" class="mb-1 col-xs-6 btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Balas Tiket "><i class="mdi mdi-file text-white"></i></a>
                                                            </td>
                                                            <td class="text-left">
                                                                @switch($message->role_id)
                                                                @case(1)
                                                                    <a href="#" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Profile Admin"><i class="mb-1 col-xs-6 mdi mdi-lock text-white"></i></a>
                                                                    @break
                                                                @case(2)
                                                                    <a href="{{route('operator.show', $message->user_id)}}" class="mb-1 col-xs-6 btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Profile Operator"><i class="mdi mdi-account-box text-white"></i></a>
                                                                    @break
                                                                @default
                                                                <a href="{{route('operator.client.show', $message->client_id)}}" class="mb-1 col-xs-6 btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Profile Client"><i class="mdi mdi-account-box text-white"></i></a>
                                                            @endswitch
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="row justify-content-center">
                                            <nav class="mt-5" aria-label="...">
                                                <ul class="pagination">
                                                    {{$messages->links("pagination::bootstrap-4")}}
                                                </ul>
                                            </nav>
                                        </div>
                                        
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
