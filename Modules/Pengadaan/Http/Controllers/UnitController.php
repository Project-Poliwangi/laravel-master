<?php

namespace Modules\Pengadaan\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Pengadaan\Entities\Pengadaan;
use Illuminate\Contracts\Support\Renderable;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 1;

        if (!empty($keyword)) {
            $pengadaan = Pengadaan::where('nomor_surat', 'LIKE', "%$keyword%")
                ->orWhere('jenis_pengadaan', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $pengadaan = Pengadaan::latest()->paginate($perPage);
        }

        return view('pengadaan::unit.permohonan', compact('pengadaan'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $formMode = 'create';
        return view('pengadaan::unit.create', compact('formMode'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'jenis_pengadaan' => 'required|in:barang,jasa,perbaikan,kegiatan,konstruksi',
            'total_biaya' => 'required|numeric|min:0',
            'dokumen_kak' => 'nullable|file|max:10240',
            'dokumen_hps' => 'nullable|file|max:10240',
            'dokumen_stock_opname' => 'nullable|file|max:10240',
            'dokumen_surat_ijin_impor' => 'nullable|file|max:10240',
            'status_id' => 'exists:status,id',
        ]);

        // Penanganan file yang diunggah - Dokumen KAK
        if ($request->hasFile('dokumen_kak')) {
            $file = $request->file('dokumen_kak');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('/assets/dokumen/dokumen_kak', $file_name, 'public');
            $validatedData['dokumen_kak'] = $file_name;
        }

        // Penanganan file yang diunggah - Dokumen HPS
        if ($request->hasFile('dokumen_hps')) {
            $file = $request->file('dokumen_hps');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('/assets/dokumen/dokumen_hps', $file_name, 'public');
            $validatedData['dokumen_hps'] = $file_name;
        }

        // Penanganan file yang diunggah - Dokumen Stock Opname
        if ($request->hasFile('dokumen_stock_opname')) {
            $file = $request->file('dokumen_stock_opname');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('/assets/dokumen/dokumen_stock_opname', $file_name, 'public');
            $validatedData['dokumen_stock_opname'] = $file_name;
        }

        // Penanganan file yang diunggah - Dokumen Surat Ijin Impor
        if ($request->hasFile('dokumen_surat_ijin_impor')) {
            $file = $request->file('dokumen_surat_ijin_impor');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('/assets/dokumen/dokumen_ijin_impor', $file_name, 'public');
            $validatedData['dokumen_surat_ijin_impor'] = $file_name;
        }

        Pengadaan::create($validatedData);

        return redirect('/unit/daftarpermohonan')->with('success', 'Permohonan Pengajuan Pengadaan berhasil ditambahkan.');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $pengadaan = Pengadaan::findOrFail($id);
        return view('pengadaan::unit.show', compact('pengadaan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $pengadaan = Pengadaan::findOrFail($id);
        $formMode = 'edit';

        return view('pengadaan::unit.edit', compact('pengadaan', 'formMode'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $Pengadaan = Pengadaan::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'jenis_pengadaan' => 'required|in:barang,jasa,perbaikan,kegiatan,konstruksi',
            'total_biaya' => 'required|numeric|min:0',
            'dokumen_kak' => 'nullable|file|max:10240', // Ukuran maksimal file 10MB
            'dokumen_hps' => 'nullable|file|max:10240',
            'dokumen_stock_opname' => 'nullable|file|max:10240',
            'dokumen_surat_ijin_impor' => 'nullable|file|max:10240',
        ]);

        // Proses upload file jika ada
        if ($request->hasFile('dokumen_kak')) {
            $file = $request->file('dokumen_kak');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('public/assets/dokumen/dokumen_kak', $file_name);
            $validatedData['dokumen_kak'] = $file_name;
        } else {
            $validatedData['dokumen_kak'] = $request->input('existing_dokumen_kak');
        }

        // Proses upload file jika ada
        if ($request->hasFile('dokumen_hps')) {
            $file = $request->file('dokumen_hps');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('public/assets/dokumen/dokumen_hps', $file_name);
            $validatedData['dokumen_hps'] = $file_name;
        } else {
            $validatedData['dokumen_hps'] = $request->input('existing_dokumen_hps');
        }

        // PProses upload file jika ada
        if ($request->hasFile('dokumen_stock_opname')) {
            $file = $request->file('dokumen_stock_opname');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('public/assets/dokumen/dokumen_stock_opname', $file_name);
            $validatedData['dokumen_stock_opname'] = $file_name;
        } else {
            $validatedData['dokumen_stock_opname'] = $request->input('existing_dokumen_so');
        }

        // Proses upload file jika ada
        if ($request->hasFile('dokumen_surat_ijin_impor')) {
            $file = $request->file('dokumen_surat_ijin_impor');
            $extension = $file->getClientOriginalExtension();
            $file_name = Str::random(20) . '.' . $extension;
            $file->storeAs('public/assets/dokumen/dokumen_ijin_impor', $file_name);
            $validatedData['dokumen_surat_ijin_impor'] = $file_name;
        } else {
            $validatedData['dokumen_surat_ijin_impor'] = $request->input('existing_dokumen_ijin_impor');
        }

        $Pengadaan->update($validatedData);

        return redirect('/unit/daftarpermohonan')->with('success_message', 'Permohonan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
        $pengadaan = Pengadaan::findOrFail($id);
        $pengadaan->delete();
        return redirect('/unit/daftarpermohonan')->with('success_message', 'Permohonan berhasil dihapus!');
    }

    public function daftarpermohonan(Request $request)
    {
        $keyword = $request->get('search');

        $perPage = 15;

        if (!empty($keyword)) {
            $pengadaan = Pengadaan::where('nomor_surat', 'like', '%' . $keyword . '%')
                ->orWhere('jenis_pengadaan', 'like', '%' . $keyword . '%')
                ->orWhere('total_biaya', 'like', '%' . $keyword . '%')
                ->orderBy('created_at', 'desc')
                ->latest()->paginate($perPage);
        } else {
            $pengadaan = Pengadaan::latest()->paginate($perPage);
        }

        return view('pengadaan::unit.permohonan', compact('pengadaan'));
    }

    public function permohonandiproses()
    {
        return view('pengadaan::unit.diproses');
    }

    public function permohonanselesai()
    {
        return view('pengadaan::unit.selesai');
    }

    public function templatedokumen()
    {
        return view('pengadaan::unit.template');
    }
}
