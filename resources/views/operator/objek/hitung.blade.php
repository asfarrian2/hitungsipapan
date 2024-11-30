@extends('layouts.operatormaster')

@section('content')
<div class="">
    @csrf
    @php
    $messagewarning = Session::get('warning');
@endphp
@if (Session::get('warning'))
<a class="btn btn-danger btn-xs close-link text-succsess" href="#"><i class="fa fa-times text-succsess " > {{ $messagewarning }}</i></a>
<br>
@endif
          <div class="page-title">
            <div class="title_left">
              <h3>Hitung PAP</h3>
            </div>
        </div>
        <!-- forminput -->
        <div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Input Data</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="/operator/convert" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                                        @csrf
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Perusahaan / Wajib Pajak
											</label>
											<div class="col-md-6 col-sm-6 ">
                                                <select id="selectPerusahaan" name="perusahaan" class="form-control" required="required">
                                                <option value="">Pilih Wajib Pajak</option>
                                                 @foreach ($perusahaan as $d)
                                                <option value="{{ $d->id_wajibpajak }}">{{ $d->nama }}</option>
                                                  @endforeach
                                                </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Objek Pajak
											</label>
											<div class="col-md-6 col-sm-6 ">
                                                <select id="objek" name="objek" class="form-control" required="required">
                                                    <option value="">Pilih Objek</option>
                                                </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Volume Penggunaan Air (M3)
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" name="m3" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Foto Water Meter
											</label>
											<div class="col-md-6 col-sm-6 ">
                                                <input type="file" accept="image/*" capture="environtment" id="fileuploadInput" name="foto" class="form-control" required="required">
                                                </input>
											</div>
										</div>
                                        <div class="clearfix"></div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" id="hitung" class="btn btn-success">Hitung</button>
                                                <a href="/wp/home" class="btn btn-dark">Batal</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
                <!-- forminput -->
                </div>
            </div>

@endsection

@push('myscript')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    $(document).ready(function(){
        $("#selectPerusahaan").on('change', function(){
            var id_wajibpajak = $(this).val();
           //console.log(id_wajibpajak);
           if (id_wajibpajak) {
            $.ajax({
                url: '/objek/'+id_wajibpajak,
                type: 'GET',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (data){
                    //console.log(data);
                     if (data) {
                        $("#objek").empty();
                        $('#objek').append('<option value=""> Pilih Objek </option>');
                        $.each(data, function(key, objek){
                            $('select[name="objek"]').append(
                                '<Option value="'+objek.id_objek+'">'+objek.nama_objek+'</Option>'
                            )
                        });
                     }else{
                        $("#objek").empty();
                     }
                }
            });
           } else {
            $("#objek").empty();
           }
        });
    });
</script>
@endpush
