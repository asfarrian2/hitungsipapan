@extends('layouts.wpmaster')

@section('content')

<div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>HITUNG SIPAPAN<small>Pajak Air Permukaan</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="  invoice-header">
                          <h3>
                            <img src="/wp/img/logoutama.png" height="150px" alt="Logo">HITUNG SIPAPAN
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          Perusahaan (Wajib Pajak):
                          <address>
                                          <strong>{{Auth::guard('wp')->user()->nama }}</strong>
                                          <br>{{Auth::guard('wp')->user()->alamat }}
                                          <br>No. Telepon -
                                          <br>Email: {{Auth::guard('wp')->user()->email }}
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          BAPENDA Prov. Kalsel / Unit:
                          <address>
                                          <strong>{{$hitung->nama_unit}}</strong>
                                          <br>Jl. A. Yani Km. 66 RW. 06 RW. 07 Pelaihari Kab. Tanah Laut Prov. Kalimantan Selatan
                                          <br>No. Telepon 1 (804) 123-9876
                                          <br>Email uppdpelaihari@gmail.com
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Kode #{{$hitung->id_hitung}}</b>
                          <br>
                          <?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    } ?>
                          <b>Tanggal <?php echo tgl_indo(date($hitung->tanggal)); ?></b>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="  table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="width: 10%">No.</th>
                                <th style="width: 10%">NPAP</th>
                                <th style="width: 70%">Rincian</th>
                                <th style="width: 10%">Nilai</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>HDAP</td>
                                <td>{{$hitung->kelompok_hdap}}</td>
                                <td>Rp <?php echo number_format($hitung->nilai_hdap,0,',','.')?> </td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>FEW</td>
                                <td>{{$hitung->nilai_pdrb}}</td>
                                <td>{{$hitung->faktor_few}}%</td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>FNAP-SA</td>
                                <td>{{$hitung->sumber_air}}</td>
                                <td>{{$hitung->bobot_sa}}%</td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td>FNAP-LA</td>
                                <td>{{$hitung->lokasi_la}}</td>
                                <td>{{$hitung->bobot_la}}%</td>
                              </tr>
                              <tr>
                                <td>5</td>
                                <td>FNAP-SA</td>
                                <td>{{$hitung->sumber_air}}</td>
                                <td>{{$hitung->bobot_sa}}%</td>
                              </tr>
                              <tr>
                                <td>6</td>
                                <td>FNAP-LP</td>
                                <td>{{$hitung->lokasi_lp}}</td>
                                <td>{{$hitung->bobot_lp}}%</td>
                              </tr>
                              <tr>
                                <td>7</td>
                                <td>FNAP-VA</td>
                                <td>{{$hitung->volume}}</td>
                                <td>{{$hitung->bobot_va}}%</td>
                              </tr>
                              <tr>
                                <td>8</td>
                                <td>FNAP-KA</td>
                                <td>{{$hitung->kualitas_air}}</td>
                                <td>{{$hitung->bobot_ka}}%</td>
                              </tr>
                              <tr>
                                <td>9</td>
                                <td>FNAP-KDS</td>
                                <td>{{$hitung->klasifikasi}}</td>
                                <td>{{$hitung->bobot_kds}}%</td>
                              </tr>
                              <tr>
                                <td>10</td>
                                <td>FNAP-KP</td>
                                <td>{{$hitung->klasifikasi_kp}}</td>
                                <td>{{$hitung->bobot_kp}}%</td>
                              </tr>
                              <tr>
                                <td>11</td>
                                <td>FNAP</td>
                                <td>FNAP=SA*LA*LP*VA*KA*KDS*KP</td>
                                <td>{{$cfnap}}%</td>
                              </tr>
                              <tr>
                                <td>12</td>
                                <td>FKPAP</td>
                                <td>{{$hitung->kegiatan_fkpap}}</td>
                                <td>{{$hitung->fkpa}}</td>
                              </tr>
                              <tr>
                                <td><b>13</b></td>
                                <td><b>NPAP</b></td>
                                <td><b>NPAP = HDAP*FEW*FNAP*KPAP</b></td>
                                <td><b>{{$hitung->npap}}</b></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-md-6">
                        @php
                        $foto_volume = Storage::url('uploads/hitung/' . $hitung->foto);
                        @endphp
                          <p class="lead">Foto Water Meter:</p>
                          <img src="{{ url($foto_volume) }}" width="350px" style="margin-top: 10px;">
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                          <h3><b>{{$hitung -> nama}}</></b></h3>
                          <p class="lead">Objek Pajak Air Permukaan Berupa: {{$hitung -> nama_objek}}</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">TARIF</th>
                                  <td>10%</td>
                                </tr>
                                <tr>
                                  <th>NPAP</th>
                                  <td>{{$hitung->npap}}</td>
                                </tr>
                                <tr>
                                  <th>VOLUME PEMAKAIAN AIR</th>
                                  <td>{{$hitung->volume_pemakaian}} M3</td>
                                </tr>
                                <tr>
                                  <th>TOTAL (Tarif*NPAP*Volume Pemakian Air)</th>
                                  <td><h5><b>Rp <?php echo number_format($hitung->jumlah_pap,0,',','.')?><b></h5></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="" style="margin-top:40px">
                        <!-- <a href="/wp/cetak/{{$hitung->id_hitung}}" target="_blank" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</a> -->
                        <button href="#" data-id="{{$hitung->id_hitung}}" id="lanjut" class="btn btn-success pull-right"><i class="fa fa-check lanjut"></i> Lanjutkan dan Ajukan</button>
                        <a href="/wp/home" class="btn btn-dark pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>


@endsection

@push('wpscript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$('#lanjut').click(function(){
    var id_hitung = $(this).attr('data-id');
Swal.fire({
  title: "Apakah Anda Yakin Ingin Mengajukan Hasil Perhitungan PAP Ini ?",
  text: "Pastikan Data Diisi Benar dan Sesuai",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Ya, Ajukan"
}).then((result) => {
  if (result.isConfirmed) {
    window.location = "/wp/ajukan/"+id_hitung
    Swal.fire({
      title: "Data Berhasil Ditambah Dipengajuan !",
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

