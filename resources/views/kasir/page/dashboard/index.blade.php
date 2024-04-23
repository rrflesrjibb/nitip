@extends('kasir.layout.app')

  <section>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 60vh;">
            <div class="col-md-2">
                <h4><span class="fw-light mt-4">Selamat Datang</span>,
                    <b>{{ Auth::guard('kasir')->user()->name }}</b>
                </h4>
            </div>
            <div class="col-md-3">
                <div class="card card-lg mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h2 class="mb-0">
                                      <i class="fa fa-users text-primary"></i>
                                      {{ $jumlah_member }}</h2>
                                    <p class="text-black ml-2 mb-0 font-weight-medium">Jumlah Member</p>
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
                                      <i class="fa fa-coins text-primary"></i>
                                      {{ $jumlah_transaksi }}</h2>
                                    <p class="text-black ml-2 mb-0 font-weight-medium">Jumlah Transaksi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

