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

          <div class="page-title">
            <div class="title_left">
              <h3>Hasil Perhitungan</h3>
             </div>
             </div>
             <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
                          <th width="10px" class="text-center">No.</th>
                          <th width="10px" class="text-center">ID</th>
                          <th width="10px" class="text-center">Tanggal</th>
                          <th class="text-center">Objek Pajak</th>
                          <th class="text-center">Volume Pemakaian</th>
                          <th class="text-center">Jumlah Pajak Air Permukaan</th>
                          <th class="text-center">Foto Water Meter</th>
                          <th class="text-center">Pengajuan</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($hitung as $d)
                      @php
                      $foto_volume = Storage::url('uploads/hitung/' . $d->foto);
                      @endphp
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $d->id_hitung }}</td>
                          <td>{{ $d->tanggal }}</td>
                          <td>{{ $d->nama_objek }}</td>
                          <td>{{ $d->volume_pemakaian }} M3</td>
                          <td>Rp <?php echo number_format($d->jumlah_pap,0,',','.')?></td>
                          <td><img src="{{ url($foto_volume) }}" width="200px" alt=""></td>
                          <td>@if ($d->pengajuan == null)
                            <a class="btn-warning">Tidak Ada</a>
                             @else
                            <a class="btn-primary">Diajukan</a>
                            @endif
                          <td>@if ($d->status == 2)
                            <a class="btn-success">Disetujui</a>
                             @elseif($d->status == 1)
                            <a class="btn-primary">Diajukan</a>
                            @elseif($d->status == 3)
                            <a class="btn-danger">Ditolak</a>
                            @else
                            <p><a class="btn-warning">Tidak Ada</a><p>
                            @endif</td>
                          @csrf
                          <td>
                            @if ($d->pengajuan == null)
                            <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> Ajukan</a>
                             @else
                            <a class="btn btn-primary">Diajukan</a>
                            @endif
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
