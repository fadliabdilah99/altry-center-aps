@foreach ($karyawans as $item)
    {{-- edit Lapolan --}}
    <div class="modal fade" id="aktifitas{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Aktifitas Karyawan</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                                @foreach ($item->absen as $absen)
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
                                                <form action="{{ url('absensi/' . $absen->id) }}" method="POST"
                                                    class="d-inline">
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
    </div>
@endforeach
