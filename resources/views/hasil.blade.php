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
                          <h1>
                            <img src="/wp/img/logoutama.png" height="150px" alt="Logo">HITUNG SIPAPAN (PAP)
                                      </h1>
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
                                          <strong>{{$objek_pajak->nama_unit}}</strong>
                                          <br>Jl. A. Yani Km. 66 RW. 06 RW. 07 Pelaihari Kab. Tanah Laut Prov. Kalimantan Selatan
                                          <br>No. Telepon 1 (804) 123-9876
                                          <br>Email uppdpelaihari@gmail.com
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Kode #007612</b>
                          <br>
                          <b>Tanggal 12 Desember 2024</b>
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
                                <td>{{$objek_pajak->kelompok_hdap}}</td>
                                <td>Rp <?php echo number_format($objek_pajak->nilai_hdap,0,',','.')?> </td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>FEW</td>
                                <td>{{$objek_pajak->nilai_pdrb}}</td>
                                <td>{{$objek_pajak->faktor_few}}%</td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>FNAP-SA</td>
                                <td>{{$objek_pajak->sumber_air}}</td>
                                <td>{{$objek_pajak->bobot_sa}}%</td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td>FNAP-LA</td>
                                <td>{{$objek_pajak->lokasi_la}}</td>
                                <td>{{$objek_pajak->bobot_la}}%</td>
                              </tr>
                              <tr>
                                <td>5</td>
                                <td>FNAP-SA</td>
                                <td>{{$objek_pajak->sumber_air}}</td>
                                <td>{{$objek_pajak->bobot_sa}}%</td>
                              </tr>
                              <tr>
                                <td>6</td>
                                <td>FNAP-LP</td>
                                <td>{{$objek_pajak->lokasi_lp}}</td>
                                <td>{{$objek_pajak->bobot_lp}}%</td>
                              </tr>
                              <tr>
                                <td>7</td>
                                <td>FNAP-VA</td>
                                <td>{{$objek_pajak->volume}}</td>
                                <td>{{$objek_pajak->bobot_va}}%</td>
                              </tr>
                              <tr>
                                <td>8</td>
                                <td>FNAP-KA</td>
                                <td>{{$objek_pajak->kualitas_air}}</td>
                                <td>{{$objek_pajak->bobot_ka}}%</td>
                              </tr>
                              <tr>
                                <td>9</td>
                                <td>FNAP-KDS</td>
                                <td>{{$objek_pajak->klasifikasi}}</td>
                                <td>{{$objek_pajak->bobot_kds}}%</td>
                              </tr>
                              <tr>
                                <td>10</td>
                                <td>FNAP-KP</td>
                                <td>{{$objek_pajak->klasifikasi_kp}}</td>
                                <td>{{$objek_pajak->bobot_kp}}%</td>
                              </tr>
                              <tr>
                                <td>11</td>
                                <td>FNAP</td>
                                <td>FNAP=SA*LA*LP*VA*KA*KDS*KP</td>
                                <td>{{$jumlah_fnap}}%</td>
                              </tr>
                              <tr>
                                <td>12</td>
                                <td>FKPAP</td>
                                <td>{{$objek_pajak->kegiatan_fkpap}}</td>
                                <td>{{$objek_pajak->fkpa}}</td>
                              </tr>
                              <tr>
                                <td><b>13</b></td>
                                <td><b>NPAP</b></td>
                                <td><b>NPAP = HDAP*FEW*FNAP*KPAP</b></td>
                                <td><b>{{$objek_pajak->npap}}</b></td>
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
                          <p class="lead">Payment Methods:</p>
                          <img src="images/visa.png" alt="Visa">
                          <img src="images/mastercard.png" alt="Mastercard">
                          <img src="images/american-express.png" alt="American Express">
                          <img src="images/paypal.png" alt="Paypal">
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                          <h3><b>{{$objek_pajak -> nama}}</></b></h3>
                          <p class="lead">Objek Pajak Air Permukaan Berupa: {{$objek_pajak -> nama_objek}}</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">TARIF</th>
                                  <td>10%</td>
                                </tr>
                                <tr>
                                  <th>NPAP</th>
                                  <td>{{$objek_pajak->npap}}</td>
                                </tr>
                                <tr>
                                  <th>VOLUME PEMAKAIAN AIR</th>
                                  <td>{{$m3}} M3</td>
                                </tr>
                                <tr>
                                  <th>TOTAL (Tarif*NPAP*Volume Pemakian Air)</th>
                                  <td><h5><b>Rp <?php echo number_format($hasil,0,',','.')?><b></h5></td>
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
                        <div class=" ">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection
