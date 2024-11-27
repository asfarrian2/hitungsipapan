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
              <h3>Objek Pajak</h3>
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
									<form action="/operator/objek/update" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                                        @csrf
                                        <div class="item form-group">
											<div class="col-md-6 col-sm-6 ">
												<input type="hidden" name="id_wajibpajak" value="{{ $objek_pajak->id_wajibpajak }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<div class="col-md-6 col-sm-6 ">
												<input type="hidden" name="id_objek" value="{{ $objek_pajak->id_objek }}" id="first-name"  class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Wajib Pajak
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input readonly type="text" name="id_unit" value="{{$objek_pajak->nama}}" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" name="nama_objek" value="{{ $objek_pajak->nama_objek }}" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">HDAP
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="id_hdap" id="unit" class="form-control">
                                            <option value="">Pilih HDAP</option>
                                                @foreach ($hdap as $d)
                                                    <option {{ $objek_pajak->id_hdap == $d->id_hdap ? 'selected' : '' }}
                                                        value="{{ $d->id_hdap }}">{{ $d->kelompok_hdap }} - Harga Dasar:
                                                        Rp <?php echo number_format($d->nilai_hdap,0,',','.')?> </option>
                                                @endforeach
                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">FEW
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="id_few" id="unit" class="form-control">
                                            <option value="">Pilih FEW</option>
                                                @foreach ($few as $d)
                                                    <option {{ $objek_pajak->id_few == $d->id_few ? 'selected' : '' }}
                                                        value="{{ $d->id_few }}">{{ $d->nilai_pdrb }} - Faktor: {{$d->faktor_few}}% </option>
                                                @endforeach
                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">FNAP-SA
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="id_sa" id="unit" class="form-control">
                                            <option value="">Pilih SA</option>
                                                @foreach ($sa as $d)
                                                    <option {{ $objek_pajak->id_sa == $d->id_sa ? 'selected' : '' }}
                                                        value="{{ $d->id_sa }}">{{ $d->sumber_air }} - Bobot: {{$d->bobot_sa}}% </option>
                                                @endforeach
                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">FNAP-LA
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="id_la" id="unit" class="form-control">
                                            <option value="">Pilih LA</option>
                                                @foreach ($la as $d)
                                                    <option {{ $objek_pajak->id_la == $d->id_la ? 'selected' : '' }}
                                                        value="{{ $d->id_la }}">{{ $d->lokasi_la }} - Bobot: {{$d->bobot_la}}%</option>
                                                @endforeach
                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">FNAP-LP
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="id_lp" id="unit" class="form-control">
                                            <option value="">Pilih LP</option>
                                                @foreach ($lp as $d)
                                                    <option {{ $objek_pajak->id_lp == $d->id_lp ? 'selected' : '' }}
                                                        value="{{ $d->id_lp }}">{{ $d->lokasi_lp }} - Bobot: {{$d->bobot_lp}}%</option>
                                                @endforeach
                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">FNAP-VA
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="id_va" id="unit" class="form-control">
                                            <option value="">Pilih VA</option>
                                                @foreach ($va as $d)
                                                    <option {{ $objek_pajak->id_va == $d->id_va ? 'selected' : '' }}
                                                        value="{{ $d->id_va }}">{{ $d->volume }} - Bobot: {{$d->bobot_va}}%</option>
                                                @endforeach
                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">FNAP-KA
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="id_ka" id="unit" class="form-control">
                                            <option value="">Pilih KA</option>
                                                @foreach ($ka as $d)
                                                    <option {{ $objek_pajak->id_ka == $d->id_ka ? 'selected' : '' }}
                                                        value="{{ $d->id_ka }}">{{ $d->kualitas_air }} - Bobot: {{$d->bobot_ka}}%</option>
                                                @endforeach
                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">FNAP-KDS
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="id_kds" id="unit" class="form-control">
                                            <option value="">Pilih KDS</option>
                                                @foreach ($kds as $d)
                                                    <option {{ $objek_pajak->id_kds == $d->id_kds ? 'selected' : '' }}
                                                        value="{{ $d->id_kds }}">{{ $d->klasifikasi }} - Bobot: {{$d->bobot_kds}}%</option>
                                                @endforeach
                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">FNAP-KP
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="id_kp" id="unit" class="form-control">
                                            <option value="">Pilih KP</option>
                                                @foreach ($kp as $d)
                                                    <option {{ $objek_pajak->id_kp == $d->id_kp ? 'selected' : '' }}
                                                        value="{{ $d->id_kp }}">{{ $d->klasifikasi_kp }} - Bobot: {{$d->bobot_kp}}%</option>
                                                @endforeach
                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">FKPAP
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select name="id_fkpap" id="unit" class="form-control">
                                            <option value="">Pilih FKPAP</option>
                                                @foreach ($fkpap as $d)
                                                    <option {{ $objek_pajak->id_fkpap == $d->id_fkpap ? 'selected' : '' }}
                                                        value="{{ $d->id_fkpap }}">{{$d->pengguna_fkpap}} = {{$d->fkpa}}</option>
                                                @endforeach
                                            </select>
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button type="submit" class="btn btn-success">Simpan</button>
                                                <a href="javascript:history.back()" class="btn btn-dark">Batal</a>
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
