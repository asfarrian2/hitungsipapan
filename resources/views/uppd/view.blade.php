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
              <h3>Unit Pelayanan Pendapatan Daerah</h3>
             </div>
             </div>
             <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabel Data</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <a href="/uppd/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i><span> Tambah</span></a>
                            <div class="clearfix"><br></div>
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th width="10px" class="text-center">No.</th>
                          <th width="10px" class="text-center">ID</th>
                          <th class="text-center">Nama</th>
                          <th class="text-center">No. Telp</th>
                          <th class="text-center">Email</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($uppd as $d)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $d->id_unit }}</td>
                          <td>{{ $d->nama_unit }}</td>
                          <td>{{ $d->no_telp }}</td>
                          <td>{{ $d->email }}</td>
                          @csrf
                          <td>
                            <a href="/uppd/{{ $d->id_unit }}/edit" title="Edit Data"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                            <a class="reset" href="#" data-id="{{ $d->id_unit }}" title="Reset password"><i class="reset fa fa-refresh text-succsess btn btn-primary btn-sm" ></i></a>
                            <a class="hapus" href="#" data-id="{{ $d->id_unit }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
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
@endsection

@push('myscript')
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
$('.reset').click(function(){
    var id_unit = $(this).attr('data-id');
Swal.fire({
  title: "Apakah Anda Yakin Ingin Melakukan Reset Password ?",
  text: "Jika Ya Maka Data Password Akan Direset",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Ya, Reset Saja!"
}).then((result) => {
  if (result.isConfirmed) {
    window.location = "/uppd/"+id_unit+"/reset"
    Swal.fire({
      title: "Password Berhasil Direset !",
      icon: "success"
    });
  }
});
});
</script>
@endpush
