@extends('layouts.dashboard')

@section('content')
  
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$brg}}</h3>
  
            <p>Barang</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$req}}<sup style="font-size: 20px"></sup></h3>
  
            <p>Request barang</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$process}}</h3>
            
            <p>Barang on process</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$user}}</h3>
  
            <p>User</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <!-- TO DO List -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="ion ion-clipboard mr-1"></i>
              Alur VR
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <ul>
              <li>List Barang (Staff Gudang)</li>
              <li>Approve Barang (Supervisor)</li>
              <li>From VR (Supervisor)</li>
              <li>Choice Supplier (Supervisor)</li>
              <li>Report (Supervisor)</li>
            </ul>
          </div>
        </div>
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">
            <!-- /.card-header -->
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                Progres VR
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <ul>
                <li>Barang (create, edit, delete)</li>
                <li>Supplier (create, edit, delete)</li>
                <li>List Barang (create, edit, delete)</li>
                <li>Approve (create, edit, delete)</li>
                <li>Status PR</li>
                <li>Ganti Password</li>
                <li>Profil</li>
                <li>Laporan</li>
              </ul>
                
            </div>
          </div>
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
@endsection