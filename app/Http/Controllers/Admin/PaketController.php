<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pakets = Paket::all();
        return view('admin.paket.index', compact('pakets'));
    }

    public function allPaket()
    {
        $data = Paket::where('is_active', 'aktif')->get();
        
        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required',
            'estimasi' => 'required',
        ]);

        Paket::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'estimasi' => $request->estimasi,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('paket.index')->with('status', 'Paket Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paket = Paket::where('id', $id)->first();
        $tgl1 = date_format(now(), 'Y-m-d'); // pendefinisian tanggal awal
        $tgl2 = date('Y-m-d', strtotime('+' . $paket->estimasi . ' days', strtotime($tgl1)));
        return response()->json([
            'harga' => $paket->harga,
            'estimasi' => $tgl2,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paket = Paket::where('id', $id)->first();
        return view('admin.paket.edit', compact('paket'));
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required',
            'estimasi' => 'required',
        ]);

        Paket::where('id', $id)->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'estimasi' => $request->estimasi,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('paket.index')->with('status', 'Paket Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Paket::where('id', $id)->delete();

        return redirect()->route('paket.index')->with('status', 'Paket Deleted Successfully');
    }

    public function updateIsActive($id)
    {
        $paket = Paket::where('id', $id)->first();
        if ($paket->is_active === 'aktif') {
            $paket->update([
                'is_active' => 'tidak aktif'
            ]);
        } else {
            $paket->update([
                'is_active' => 'aktif'
            ]);
        }

        return redirect()->back()->with('status', 'Is Active Updated Successfully');
    }
}
