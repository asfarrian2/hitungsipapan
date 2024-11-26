@extends('layouts.master')

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
              <h3>Faktor Nilai Air Permukaan (FNAP)</h3>
             </div>
             </div>
             <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabel Data Kualitas Air (KA)</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                          <div class="col-sm-12">
                            <button id="tambah" href="#" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>
                                <span> Tambah </span>
                            </button>
                            <div class="clearfix"><br></div>
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th width="10px" class="text-center">No.</th>
                          <th class="text-center">Kualitas Air yang digunakan</th>
                          <th width="100px" class="text-center">Bobot</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($ka as $d)
                        <tr>
                          <td ckass="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $d->kualitas_air }}</td>
                          <td>{{ $d->bobot_ka }}%</td>
                          @csrf
                          <td>
                            <a href="/ka/{{ $d->id_ka }}/edit" title="Edit Data"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                            <a class="hapus" href="#" data-id="{{ $d->id_ka }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
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
                <h5 class="modal-title">Tambah Kualitas Air (KA)</h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/ka/store" method="POST" id="frmCabang">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span>Kualitas Air</span>
                                <input type="text" name="i1" value="" id="nama" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span>Bobot</span>
                                <input type="number" maxlength="3" name="i2" value="" id="nama" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-success w-100" type="submit">
                                    Simpan
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$('.hapus').click(function(){
    var id_ka = $(this).attr('data-id');
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
    window.location = "/ka/"+id_ka+"/hapus"
    Swal.fire({
      title: "Data Berhasil Dihapus !",
      icon: "success"
    });
  }
});
});
</script>

<script>

 $("#tambah").click(function() {
    $("#modal-inputobjek").modal("show");
});


var span = document.getElementsByClassName("close")[0];
</script>
@endpush
