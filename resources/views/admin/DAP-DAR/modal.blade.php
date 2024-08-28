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
<div class="modal fade" id="add_Dap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Add kategori</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="kategori" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputkategori3" class="col-sm-2 col-form-label">kategori</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputkategori3" placeholder="kategori"
                                    name="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <label for="inputfoto3" class="col-sm-2 col-form-label">foto</label>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input"
                                        id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputdeskripsi3" class="col-sm-2 col-form-label">deskripsi</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="inputdeskripsi3" placeholder="deskripsi" name="deskripsi"></textarea>
                            </div>
                        </div>
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

