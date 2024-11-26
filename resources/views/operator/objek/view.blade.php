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
              <h3>Objek Pajak</h3>
             </div>
             </div>
             <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabel Data</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="container">
                         <div class="row">
                            <div class='col-sm-4'>
                                Wajib Pajak :
                                <div class="form-group"> @csrf
                                    <div class='input-group date' id='myDatepicker'>
                                        <input type='readonly' name="id_wajibpajak" value="{{ $perusahaan->nama}}" class="form-control" readonly/>
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-tint"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                          <div class="col-sm-12">
                            <button id="tambah" href="/operator/wp/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i><span> Tambah Objek</span></button>
                            <div class="clearfix"><br></div>
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th width="10px" class="text-center"><b>No.</b></th>
                          <th class="text-center"><b>Nama Objek</b></th>
                          <th class="text-center">HDAP</th>
                          <th class="text-center">FEW</th>
                          <th class="text-center">SA</th>
                          <th class="text-center">LA</th>
                          <th class="text-center">LP</th>
                          <th class="text-center">VA</th>
                          <th class="text-center">KA</th>
                          <th class="text-center">KDS</th>
                          <th class="text-center">KP</th>
                          <th class="text-center">FKPAP</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($objek as $d)
                        <tr>
                          <td class="text-center"><b>{{ $loop->iteration }}</b></td>
                          <td><b>{{ $d->nama_objek }}</b></td>
                          <td>{{ $d->kelompok_hdap }} - Harga Dasar: Rp <?php echo number_format($d->nilai_hdap,0,',','.')?> </td>
                          <td>{{ $d->nilai_pdrb }} - Faktor: {{$d->faktor_few}}% </td>
                          <td>{{ $d->sumber_air }} - Bobot: {{$d->bobot_sa}}% </td>
                          <td>{{ $d->lokasi_la }} - Bobot: {{$d->bobot_la}}% </td>
                          <td>{{ $d->lokasi_lp }} - Bobot: {{$d->bobot_lp}}% </td>
                          <td>{{ $d->volume }} - Bobot: {{$d->bobot_va}}% </td>
                          <td>{{ $d->kualitas_air }} - Bobot: {{$d->bobot_ka}}% </td>
                          <td>{{ $d->klasifikasi }} - Bobot: {{$d->bobot_kds}}% </td>
                          <td>{{ $d->klasifikasi_kp }} - Bobot: {{$d->bobot_kp}}% </td>
                          <td>{{$d->pengguna_fkpap}} = {{$d->fkpa}}</td>
                          @csrf
                          <td>
                            <a href="/operator/objek/{{ $d->id_objek }}/edit" title="Edit Data"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                            <a class="hapus" href="#" data-id="{{ $d->id_objek }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
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
                <h5 class="modal-title">Tambah Objek PAP    </h5>
                <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/operator/objek/store" method="POST" id="frmCabang">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            @csrf
                                <input type="hidden" id="id_wajibpajak" value="{{ $perusahaan->id_wajibpajak}}" class="form-control" placeholder="Kode Lokasi" name="id_wajibpajak">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span>Nama Objek</span>
                                <input type="text" value="" id="nama" class="form-control" placeholder="" name="nama" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>HDAP</span>
                            <select name="id_hdap" id="unit" class="form-control" required="required">
                            <option value="">Pilih HDAP</option>
                            @foreach ($hdap as $d)
                            <option value="{{ $d->id_hdap }}">{{ $d->kelompok_hdap }} - Harga Dasar: Rp <?php echo number_format($d->nilai_hdap,0,',','.')?> </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>FEW</span>
                            <select name="id_few" id="unit" class="form-control" required="required">
                            <option value="">Pilih FEW</option>
                            @foreach ($few as $d)
                            <option value="{{ $d->id_few }}">{{ $d->nilai_pdrb }} - Faktor: {{$d->faktor_few}}% </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>FNAP SA</span>
                            <select name="id_sa" id="unit" class="form-control" required="required">
                            <option value="">Pilih SA</option>
                            @foreach ($sa as $d)
                            <option value="{{ $d->id_sa }}">{{ $d->sumber_air }} - Bobot: {{$d->bobot_sa}}% </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>FNAP LA</span>
                            <select name="id_la" id="unit" class="form-control" required="required">
                            <option value="">Pilih LA</option>
                            @foreach ($la as $d)
                            <option value="{{ $d->id_la }}">{{ $d->lokasi_la }} - Bobot: {{$d->bobot_la}}% </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>FNAP LP</span>
                            <select name="id_lp" id="unit" class="form-control" required="required">
                            <option value="">Pilih LP</option>
                            @foreach ($lp as $d)
                            <option value="{{ $d->id_lp }}">{{ $d->lokasi_lp }} - Bobot: {{$d->bobot_lp}}% </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>FNAP VA</span>
                            <select name="id_va" id="unit" class="form-control" required="required">
                            <option value="">Pilih VA</option>
                            @foreach ($va as $d)
                            <option value="{{ $d->id_va }}">{{ $d->volume }} - Bobot: {{$d->bobot_va}}% </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>FNAP KA</span>
                            <select name="id_ka" id="unit" class="form-control" required="required">
                            <option value="">Pilih KA</option>
                            @foreach ($ka as $d)
                            <option value="{{ $d->id_ka }}">{{ $d->kualitas_air }} - Bobot: {{$d->bobot_ka}}% </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>FNAP KDS</span>
                            <select name="id_kds" id="unit" class="form-control" required="required">
                            <option value="">Pilih KDS</option>
                            @foreach ($kds as $d)
                            <option value="{{ $d->id_kds }}">{{ $d->klasifikasi }} - Bobot: {{$d->bobot_kds}}% </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>FNAP KP</span>
                            <select name="id_kp" id="unit" class="form-control" required="required">
                            <option value="">Pilih KP</option>
                            @foreach ($kp as $d)
                            <option value="{{ $d->id_kp }}">{{ $d->klasifikasi_kp }} - Bobot: {{$d->bobot_kp}}% </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                            <span>FKPAP</span>
                            <select name="id_fkpap" id="unit" class="form-control" required="required">
                            <option value="">Pilih FKPAP</option>
                            @foreach ($fkpap as $d)
                            <option value="{{ $d->id_fkpap }}">{{$d->pengguna_fkpap}} = {{$d->fkpa}} </option>
                             @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-success w-100">
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
    var id_objek = $(this).attr('data-id');
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
    window.location = "/operator/objek/"+id_objek+"/hapus"
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
