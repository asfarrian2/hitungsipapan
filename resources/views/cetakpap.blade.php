<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://pap.kalsel.site/assets/foto_profil/sipapan.ico" rel="shortcut icon">

    <title>Hitung SIPAPAN</title>

    <!-- Bootstrap -->
    <link href="/gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/gentella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/gentella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="/gentella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/gentella/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="/gentella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
     <!-- Datatables -->
    <link href="/gentella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/gentella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/gentella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/gentella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/gentella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Theme Style -->
    <link href="/gentella/build/css/custom.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/wp/img/logoutama.png">
    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">


    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: legal
        }


        body.A4.potrait .sheet {
            width: 297mm !important;
            height: auto !important;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 potrait">

<section class="sheet padding-10mm">
<div class="">

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>LAPORAN<small>Pajak Air Permukaan</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <section class="content invoice">
          <!-- title row -->
          <div class="row">
            <div class="  invoice-header">
              <h3>
                <img src="/wp/img/logoutama.png" height="150px" alt="Logo">HITUNG PAP
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
              <b>Tanggal <?php $hitung->tanggal; ?></b>
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
                    <td>{{$hitung->fnap}}%</td>
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
              <img src="{{ url($foto_volume) }}" height="250px" style="margin-top: 10px;">
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
                <table width="100%" style="margin-top:20px">
                <td style="text-align: center" class="text-dark">Mengetahui,</td>
            </tr>
            <tr>
                <td style="text-align: center" class="text-dark"><b>PIMPINAN</b></td>
            </tr>
            <tr>
                <td style="text-align: center" class="text-dark"><b>PT. SLSOSKOSKOSKOKSOKSOKSOKSOKOKO</b></td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align:bottom" height="100px" class="text-dark">
                    <b><u>FEBRI</b></u><br>
                    <span>NIP. 19800813 200712 1 001<span>
                </td>
                </td>
            </tr>
        </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class=" ">
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
</div>


</section>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script> --}}
    @stack('wpscript')
    <script src="/gentella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/gentella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="/gentella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/gentella/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="/gentella/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="/gentella/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/gentella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/gentella/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/gentella/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/gentella/vendors/Flot/jquery.flot.js"></script>
    <script src="/gentella/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/gentella/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/gentella/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/gentella/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/gentella/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/gentella/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/gentella/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/gentella/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/gentella/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/gentella/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/gentella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/gentella/vendors/moment/min/moment.min.js"></script>
    <script src="/gentella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

      <!-- Datatables -->
      <script src="/gentella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/gentella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/gentella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/gentella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/gentella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/gentella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/gentella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/gentella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/gentella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/gentella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/gentella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/gentella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="/gentella/vendors/jszip/dist/jszip.min.js"></script>
    <script src="/gentella/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="/gentella/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/gentella/build/js/custom.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>
</html>
