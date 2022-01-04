<div class="modal fade" id="modal-transaksi-status-pengerjaan{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Customer</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('transaksi.update.status-pengerjaan', $item->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status_pengerjaan">Status Bayar</label>
                                <select class="form-control" name="status_pengerjaan" id="status_pengerjaan">
                                    @switch($item->status_pengerjaan)
                                        @case('selesai')
                                            <option value="sedang dikerjakan">Sedang Dikerjakan</option>
                                            <option selected value="selesai">Selesai</option>
                                            <option value="menunggu">Menunggu</option>
                                        @break
                                        @case('menunggu')
                                            <option value="sedang dikerjakan">Sedang Dikerjakan</option>
                                            <option value="selesai">Selesai</option>
                                            <option selected value="menunggu">Menunggu</option>
                                        @break
                                        @default
                                            <option selected value="sedang dikerjakan">Sedang Dikerjakan</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="menunggu">Menunggu</option>
                                    @endswitch
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary btn-close-customer" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-danger ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Submit</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
