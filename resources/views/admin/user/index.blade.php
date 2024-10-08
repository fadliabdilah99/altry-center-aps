@extends('admin.template.main')

@section('title', 'Data Users')

@push('style')
  
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
                                <a href="profile-home/{{ $karyawan->id }}" class="btn btn-primary">Profile</a>
                                <form action="{{ url("deleteuser/$karyawan->id") }}" method="POST" style="display: inline">
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
