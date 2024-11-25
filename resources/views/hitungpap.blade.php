@extends('layouts.wpmaster')

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
									<form action="/wp/store" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                        @csrf
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Objek PAP
											</label>
											<div class="col-md-6 col-sm-6 ">
                                                <select name="objek" id="unit" class="form-control" required="required">
                                                    <option value="">Pilih Objek PAP</option>
                                                   {{-- @foreach ($uppd as $d) --}}
                                                   {{-- <option value="{{ $d->id_unit }}">{{ $d->nama_unit }}</option> --}}
                                                   {{-- @endforeach --}}
                                                   </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Penggunaan Air (M3)
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" name="m3" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">

                                            <div class="webcem webcam-capture video"></div>
                                        </div>
                                        <div class="clearfix"></div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" id="hitung" class="btn btn-success">Hitung</button>
                                                <a href="/wp/hitungpap" class="btn btn-dark">Batal</a>
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
