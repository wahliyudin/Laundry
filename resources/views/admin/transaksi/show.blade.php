@extends('layouts.admin-master')
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4>View Transaksi {{ $transaksi->no_reference }}</h4>
                <div class="box box-warning">
                    <div class="box-header">
                        <p>
                            <a href="{{ route('transaksi.export', $transaksi->id) }}" class="btn btn-sm btn-flat btn-success"><i class="la la-file-pdf-o"></i> Cetak Struck</a>
                        </p>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Reference No : </th>
                                                <td>{{ $transaksi->no_reference }}</td>

                                                <th>Tanggal : </th>
                                                <td>{{ $transaksi->tanggal }}</td>

                                                <th>Grand Total Amount : </th>
                                                <td>Rp. {{ number_format($transaksi->grand_total, 0, '', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Customer : </th>
                                                <td>{{ $transaksi->user->name }}</td>

                                                <th>No Telp : </th>
                                                <td>{{ $transaksi->no_wa }}</td>

                                                <th>Alamat : </th>
                                                <td>{{ $transaksi->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Status Bayar :
                                                    @if ($transaksi->status_bayar === 'belum bayar')
                                                        <span
                                                            class="btn btn-warning btn-sm">{{ $transaksi->status_bayar }}</span>
                                                    @else
                                                        <span
                                                            class="btn btn-success btn-sm">{{ $transaksi->status_bayar }}</span>
                                                    @endif
                                                </th>

                                                <th>Status Pengerjaan :
                                                    @switch($transaksi->status_pengerjaan)
                                                        @case('selesai')
                                                            <span
                                                                class="btn btn-success btn-sm">{{ $transaksi->status_pengerjaan }}</span>
                                                        @break
                                                        @case('menunggu')
                                                            <span
                                                                class="btn btn-secondary btn-sm">{{ $transaksi->status_pengerjaan }}</span>
                                                        @break
                                                        @default
                                                            <span
                                                                class="btn btn-info btn-sm">{{ $transaksi->status_pengerjaan }}</span>
                                                    @endswitch
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr style=" border-top: 4px dashed blue;">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Paket</th>
                                                <th>Berat (kg)</th>
                                                <th>Harga</th>
                                                <th>SubTotal</th>
                                                <th>Estimasi Selesai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaksi->pakets as $item)
                                                <tr>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->pivot->berat }} Kg</td>
                                                    <td>Rp {{ number_format($item->harga, 0, '', '.') }}</td>
                                                    <td>Rp {{ number_format($item->pivot->subtotal, 0, '', '.') }}</td>
                                                    <td>{{ $item->pivot->estimasi }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr style=" border-top: 4px dashed blue;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
