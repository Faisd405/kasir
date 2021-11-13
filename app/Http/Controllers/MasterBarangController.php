<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;

class MasterBarangController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $barang = Barang::all();
        return view('MasterBarang.index', compact('barang'));
    }

    public function create()
    {
        return view('MasterBarang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_satuan' => 'required',
        ]);
        Barang::create([
            'nama_barang' => $request['nama_barang'],
            'harga_satuan' => $request['harga_satuan'],
        ]);
        return redirect('/barang');
    }

    public function show($id)
    {
        $barang = Barang::find($id);
        return view('MasterBarang.show', compact('barang'));
    }
    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('MasterBarang.edit', compact('barang'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_satuan' => 'required',
        ]);

        $barang = barang::find($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_satuan = $request->harga_satuan;
        $barang->update();
        return redirect('/barang');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return redirect('/barang');
    }
}
