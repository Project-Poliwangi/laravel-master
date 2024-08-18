<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\KelolaRuangan;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\PeminjamanRuangan\Entities\Gedung;
use Modules\PeminjamanRuangan\Entities\Ruang;

class KelolaRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $show = 10;
        if($request->has('show')) {
            $show = $request->show;
        }

        $query = Ruang::query();

        if($request->has('search')) {
            $query = $query->where('kode_bmn', 'like', '%'.$request->search.'%');
            $query = $query->orWhere('nama', 'like', '%'.$request->search.'%');
            $query = $query->orWhereHas('gedung', function($q) use ($request) {
                $q->where('kode', 'like', '%'.$request->search.'%');
                $q->orWhere('nama', 'like', '%'.$request->search.'%');
            });
        }

        $dataRuangan = $query->paginate($show);

        $data = [
            'title' => 'Data Ruangan',
            'data' => $dataRuangan,
            'show' => $show,
            'search' => $request->search,
            'paginate' => $query->paginate($show)
        ];

        return view('peminjamanruangan::kelola-ruangan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Ruangan',
            'action' => route('ruang.store'),
            'gedungs' => Gedung::all()
        ];

        return view('peminjamanruangan::kelola-ruangan.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'gedung_id' => 'required',
            'kode_bmn' => 'required',
            'kode_qr' => 'required',
            'nama' => 'required',
            'luas' => 'required|integer',
            'kapasitas' => 'required|integer',
            'lantai' => 'required|integer',
            'file' => 'required|max:1024|mimes:jpeg,jpg,png,heic,webp',
            'jenis' => 'required',
        ], [
            'gedung_id.required' => 'Gedung wajib diisi',
            'kode_bmn.required' => 'Kode BMN wajib diisi',
            'kode_qr.required' => 'Kode QR wajib diisi',
            'nama.required' => 'Nama wajib diisi',
            'luas.required' => 'Luas wajib diisi',
            'luas.integer' => 'Luas harus berupa angka',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kapasitas.integer' => 'Kapasitas harus berupa angka',
            'lantai.required' => 'Lantai wajib diisi',
            'lantai.integer' => 'Lantai harus berupa angka',
            'file.required' => 'Foto ruangan wajib diisi',
            'file.mimes' => 'Foto ruangan berupa salah satu dari jenis: jpg, jpeg, png, webp, heic',
            'file.max' => 'Foto ruangan tidak boleh lebih dari 1 MB'
        ]);

        try {
            DB::beginTransaction();
            if($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = 'Ruang_'. rand(0, 999999999999) .'.'. $file->getClientOriginalExtension();
                $file->move(public_path('storage/images/ruangs/'), $filename);
            }

            $request->merge(['foto' => $filename]);
            Ruang::create($request->only(['gedung_id', 'kode_bmn', 'kode_qr', 'nama', 'luas', 'kapasitas', 'lantai', 'foto', 'jenis']));
            DB::commit();

            return redirect()->route('ruang')->with('success', 'Data ruangan berhasil disimpan.');
        } catch(Exception $e) {
            // abort(500);
            echo response()->json($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Ruang $ruang)
    {
        $data = [
            'title' => 'Ubah Ruangan',
            'action' => route('ruang.update', $ruang->id),
            'ruang' => $ruang,
            'gedungs' => Gedung::all()
        ];

        return view('peminjamanruangan::kelola-ruangan.form', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'gedung_id' => 'required',
            'kode_bmn' => 'required',
            'kode_qr' => 'required',
            'nama' => 'required',
            'luas' => 'required|integer',
            'kapasitas' => 'required|integer',
            'lantai' => 'required|integer',
            'file' => '|max:1024|mimes:jpeg,jpg,png,heic,webp',
            'jenis' => 'required',
        ], [
            'gedung_id.required' => 'Gedung wajib diisi',
            'kode_bmn.required' => 'Kode BMN wajib diisi',
            'kode_qr.required' => 'Kode QR wajib diisi',
            'nama.required' => 'Nama wajib diisi',
            'luas.required' => 'Luas wajib diisi',
            'luas.integer' => 'Luas harus berupa angka',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kapasitas.integer' => 'Kapasitas harus berupa angka',
            'lantai.required' => 'Lantai wajib diisi',
            'lantai.integer' => 'Lantai harus berupa angka',
            'file.required' => 'Foto ruangan wajib diisi',
            'file.mimes' => 'Foto ruangan berupa salah satu dari jenis: jpg, jpeg, png, webp, heic',
            'file.max' => 'Foto ruangan tidak boleh lebih dari 1 MB'
        ]);

        try {
            DB::beginTransaction();
            if($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = 'Ruang_'. rand(0, 999999999999) .'.'. $file->getClientOriginalExtension();
                $file->move(public_path('storage/images/ruangs/'), $filename);

                if(file_exists(public_path('storage/images/ruangs/'. $ruang->foto))) {
                    File::delete(public_path('storage/images/ruangs/'. $ruang->foto));
                }
            } else {
                $filename = $ruang->foto;
            }

            $request->merge(['foto' => $filename]);
            $ruang->update($request->only(['gedung_id', 'kode_bmn', 'kode_qr', 'nama', 'luas', 'kapasitas', 'lantai', 'foto', 'jenis']));
            DB::commit();

            return redirect()->route('ruang')->with('success', 'Data ruangan berhasil disimpan.');
        } catch(Exception $e) {
            abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Ruang $ruang)
    {
        try {
            $ruang->delete();

            return redirect()->route('ruang')->with('success', 'Data ruangan berhasil dihapus.');
        } catch(Exception $e) {
            abort(500);
        }
    }

    public function sync()
    {
        try {
            $client = new Client([
                'verify' => false
            ]);
            $response = $client->request('GET', 'https://sit.poliwangi.ac.id/v2/api/v1/sitapi/ruang?paginate=false', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '. env('SIT_TOKEN')
                ],
            ]);

            if($response->getStatusCode() == 200) {
                $items = json_decode($response->getBody()->getContents(), true)['data'];
                $data = [];
    
                foreach($items as $item) {
                    // check dalam db apakah sudah ada data gedung yang sama
                    $check = Ruang::where('nama', $item['keterangan'])->count();
                    // check dalam array data apakah ada data yang sama
                    $exists = array_filter($data, function($data) use ($item) {
                        return $data['nama'] == $item['ruang'];
                    });

                    if($check == 0 && empty($exists)) {
                        // check gedung di database
                        $gedung = Gedung::whereNama($item['ruang'])->first();

                        // check jika gedung belum ada maka tambahkan gedung terlebih dahulu
                        if(is_null($gedung)) {
                            $gedung = Gedung::create([
                                'nama' => $item['ruang'],
                            ]);
                        }
                        
                        // simpan data ruang ke dalam array
                        $data[] = [
                            'gedung_id' => $gedung->id,
                            'kode_bmn' => $item['kode_ruang'],
                            'kode_qr' => $item['nomor'],
                            'nama' => $item['keterangan'],
                            'luas' => 0,
                            'kapasitas' => 0,
                            'lantai' => null,
                            'foto' => null,
                            'jenis' => null,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }
                }

                // check jika jumlah data lebih dari 0 maka tambahkan ke database
                if(count($data) > 0) {
                    Ruang::insert($data);
                }
            }

            return redirect()->back()->with('success', 'Berhasil memperbarui data.');
        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function printPdf()
    {
        $ruangs = Ruang::all();
        $pdf = Pdf::loadView('peminjamanruangan::kelola-ruangan.pdf.print', compact('ruangs'))->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->stream();
    }
}
