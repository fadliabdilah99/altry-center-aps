@foreach ($karyawans as $item)
    {{-- edit user --}}
    <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Users</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{ url("edituser/$item->id") }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-control select2bs4 select2-hidden-accessible" name="role"
                                    id="">
                                    <option selected value="{{ $item->role }}">{{ $item->role }}</option>
                                    <option value="admin">Admin</option>
                                    <option value="akuntan">akuntan</option>
                                    <option value="manager">manager</option>
                                    <option value="cs">cs</option>
                                    <option value="karyawan">karyawan</option>
                                    <option value="sales">sales</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Edit</button>
                            <button type="submit" class="btn btn-default float-right">Cancel</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>

@endforeach
