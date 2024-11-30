@extends('layouts.wpmaster')

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
              <h3>Hasil Perhitungan</h3>
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
                          <th class="text-center">Objek Pajak</th>
                          <th class="text-center">Volume Pemakaian</th>
                          <th class="text-center">Jumlah Pajak Air Permukaan</th>
                          <th class="text-center">Foto Water Meter</th>
                          <th class="text-center">Laporan</th>
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
                          <td>{{ $d->nama_objek }}</td>
                          <td>{{ $d->volume_pemakaian }} M3</td>
                          <td>Rp <?php echo number_format($d->jumlah_pap,0,',','.')?></td>
                          <td><img src="{{ url($foto_volume) }}" width="200px" alt=""></td>
                          <td>@if ($d->pengajuan == null AND $d->status == 1)
                          <a class="upload" href="#" data-id="{{ $d->id_hitung }}" title="Upload Laporan *pdf"><i class="upload fa fa-upload text-succsess btn btn-primary btn btn-sm" ></i>Upload *PDF</a>
                             @elseif ($d->pengajuan =! null AND $d->status == 1)
                            <a href="/wp/download/{{$d->id_hitung}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i>Download</a>
                            <a class="upload2" href="#" data-id="{{ $d->id_hitung }}" title="Upload Laporan *pdf"><i class="upload fa fa-upload text-succsess btn btn-danger btn btn-sm" ></i>Upload Ulang *PDF</a>
                            @elseif ($d->pengajuan =! null AND $d->status =! 1)
                            <a href="/wp/download/{{$d->id_hitung}}" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i>Download</a>
                            @else
                            @endif
                          <td>@if ($d->status == 2)
                            <a class="btn-success text-white">Disetujui</a>
                             @elseif($d->status == 1)
                            <a class="btn-warning">Pending</a>
                            @elseif($d->status == 3)
                            <a class="btn-danger text-white">Tidak Diterima</a>
                            @else
                            <p><a class="btn-danger">Tidak Ada</a><p>
                            @endif</td>
                          @csrf
                          <td>
                            <a href="/wp/cetak/{{$d->id_hitung}}" target="_blank" title="Print Hasil Perhitungan"><i class="fa fa-print tn btn-success btn btn-sm"></i></a>
                            @if ($d->pengajuan =! NULL && $d->status == 1)
                             <a class="batal" href="#" data-id="{{ $d->id_hitung }}" title="Batalkan Pengajuan dan Hapus File Laporan*pdf"><i class="batal fa fa-close text-succsess btn btn-danger btn-sm" ></i></a>
                             @else

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
            <div class="modal-header">
                <h5 class="modal-title">Upload Dokumen Laporan Perhitungan</h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/wp/upload" method="POST" enctype="multipart/form-data" data-parsley-validate id="frmCabang">
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
                                <span>Upload Laporan (*pdf)</span>
                                <input type="file" accept="application/pdf" name="dokumen" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-success w-100" type="submit">
                                    Upload
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

@push('wpscript')
<script>
$('.batal').click(function(){
    var id_hitung = $(this).attr('data-id');
Swal.fire({
  title: "Apakah Anda Yakin Ingin Membatalkan Pengajuan Ini ?",
  text: "Jika Dibatalkan dapat Menghilangkan FIle Dokumen Laporan Pada Perhitungan Ini",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Ya, Batalkan Pengajuan"
}).then((result) => {
  if (result.isConfirmed) {
    window.location = "/wp/batal/"+id_hitung
    Swal.fire({
      title: "Data Pengajuan Berhasil Dibatalkan !",
      icon: "success"
    });
  }
});
});
</script>

<script>

 $(".upload").click(function() {
    var ambil_id = $(this).attr("data-id");
    $("#id_hitung_ambil").val(ambil_id);
    $("#modal-inputobjek").modal("show");
});


var span = document.getElementsByClassName("close")[0];
</script>

<script>

 $(".upload2").click(function() {
    var ambil_id = $(this).attr("data-id");
    $("#id_hitung_ambil").val(ambil_id);
    $("#modal-inputobjek").modal("show");
});


var span = document.getElementsByClassName("close")[0];
</script>
@endpush

