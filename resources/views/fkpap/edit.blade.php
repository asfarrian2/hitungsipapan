@extends('layouts.master')

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
              <h3>Faktor Nilai Air Permukaan (FNAP)</h3>
            </div>
        </div>
        <!-- forminput -->
        <div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Edit Data Faktor Nilai Air Permukaan (FNAP)</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="/fkpap/update" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                        @csrf
                                        <div class="item form-group">
											<div class="col-md-6 col-sm-6 ">
												<input type="hidden" name="i0" value="{{ $fkpap->id_fkpap }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kegiatan
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="i1" value="{{ $fkpap->kegiatan_fkpap }}" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pengguna / Pemanfaatan Air
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="i2" value="{{ $fkpap->pengguna_fkpap }}" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">FKPA
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="i3" value="{{ $fkpap->fkpa }}" maxlength="3" id="first-name"  required="required" class="form-control ">
											</div>
                                        </div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" class="btn btn-success">Simpan</button>
                                                <a href="/fkpap/view" class="btn btn-dark">Batal</a>
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
