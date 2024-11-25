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
                    <a class="text-secondary" href="/wp/hitungpap">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    <h4 class="glyphicon-class">Hitung Pajak</h4>
                    </a>
                  </li>

                  <li>
                    <a class="text-secondary" href="#">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                    <h4 class="glyphicon-class">Histori</h4>
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
