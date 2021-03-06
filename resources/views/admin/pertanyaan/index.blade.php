@extends('layouts.app')

@section('style')
    <style>
        @media screen {
            div.printFooter {
                display: none;
            }
            div.printHeader {
                display: none;
            }
        }

        @media print {
            body * {
            visibility: hidden;
            }
            #section-to-print, #section-to-print * {
            visibility: visible;
            }
            #section-to-print {
            position: static;
            left: 0;
            top: 50;
            }
            #section-to-print, #section-to-print #aksi {
            visibility: hidden;
            }
            div.printFooter {
                position: fixed;
                bottom: 0;
            }
            div.printHeader {
                position: fixed;
                top: 0;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        @include('inc.admin.sidebar')
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
        
                <!-- Top Bar Start -->
                @include('inc.admin.navbar')
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
                                        <div class="row mb-4">
                                            <div class="col-xl-7 mb-3">
                                                <h4 class="mt-0 header-title">Daftar Informasi</h4>
                                                <p class="text-muted">Berikut adalah daftar data Informasi</p>
                                            </div>
                                            <div class="col-xl-5 text-left">
                                                <a class="d-inline-block mr-1" href="{{route('admin.pertanyaan.create')}}">
                                                    <button type="button" class="btn btn-info btn-lg pr-4 pl-4 mt-2 waves-effect waves-light"><i class="fas fa-plus noti-icon mr-3"></i>Tambah <b></b> Informasi</button>
                                                </a>
                                                <div class="d-inline-block">
                                                    <button onclick="window.print()" type="button" class="btn btn-success btn-lg pr-4 pl-4 mt-2 waves-effect waves-light"><i class="fas fa-print mr-3"></i>Cetak</button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div id="section-to-print" style="overflow-x: auto;">
                                            <div class="printHeader">
                                                <div>
                                                    <div style="min-height: 5vh"></div>
                                                    <img src=" {{asset('assets/images/logo_dark.png')}}" height="30" alt="logo">
                                                </div>
                                                <div>
                                                    <div style="min-height: 3vh"></div>
                                                    <h1>Laporan Informasi</h1>
                                                    <p> URL : {{Request::fullUrl()}}</p>
                                                </div>
                                                <hr class="container">
                                                <div>
                                                    <br>
                                                    <p>Tanggal : {{ date('Y-m-d H:i:s') }}</p>
                                                        @switch(Request::segment(3))
                                                            @case('name_search')
                                                            <p>Nama Search :</p>
                                                                @break
                                                            @case('email_search')
                                                            <p>Email Search :</p>
                                                                @break
                                                            @case('perusahaan_search')
                                                            <p>Perusahaan Search :</p>
                                                                @break
                                                            @case('telp_search')
                                                            <p>Telp Search :</p>
                                                                @break
                                                            @default
                                                            <p>Search :</p>
                                                        @endswitch
                                                </div>
                                            </div>
                                            <table id="mainTable" class="table table-striped table-bordered mb-0 mt-2">
                                                <thead>
                                                <tr>
                                                    <th>Pertanyaan</th>
                                                    <th>Tanggal Di buat</th>
                                                    <th id="aksi">Aksi</th>
                                                </tr>
                                                </thead>
                                                <tbody>
    
                                                @foreach ($informations as $information)
                                                <tr>
                                                    <td>{{$information->question}}</td>
                                                    <td>{{$information->created_at}}</td>
                                                    <td id="aksi" class="text-left">
                                                        <a id="aksi" href="{{route('admin.pertanyaan.show', $information->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Preview ">
                                                            <i id="aksi" class="fas fa-eye mr-2"></i> Preview
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="printFooter">{{ date('Y-m-d H:i:s') }}</div>
                                        </div>
                                        
                                        {{-- <div class="row justify-content-center">
                                            <nav class="mt-5" aria-label="...">
                                                <ul class="pagination">
                                                    {{$pertanyaans->links("pagination::bootstrap-4")}}
                                                </ul>
                                            </nav>
                                        </div> --}}
                                            
                                            
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
