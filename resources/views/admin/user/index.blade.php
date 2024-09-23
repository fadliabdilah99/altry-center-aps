@extends('admin.template.main')

@section('title', 'Data Users')

@push('style')
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="ns/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="ns/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="ns/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Member</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>





    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="container col-6">
                <form action="user" method="post">
                    @csrf
                    <div class="d-flex  align-items-center ">
                        <label for="">Dari</label>
                        <input type="date" value="{{ date('Y-m-d') }}" name="dari" class="mx-2 form-control"
                            max="{{ date('Y-m-d') }}" id="">
                        <label for="">Sampai</label>
                        <input type="date" value="{{ date('Y-m-d') }}" name="dari" class="mx-2 form-control"
                            max="{{ date('Y-m-d') }}" id="">
                        <button class="btn btn-primary">sortir</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <button class="btn btn-success mb-2" type="button" data-toggle="modal" data-target="#adduser">Add User</button>

            <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawans as $karyawan)
                        <tr>
                            <td>{{ $karyawan->id }}</td>
                            <td>{{ $karyawan->name }}</td>
                            <td>{{ $karyawan->email }}</td>
                            <td>{{ $karyawan->role }}</td>
                            <td>
                                <div class="image">
                                    <img src=" {{ $karyawan->foto == null ? 'dist/img/user2-160x160.jpg' : $karyawan->foto }}"
                                        class="img-circle elevation-2" style="width: 70px" alt="User Image">
                                </div>

                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#edit{{ $karyawan->id }}">Edit</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#absen{{ $karyawan->id }}">aktifitas</button>
                                <form action="{{ url("deleteuser/$karyawan->id") }}" method="POST"
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
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    @include('admin.user.modal')
@endsection
{{-- content --}}

@push('script')
    {{-- sweetalert2 --}}
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        // script delete start
        $('.delete-data').click(function(e) {
            e.preventDefault()
            const data = $(this).closest('tr').find('td:eq(1)').text()
            Swal.fire({
                    title: 'Data akan hilang!',
                    text: `Apakah penghapusan data ${data} akan dilanjutkan?`,
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonText: 'Ya',
                    denyButtonText: 'Tidak',
                    focusConfirm: false
                })
                .then((result) => {
                    if (result.isConfirmed) $(e.target).closest('form').submit()
                    else swal.close()
                })
        });
    </script>
@endpush
