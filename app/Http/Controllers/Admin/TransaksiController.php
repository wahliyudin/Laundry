<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\PaketTransaksi;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDF;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::all();
        $total = 0;
        foreach ($transaksis as $value) {
            $total += $value->grand_total;
        }
        return view('admin.transaksi.index', compact('transaksis', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = User::where('role', 'customer')->get();
        return view('admin.transaksi.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no_ref = rand(100_000_000, 200_000_000);
        $transaksi = new Transaksi();
        $transaksi->user_id = $request->user_id;
        $transaksi->tanggal = $request->tanggal;
        $transaksi->no_wa = $request->no_wa;
        $transaksi->alamat = $request->alamat;
        $transaksi->no_reference = $no_ref;
        $transaksi->status_bayar = $request->status_bayar;
        $transaksi->status_pengerjaan = $request->status_pengerjaan;
        $transaksi->grand_total = $request->grand_total;
        $transaksi->save();

        for ($i = 0; $i < count($request->id_paket); $i++) {
            PaketTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_paket' => $request->id_paket[$i],
                'berat' => $request->berat[$i],
                'subtotal' => $request->subtotal[$i],
                'estimasi' => $request->estimasi[$i],
            ]);
        }

        return redirect()->route('transaksi.index')->with('status', 'Transaksi Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        $customer = User::where('role', 'customer')->get();
        $paket = Paket::all();
        $total = 0;
        foreach ($transaksi->pakets as $value) {
            $total += $value->pivot->subtotal;
        }
        return view('admin.transaksi.edit', compact('transaksi', 'customer', 'paket', 'total'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        $transaksi->update([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
            'status_bayar' => $request->status_bayar,
            'status_pengerjaan' => $request->status_pengerjaan,
            'grand_total' => $request->grand_total,
        ]);
        if (!isset($request->id_paket)) {
            $transaksi->pakets()->detach();
            return redirect()->route('transaksi.index')->with('status', 'Transaksi Updated Successfully');
        }
        $data_1 = [];
        $data_2 = [];
        for ($i = 0; $i < count($transaksi->pakets); $i++) {
            $data_1[$i] = $transaksi->pakets[$i]->pivot->id_paket;
        }
        for ($i = 0; $i < count($request->id_paket); $i++) {
            $data_2[$i] = (int)$request->id_paket[$i];
        }
        if (count($transaksi->pakets) !== count($request->id_paket)) {
            $n = count($request->id_paket) - count($transaksi->pakets);
            if ($n < 0) {
                foreach ($transaksi->pakets as $value) {
                    for ($i = 0; $i < count($transaksi->pakets); $i++) {
                        try {
                            $in = array_diff($data_1, $data_2)[$i];
                            PaketTransaksi::where('id_paket', $in)->where('id_transaksi', $transaksi->id)->first()->delete();
                        } catch (\Throwable $th) {
                            continue;
                        }
                    }
                    for ($i = 0; $i < count($request->id_paket); $i++) {
                        PaketTransaksi::where('id_transaksi', $transaksi->id)->where('id_paket', $request->id_paket[$i])->update([
                            'id_transaksi' => $transaksi->id,
                            'id_paket' => $request->id_paket[$i],
                            'berat' => $request->berat[$i],
                            'subtotal' => $request->subtotal[$i],
                            'estimasi' => $request->estimasi[$i],
                        ]);
                    }
                }
            } else {
                for ($i = 0; $i < count($request->id_paket); $i++) {
                    try {
                        $in = array_diff($data_2, $data_1)[$i];
                        PaketTransaksi::create([
                            'id_transaksi' => $transaksi->id,
                            'id_paket' => $request->id_paket[$i],
                            'berat' => $request->berat[$i],
                            'subtotal' => $request->subtotal[$i],
                            'estimasi' => $request->estimasi[$i],
                        ]);
                    } catch (\Throwable $th) {
                        PaketTransaksi::where('id_transaksi', $transaksi->id)->where('id_paket', $request->id_paket[$i])->update([
                            'id_transaksi' => $transaksi->id,
                            'id_paket' => $request->id_paket[$i],
                            'berat' => $request->berat[$i],
                            'subtotal' => $request->subtotal[$i],
                            'estimasi' => $request->estimasi[$i],
                        ]);
                        continue;
                    }
                }
            }
        } else {
            for ($i = 0; $i < count($request->id_paket); $i++) {
                PaketTransaksi::where('id_transaksi', $transaksi->id)->where('id_paket', $request->id_paket[$i])->update([
                    'id_transaksi' => $transaksi->id,
                    'id_paket' => $request->id_paket[$i],
                    'berat' => $request->berat[$i],
                    'subtotal' => $request->subtotal[$i],
                    'estimasi' => $request->estimasi[$i],
                ]);
            }
        }

        return redirect()->route('transaksi.index')->with('status', 'Transaksi Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        $transaksi->pakets()->detach();
        $transaksi->delete();

        return redirect()->back()->with('status', 'Transaksi Deleted Successfully');
    }

    public function storeUser(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_wa' => $request->no_wa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'role' => $request->role
        ]);

        return redirect()->back()->with('status', 'User Added Successfully');
    }

    public function updateStatusBayar(Request $request, $id)
    {
        Transaksi::where('id', $id)->update([
            'status_bayar' => $request->status_bayar
        ]);

        return redirect()->back()->with('status', 'Status Bayar Updated Successfully');
    }

    public function updateStatusPengerjaan(Request $request, $id)
    {
        Transaksi::where('id', $id)->update([
            'status_pengerjaan' => $request->status_pengerjaan
        ]);

        return redirect()->back()->with('status', 'Status Pengerjaan Updated Successfully');
    }

    public function exportTransaksi($id)
    {
        $transaksi = Transaksi::where('id', $id)->first();
        $pdf = PDF::loadview('admin.export.struck-transaksi', ['transaksi' => $transaksi])->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}
