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
<div class="">

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h1 id="glyphicons" class="page-header">HOME</h1>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="bs-docs-section">
              <h2 id="glyphicons-glyphs">MENU</h2>
              <div class="bs-glyphicons">
                <ul class="bs-glyphicons-list">

                  <li>
                    <button id="pilih_objek" class="btn text-secondary objek" href="#">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    <h4 class="glyphicon-class">HITUNG PAJAK AIR PERMUKAAN</h4>
                    </button>
                  </li>

                  <li>
                    <a class="btn text-secondary" href="#">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                    <h4 class="glyphicon-class">HASIL PERHITUNGAN</h4>
                    </a>
                  </li>
                </ul>
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
                <h5 class="modal-title">Pilih Objek PAP</h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/wp/create/{$objek_pajak->id_objek}" method="POST" id="frmCabang">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            @csrf
                                <input type="hidden" id="" value="" class="form-control" placeholder="Kode Lokasi" name="id_wajibpajak">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <select name="id_objek" id="unit" class="form-control" required="required">
                            <option value="">Pilih Objek</option>
                            @foreach ($objek_pajak as $d)
                            <option value="{{ $d->id_objek }}">{{ $d->nama_objek }}</option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-success w-100">
                                    Pilih
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
$('.hapus').click(function(){
    var id_unit = $(this).attr('data-id');
Swal.fire({
  title: "Apakah Anda Yakin Data Ini Ingin Di Hapus ?",
  text: "Jika Ya Maka Data Akan Terhapus Permanen",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Ya, Hapus Saja!"
}).then((result) => {
  if (result.isConfirmed) {
    window.location = "/uppd/"+id_unit+"/hapus"
    Swal.fire({
      title: "Data Berhasil Dihapus !",
      icon: "success"
    });
  }
});
});
</script>

<script>

 $(".objek").click(function() {
    $("#modal-inputobjek").modal("show");
});


var span = document.getElementsByClassName("close")[0];
</script>
@endpush
