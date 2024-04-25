@extends('admin.layout.app')
@section('main')

  <section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-2">
                <h5><span class="fw-light">Selamat Datang</span>,
                    <b>{{ Auth::guard('admin')->user()->name }}</b>
                </h5>
            </div>
            <div class="col-md-3">
                <div class="card card-lg mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="d-flex align-items-center align-self-start">
                                    <h2 class="mb-0">
                                      <i class="fa fa-users text-primary"></i>
                                      {{ $jumlah_kasir }}</h2>
                                    <p class="text-black ml-2 mb-0 font-weight-medium">Jumlah Kasir</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-lg mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h2 class="mb-0">
                                      <i class="fa fa-layer-group text-primary"></i>
                                      {{ $jumlah_kategori }}</h2>
                                    <p class="text-black ml-2 mb-0 font-weight-medium">Jumlah Kategori</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  @endsection

