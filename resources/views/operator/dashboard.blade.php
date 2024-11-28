@extends('layouts.operatormaster')

@section('content')

<div class="">
<div class="row" style="display: inline-block;">
<div class="top_tiles">
            <table>
                <tbody>
                    <tr>
                        <td>
                        <div class="animated flipInY">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user"></i></div>
                  <div class="count">{{$jumlah_wp}}</div>
                  <h3>Wajib Pajak</h3>
                  <p>Jumlah Wajib Pajak PAP pada {{ Auth::guard('uppd')->user()->nama_unit}}</p>
                </div>
              </div>
                        </td>
                    <td height="120px"></td>
                        <td>
                        <div class="animated flipInY">
                <div class="tile-stats">

                </div>
              </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
          </div>
          </div>


@endsection
