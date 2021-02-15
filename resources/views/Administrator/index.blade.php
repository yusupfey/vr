@extends('layouts.dashboard')
@section('title',' Dashboard')
@section('content')
    @if (Session::get('id_akses')===1 or Session::get('id_akses')===3 or Session::get('id_akses')===4)
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
              
              <p>Barang on order</p>
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
    @endif
    
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <!-- TO DO List -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="ion ion-clipboard mr-1"></i>
              Profil
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="mt-2">
              <label>NIK</label>
              <p>{{$users[0]->nik}}</p>
              <hr>
            </div>
            <div class="mt-2">
              <label>Nama Lengkap</label>
              <p>{{$users[0]->nama}}</p>
              <hr>
            </div>
            <div class="mt-2">
              <label>Tempat, Tanggal Lahir</label>
              <p>{{$users[0]->temp_lahir}}, {{$users[0]->tgl_lahir}}</p>
              <hr>
            </div>
            <div class="mt-2">
              <label>Alamat</label>
              <p>{{$users[0]->Alamat}}</p>
              <hr>
            </div>
            <div class="mt-2">
              <label>Position</label>
              <p>{{$users[0]->akses}}</p>
              <hr>
            </div>
            
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
                <i class="fa fa-user mr-1"></i>
                Avatar
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body d-flex justify-content-center">
              <img src="{{asset('img/'.$users[0]->pic)}}" height="200px" alt="">    
            </div>
          </div>
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
@endsection