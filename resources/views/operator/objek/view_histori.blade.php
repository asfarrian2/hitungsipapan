@extends('layouts.operatormaster')

@section('content')

<div class="">
    @csrf
    @php
    $messagewarning = Session::get('warning');
    $messagesuccess = Session::get('success');
@endphp
@if (Session::get('warning'))
<a class=" btn btn-danger btn-xs close-link" href="#"><i class="fa fa-check text-times" > {{ $messagewarning }}</i></a>
@endif

@if (Session::get('success'))
<a class=" btn btn-success btn-xs close-link" href="#"><i class="fa fa-check text-succsess" > {{ $messagesuccess }}</i></a>
@endif

<br>

          <div class="page-title">
            <div class="title_left">
              <h3>Verifikasi Pajak Air Permukaan</h3>
             </div>
             </div>
             <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th width="10px" class="text-center">No.</th>
                          <th width="10px" class="text-center">ID</th>
                          <th width="10px" class="text-center">Tanggal</th>
                          <th width="10px" class="text-center">Wajib Pajak</th>
                          <th class="text-center">Objek Pajak</th>
                          <th class="text-center">Volume Pemakaian</th>
                          <th class="text-center">Jumlah Pajak Air Permukaan</th>
                          <th class="text-center">Foto Water Meter</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($hitung as $d)
                      @php
                      $foto_volume = Storage::url('uploads/hitung/' . $d->foto);
                      @endphp
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $d->id_hitung }}</td>
                          <td>{{ $d->tanggal }}</td>
                          <td>{{ $d->nama }}</td>
                          <td>{{ $d->nama_objek }}</td>
                          <td>{{ $d->volume_pemakaian }} M3</td>
                          <td>Rp <?php echo number_format($d->jumlah_pap,0,',','.')?></td>
                          <td><img src="{{ url($foto_volume) }}" width="200px" alt=""></td>
                          <td>@if ($d->status == 2)
                            <a class="btn-success text-white">Disetujui</a>
                             @elseif($d->status == 1)
                            <a class="btn-primary text-white">Diajukan</a>
                            @elseif($d->status == 3)
                            <a class="btn-danger text-white">Tidak Disetujui</a>
                            @else
                            <p><a class="btn-warning">Tidak Ada</a><p>
                            @endif</td>
                          @csrf
                          <td>
                            <a href="/operator/cetak/{{$d->id_hitung}}" target="_blank" title="Lihat Hasil Perhitungan"><i class="fa fa-info-circle tn btn-success btn btn-sm"></i></a>
                            @if ($d->status == '1')
                            <a class="verifikasi" href="#" data-id="{{ $d->id_hitung }}" title="Verifikasi Data"><i class="verifikasi fa fa-edit text-succsess btn btn-primary btn btn-sm" ></i></a>
                             @else
                             <a class="cancel" href="#" data-id="{{ $d->id_hitung }}" title="Batalkan Verifikasi"><i class="cancel fa fa-times text-succsess btn btn-danger btn btn-sm" ></i></a>
                             @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     </div>
   </div>
</div>

<!-- Modal Tambah Objek Pajak -->
<div class="modal modal-blur fade" id="modal-inputobjek" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">Verifikasi Pajak Air Permukaan</h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/operator/verifikasi" method="POST" enctype="multipart/form-data" data-parsley-validate id="frmCabang">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <input type="hidden" name="id_hitung" value="" id="id_hitung_ambil" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span>Verifikasi</span>
                                <select name="verifikasi" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option value="2">Terima</option>
                                    <option value="3">Tidak Diterima</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-success w-100" type="submit">
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@push('myscript')
<script>
$('.cancel').click(function(){
    var id_hitung = $(this).attr('data-id');
Swal.fire({
  title: "Apakah Anda Yakin Ingin Membatalkan Verifikasi Ini ?",
  text: "Jika Dibatalkan Pengguna Dapat Mengelola Data Kembali",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Ya, Batalkan Verifikasi"
}).then((result) => {
  if (result.isConfirmed) {
    window.location = "/operator/cancel/"+id_hitung
    Swal.fire({
      title: "Data Verifikasi Berhasil Dibatalkan !",
      icon: "success"
    });
  }
});
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

 $(".verifikasi").click(function() {
    var ambil_id = $(this).attr("data-id");
    $("#id_hitung_ambil").val(ambil_id);
    $("#modal-inputobjek").modal("show");
});


var span = document.getElementsByClassName("close")[0];
</script>
@endpush
