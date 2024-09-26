@extends('karyawan.template.main')

@section('title', 'karyawan')

@push('style')
@endpush

@push('bodystyle')
    class="hold-transition layout-top-nav"
@endpush

@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Halaman karyawan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                                <li class="breadcrumb-item active">Top Navigation</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <h5 class="d-flex justify-content-center card-title p-2 fw-bold">{{ $no }}</h5>
                                <div class="card-body">
                                    <form class="form-horizontal" action="{{ url('inputdapdar') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="number" hidden name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="date" hidden name="tanggal" value="{{ date('Y-m-d') }}">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="input-group">
                                                    <label for="inputfoto3" class="col-sm-2 col-form-label">PDF</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="file" class="custom-file-input"
                                                            id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($no == 'add_Dap')
                                                <input type="text" hidden name="jenis" value="DAP">
                                            @else
                                                <input type="text" hidden name="jenis" value="DAR">
                                            @endif
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-info">Kirim</button>
                                        </div>
                                        <!-- /.card-footer -->
                                    </form>
                                </div>
                            </div>

                            <div class="card card-primary card-outline">
                                <h5 class="d-flex justify-content-center mt-2 fw-bold card-title">Input Absen aktifitas
                                </h5>
                                <div class="card-body">
                                    <form class="form-horizontal" action="{{ url('absensi') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="number" hidden name="user_id" value="{{ Auth::user()->id }}">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="input-group">
                                                    <label for="inputfoto3" class="col-sm-2 col-form-label">Foto</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="foto" class="custom-file-input"
                                                            id="exampleInputfoto">
                                                        <label class="custom-file-label" for="exampleInputfoto">Choose
                                                            foto</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputkat" class="col-sm-2 col-form-label">Ket</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control select2bs4 select2-hidden-accessible"
                                                        name="kategori" id="inputkat">
                                                        <option value="Hadir">Hadir</option>
                                                        <option value="Tugas">Tugas</option>
                                                        <option value="Sakit">Sakit</option>
                                                        <option value="Izin">Izin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <textarea name="keterangan" id="" cols="30" rows="10" placeholder="Deskripsi(opsional)"></textarea>
                                            </div>
                                        </div>

                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-info">Kirim</button>
                                        </div>
                                        <!-- /.card-footer -->
                                    </form>
                                </div>
                            </div><!-- /.card -->
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Dap Dar</h5>
                                </div>
                                <div class="card-body">


                                    <table id="example1" class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>file</th>
                                                <th>Waktu pengiriman</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($daps as $dap)
                                                <tr @if ($dap->status == 'terlambat') class="text-danger" @endif>
                                                    <td>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-toggle="modal" data-target="#pdf{{ $dap->id }}"><i
                                                                class="bi bi-eye"></i></button>
                                                    </td>
                                                    <td>{{ $dap->created_at->format('H:i:s') }}</td>
                                                    <td>
                                                        @if (Auth::user()->role != 'admin')
                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#edit{{ $dap->id }}">Edit</button>
                                                        @endif
                                                        <form action="{{ url("deletedap/$dap->id") }}" method="POST"
                                                            style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn bg-danger delete-data" type="button">
                                                                <i class="fas fa-trash-alt"></i> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Timeline Absensi</h5>
                                </div>
                                <div class="container-fluid">

                                    <!-- Timelime example  -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- The time line -->
                                            <div class="timeline">
                                                <!-- timeline time label -->
                                                <div class="time-label">
                                                    <span class="bg-red">{{ date('d-M-Y') }}</span>
                                                </div>
                                                <!-- /.timeline-label -->
                                                <!-- timeline item -->
                                                @foreach ($absens as $absen)
                                                    <div>
                                                        <i class="fas fa-envelope bg-blue"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock"></i>
                                                                {{ $absen->created_at->format('H:i') }}</span>
                                                            <h3 class="timeline-header">{{ $absen->kategori }}</h3>
                                                            <div class="timeline-body">
                                                                <img src="assets/absen/{{ $absen->foto }}"
                                                                    class="img-fluid" width="300" alt="">
                                                                <p><b>{{ $absen->keterangan }}</b></p>
                                                            </div>
                                                            <div class="timeline-footer">
                                                                <form action="{{ url('absensi/' . $absen->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn bg-danger delete-data" type="submit">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <!-- END timeline item -->
                                                <div>
                                                    <i class="fas fa-clock bg-gray"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @include('karyawan.page.modal')

@endSection
@push('script')
@endpush
