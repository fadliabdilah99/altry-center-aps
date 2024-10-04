@extends('karyawan.template.main')

@section('title', 'profile')

@push('style')
@endpush

@push('bodystyle')
    class="hold-transition layout-top-nav"
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <p class="text-muted text-center">{{ $user->role }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>skor ketepatan</b> <a
                                        class='float-right {{ $Cpresentase }}'>{{ $presentase }}%</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Lama Bekerja</b> <a class="float-right">{{ $lamaBekerja }} Hari</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tidak Mengisi Absen</b> <a class="float-right">{{ $bolos }} x</a>
                                </li>
                            </ul>


                            <a href="#" class="btn btn-primary btn-block"><b>kredit skor :
                                    {{ $kredit }}</b></a>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">Malibu, California</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                fermentum enim neque.</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                                @if (Auth::user()->role == 'admin')
                                    <li class="nav-item bg-info m-1 rounded"><a class="nav-link" href="#skors"
                                            data-toggle="tab">Sangsi</a>
                                    </li>
                                    <li class="nav-item bg-info m-1 rounded"><a class="nav-link" href="#promosi"
                                            data-toggle="tab">Promosi</a>
                                    </li>
                                @endif
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="row">
                                        <div class="col-lg-3 col-6">
                                            <!-- small box -->
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    <h3>Rp {{ number_format($gajibulanan, 0, ',', '.') }}</h3>

                                                    <p class="text-danger">Rp
                                                        -{{ number_format($potonganbulanan, 0, ',', '.') }}</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-bag"></i>
                                                </div>
                                                <p class="small-box-footer">Pendapatan</p>
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-lg-3 col-6">
                                            <!-- small box -->
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                                                    <p>Bounce Rate</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-stats-bars"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">INFO LEBIH LANJUT <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-lg-3 col-6">
                                            <!-- small box -->
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h3>{{ $bulanan }}</h3>

                                                    <p>Tidak Mengisi/Telat Absen</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-person-add"></i>
                                                </div>
                                                <div class="small-box-footer">Dalam 1 bulan</div>
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-lg-3 col-6">
                                            <!-- small box -->
                                            <div class="small-box bg-danger">
                                                <div class="inner">
                                                    <h3>{{ $countpelanggaran }}x </h3>

                                                    <p>Pelanggaran Kerja</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="ion ion-pie-graph"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">More info <i
                                                        class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        @foreach ($timeline as $date => $history)
                                            <div class="time-label">
                                                <span class="bg-danger">
                                                    {{ $date }}
                                                </span>
                                            </div>
                                            @foreach ($history as $absen)
                                                <div>
                                                    <i class="fas fa-envelope bg-blue"></i>
                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fas fa-clock"></i>
                                                            {{ $absen->created_at->format('H:i') }}</span>
                                                        <h3 class="timeline-header">{{ $absen->kategori }}</h3>
                                                        <div class="timeline-body">
                                                            <img src="assets/absen/{{ $absen->foto }}" class="img-fluid"
                                                                width="300" alt="">
                                                            <p><b>{{ $absen->keterangan }}</b></p>
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <form action="{{ url('absensi/' . $absen->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn bg-danger delete-data"
                                                                    type="submit">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <!-- END timeline item -->
                                        @endforeach
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    @include('profile.edit')
                                </div>
                                <div class="tab-pane" id="skors">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Berikan Sangsi Pelanggaran Pada User</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form class="form-horizontal" action="{{ url('skor') }}" method="POST">
                                            @csrf
                                            <input type="Number" hidden name="user_id" value="{{ $user->id }}">
                                            <input type="text" hidden name="jenis" value="1">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Penurunan
                                                        Gaji</label>
                                                    <div class="col-sm-10">
                                                        <input type="Number" name="gaji" class="form-control"
                                                            id="inputEmail3" placeholder="Menurunkan Gaji keseluruhan"
                                                            max="{{ $user->gajih }}" value="{{ $user->gajih }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Potongan
                                                        Gaji</label>
                                                    <div class="col-sm-10">
                                                        <input type="Number" name="potongGaji" class="form-control"
                                                            id="inputEmail3" placeholder="Memotong Gaji Bulan ini">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kurangi
                                                        Skor</label>
                                                    <div class="col-sm-10">
                                                        <input type="Number" name="skor" class="form-control"
                                                            id="inputPassword3" placeholder="Poin yang akan di kurangi">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword3"
                                                        class="col-sm-2 col-form-label">Alasan</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="alasan" class="form-control" id="inputPassword3" placeholder="Alasan Mengenai Sangsi"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-info">Berikan sangsi</button>
                                            </div>
                                            <!-- /.card-footer -->
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="promosi">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Berikan Promosi Pada User</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <form class="form-horizontal" action="{{ url('skor') }}" method="POST">
                                            @csrf
                                            <input type="Number" hidden name="user_id" value="{{ $user->id }}">
                                            <input type="text" hidden name="jenis" value="2">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Penambahan
                                                        Gaji</label>
                                                    <div class="col-sm-10">
                                                        <input type="Number" name="gajih" class="form-control"
                                                            id="inputEmail3" placeholder="Menurunkan Gaji keseluruhan"
                                                            min="{{ $user->gajih }}" value="{{ $user->gajih }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Bonus</label>
                                                    <div class="col-sm-10">
                                                        <input type="Number" name="gajih" class="form-control"
                                                            id="inputEmail3" placeholder="Memotong Gaji Bulan ini">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kenaikan
                                                        Jabatan</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control select2bs4 select2-hidden-accessible"
                                                            name="role" id="">
                                                            <option selected value="{{ $user->role }}">
                                                                {{ $user->role }}</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="akuntan">akuntan</option>
                                                            <option value="manager">manager</option>
                                                            <option value="cs">cs</option>
                                                            <option value="karyawan">karyawan</option>
                                                            <option value="sales">sales</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Kurangi
                                                        Skor</label>
                                                    <div class="col-sm-10">
                                                        <input type="Number" name="skor" class="form-control"
                                                            id="inputPassword3" placeholder="Poin yang akan di kurangi">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword3"
                                                        class="col-sm-2 col-form-label">Alasan</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="alasan" class="form-control" id="inputPassword3" placeholder="Alasan Mengenai Sangsi"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-info">Berikan Promosi</button>
                                            </div>
                                            <!-- /.card-footer -->
                                        </form>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
