<!DOCTYPE html>
<html>

<head>
    <title>Laporan Buku Besar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigi n="anonymous">
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 10pt;
        }

    </style>
</head>

<body>
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header">
                <table class="table table-bordered" width="100%" align="center">
                    <tr align="center">
                        <td>
                            <h2>STRUK TRANSAKSI</h2>
                            <hr>
                        </td>
                    </tr>
                </table>
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
    {{-- <table class="table table-bordered" width="100%" align="center">
        <tr align="center">
            <td>
                <h2>STRUCK TRANSAKSI</h2>
                <hr>
            </td>
        </tr>
    </table> --}}
    {{-- <table class="table table-bordered" width="100%" align="center">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">No Transaksi</th>
                <th width="15%">Tanggal Transaksi</th>
                <th width="25%">Catatan</th>
                <th width="15%">Debet</th>
                <th width="15%">Kredit</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($bukubesar as $bb)
                <tr align="center">
                    <td>{{ $i++ }}</td>
                    <td>{{ $bb->notran }}</td>
                    <td>{{ $bb->tgltran }}</td>
                    <td>{{ $bb->catatan }}</td>
                    <td>{{ $bb->jmldb }}</td>
                    <td>{{ $bb->jmlcr }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
    {{-- <div align="right">
        <h6>Tanda Tangan</h6><br><br>
        <h6>{{ Auth::user()->name }}</h6>
    </div> --}}
</body>

</html>
