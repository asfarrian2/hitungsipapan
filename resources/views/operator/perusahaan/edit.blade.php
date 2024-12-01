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
              <h3>Wajib Pajak</h3>
            </div>
        </div>
        <!-- forminput -->
        <div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Edit Data</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="/operator/wp/update" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                        @csrf
                                        <div class="item form-group">
											<div class="col-md-6 col-sm-6 ">
												<input type="hidden" name="id_wajibpajak" value="{{ $perusahaan->id_wajibpajak }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">ID
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" maxlength="10" name="id_wajibpajak_baru" value="{{ $perusahaan->id_wajibpajak }}" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="nama" value="{{ $perusahaan->nama }}" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="alamat" value="{{ $perusahaan->alamat }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kegiatan
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="kegiatan" value="{{ $perusahaan->kegiatan }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kegiatan
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="pimpinan" value="{{ $perusahaan->pimpinan }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. Telepon
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="no_telp" value="{{ $perusahaan->no_telp }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="email" value="{{ $perusahaan->email }}" id="first-name"  class="form-control ">
											</div>
										</div>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="unit" id="unit" class="form-control" hidden>
                                            <option value="">Pilih Unit Penagihan</option>
                                                @foreach ($uppd as $d)
                                                    <option {{ $perusahaan->id_unit == $d->id_unit ? 'selected' : '' }}
                                                        value="{{ $d->id_unit }}">{{ strtoupper($d->nama_unit) }}</option>
                                                @endforeach
                                            </select>
											</div>

										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" class="btn btn-success">Simpan</button>
                                                <a href="/operator/wp/view" class="btn btn-dark">Batal</a>
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
