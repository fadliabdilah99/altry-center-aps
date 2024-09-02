@foreach ($daps as $item)
    {{-- edit kategori --}}
    <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Edit kategori</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ url("editkategori/$item->id") }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputnama3" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $item->nama }}" class="form-control"
                                        id="inputnama3" placeholder="nama" name="nama">
                                </div>
                            </div>
                            <input type="text" hidden name="foto" value="{{$item->foto}}">
                            <div class="form-group row">
                                <label for="inputnama3" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" id="inputdeskripsi3" placeholder="deskripsi" name="deskripsi">{{$item->deskripsi}}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Edit</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach




{{-- add katagri --}}
<div class="modal fade" id="{{$no}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Input DAP/DAR</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ url('inputdapdar') }}" method="POST" enctype="multipart/form-data">
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
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
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
                        <button type="submit" class="btn btn-info">Tambah</button>
                        <button type="submit" class="btn btn-default float-right">Cancel</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>

{{-- add user --}}
<div class="modal fade" id="tepatwaktu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Karyawan tepat Waktu {{ date('Y-m-d') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Waktu pengiriman</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alldaptepat as $tepat)
                                    <td>{{ $tepat->id }}</td>
                                    <td>{{ $tepat->user->name }}</td>
                                    <td>{{ $tepat->created_at->format('H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Waktu pengiriman</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alldartepat as $tepats)
                                    <td>{{ $tepats->id }}</td>
                                    <td>{{ $tepats->user->name }}</td>
                                    <td>{{ $tepats->created_at->format('H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="terlambat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Karyawan tepat Waktu {{ date('Y-m-d') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Waktu pengiriman</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alldapterlambat as $terlambats)
                                    <td>{{ $terlambats->id }}</td>
                                    <td>{{ $terlambats->user->name }}</td>
                                    <td>{{ $terlambats->created_at->format('H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Waktu pengiriman</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alldarterlambat as $terlambats)
                                    <td>{{ $terlambats->id }}</td>
                                    <td>{{ $tepats->user->name }}</td>
                                    <td>{{ $tepats->created_at->format('H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>