@extends('layouts.admin-master')
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4>Create Transaksi</h4>
                <div class="box box-warning">
                    <div class="box-header">
                        <p>
                            <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-flat btn-primary"><i
                                    class="fa fa-backward"></i> Kembali ke list Transaksi</a>
                        </p>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('transaksi.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal</label>
                                        <input type="text" autocomplete="off" name="tanggal" value="{{ date_format(now(), 'Y-m-d') }}"
                                            class="form-control datepicker" id="exampleInputEmail1" placeholder="Tanggal"
                                            required="">
                                    </div>

                                    <div class="form-group">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-md-9">
                                                <label for="exampleInputEmail1">Select Customer</label>
                                                <select class="form-control select2 cari-customer" name="user_id"
                                                    required="">
                                                    <option selected disabled>Pilih Customer</option>
                                                    @foreach ($customer as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-info btn-add-customer">Add
                                                customer</button>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-block btn-tambah-item">Tambah
                                            Item</button>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">No WA Aktif</label>
                                        <input type="text" autocomplete="off" class="form-control" id="exampleInputEmail1"
                                            placeholder="No WA" name="no_wa" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alamat</label>
                                        <textarea class="form-control" name="alamat" rows="3" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr style=" border-top: 4px dashed blue;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="datatable table table-stripped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Paket</th>
                                                    <th>Berat (Kg)</th>
                                                    <th>Harga</th>
                                                    <th>Subtotal</th>
                                                    <th>Estimasi Selesai</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list-item">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr style=" border-top: 4px dashed blue;">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Status Bayar</label>
                                        <select class="form-control select2" name="status_bayar">
                                            <option value="belum bayar">Belum Dibayar</option>
                                            <option value="sudah bayar">Sudah Dibayar</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Status Pengerjaan</label>
                                        <select class="form-control select2" name="status_pengerjaan">
                                            <option value="menunggu">Menunggu</option>
                                            <option value="sedang dikerjakan">Sedang Dikerjakan</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Grand Total</label>
                                        <input type="text" name="grand_total" class="form-control" value="0" readonly="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('admin.modal.transaksi.create')
@endsection
@section('js')
    <script>
        $(document).ready(function() {

            $('.btn-add-customer').click(function(e) {
                e.preventDefault();
                // var url = $(this).closest('form').attr('action');
                $('#modal-customer').modal();
            })
            $('.btn-close-customer').click(function(e) {
                e.preventDefault();
                // var url = $(this).closest('form').attr('action');
                $('#modal-customer').modal('hide');
            })

            $('.btn-submit-customer').click(function(e) {
                e.preventDefault();
                var url = $(this).closest('form').attr('action');
                // $('#modal-customer').modal();
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: $(this).closest('form').serialize(),
                    success: function(data) {
                        console.log(data.dt);
                        var hasil = '';

                        hasil += '<option value="' + data.dt.id + '">';
                        hasil += data.dt.name;
                        hasil += '</option>';

                        $("select[name='user_id']").append(hasil);
                        $("input[name='no_wa']").val(data.dt.no_telp);
                        $("textarea[name='alamat']").val(data.dt.alamat);
                        $('#modal-customer').modal('hide');
                    },
                    error: function(a, b, c) {
                        alert(c);
                    }
                });
            })

            function calculate_grand_total() {

                var grand_total = 0;

                var sub_total = 0;
                $('.sub-total').each(function(i, v) {
                    var total = $(this).val();
                    if (total == '') {
                        total = 0;
                    }
                    total = parseFloat(total);
                    sub_total += total;
                });
                grand_total = parseFloat(sub_total);


                $("input[name='grand_total']").val(grand_total);
            }

            // inputan berat ===================
            $('body').on('keyup', '.berat-row', function(e) {
                var berat = $(this).val();
                if (berat == '') {
                    berat = 0;
                }
                berat = parseFloat(berat);

                var harga = $('tr:last-child .harga-paket').val();
                
                
                if (harga == '') {
                    harga = 0;
                }
                harga = parseFloat(harga);

                var sub_total = harga * berat;
                $(this).closest('tr').find('tr:last-child .sub-total').val(sub_total);

                calculate_grand_total();
            });

            $('body').on('change', '.berat-row', function(e) {
                var berat = $(this).val();
                if (berat == '') {
                    berat = 0;
                }
                berat = parseFloat(berat);

                var harga = $('tr:last-child .harga-paket').val();
                if (harga == '') {
                    harga = 0;
                }
                harga = parseFloat(harga);

                var sub_total = harga * berat;
                $(this).closest('tr').find('.sub-total').val(sub_total);

                calculate_grand_total();
            })
            // end inputan berat ===================

            $('body').on('change', '.item-paket', function(e) {
                var id = $(this).val();
                var url = "http://127.0.0.1:8000/admin/paket/" + id;
                var _this = $(this);
                $.get(url, function(data, stat) {
                    // console.log(data);
                    // alert(data);
                    _this.closest('tr').find('.harga-paket').val(data['harga']);
                    _this.closest('tr').find('.estimasi-selesai').val(data['estimasi']);

                    var harga = data['harga'];
                    var berat = _this.closest('tr').find('.berat-row').val();
                    var sub_total = parseFloat(harga) * parseFloat(berat);
                    _this.closest('tr').find('.sub-total').val(sub_total);

                    calculate_grand_total();
                });


            });

            function calculate_total_row(paket) {

                var tgl = $("input[name='tanggal']").val();
                var url = "https://laundry2.fadly.xyz/transaksi/create/get-detail-paket-ajax" + '/' + paket + '/' +
                    tgl;
                $.get(url, function(data, stat) {
                    // console.log(data);
                    $('.harga-paket').val(data.data.harga);
                    $('.estimasi-selesai').val(data.durasi);
                });

            }


            $('.btn-tambah-item').click(function(e) {
                e.preventDefault();

                var no = 0;
                var url = "http://127.0.0.1:8000/admin/all-paket";
                $.ajax({
                    url: url,
                    type: 'get',
                    dataType: 'json',
                    // data: $(this).closest('form').serialize(),
                    success: function(data) {
                        // alert(data[0]['id']);
                        var nilai = '';
                        nilai += '<tr>';
                        nilai += '<td>';
                        nilai +=
                            '<select class="form-control item-paket" name="id_paket[]" required="">';
                        nilai += '<option selected="" disabled="">Pilih Paket</option>';
                        for (let index = 0; index < data.length; index++) {
                            nilai += '<option value="' + data[index]['id'] + '">' + data[index][
                                'nama'
                            ] + '</option>';
                        }
                        nilai += '</select>';
                        nilai += '</td>';

                        nilai += '<td>';
                        nilai +=
                            '<input type="number" value="0" min="0" name="berat[]" class="form-control berat-row" required="">'
                        nilai += '</td>';

                        nilai += '<td>';
                        nilai +=
                            '<input type="text" name="harga[]" class="form-control harga-paket" readonly="">'
                        nilai += '</td>';

                        nilai += '<td>';
                        nilai +=
                            '<input type="text" name="subtotal[]" class="form-control sub-total" readonly="">'
                        nilai += '</td>';

                        nilai += '<td>';
                        nilai +=
                            '<input type="text" name="estimasi[]" class="form-control datepicker estimasi-selesai">'
                        nilai += '</td>';

                        nilai += '<td>';
                        nilai +=
                            '<button class="btn btn-danger btn-xs btn-hapus-row"><i class="fa fa-trash"></i></button>';
                        nilai += '</td>';

                        nilai += '</tr>';

                        $('.list-item').append(nilai);
                    },
                    error: function(a, b, c) {
                        alert(c);
                    }
                });

                calculate_grand_total();
            });

            $('body').on('click', '.btn-hapus-row', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
                calculate_grand_total();
            })

            $("select[name='user_id']").change(function(e) {
                var id = $(this).val();
                var url = "http://127.0.0.1:8000/admin/user/" + id;

                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url: url,
                    success: function(data) {
                        $("input[name='no_wa']").val(data.no_wa);
                        $("textarea[name='alamat']").val(data.alamat);
                    },
                    error: function(a, b, c) {
                        alert(c);
                    }
                })
            })

            $('.cari-customer').select2({
                placeholder: 'Ketik Untuk Mencari...',
                ajax: {
                    url: "https://laundry2.fadly.xyz/transaksi/create/get-customer-ajax",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            })
        })
    </script>
@endsection
