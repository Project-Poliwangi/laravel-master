<?php

namespace Modules\PeminjamanRuangan\Http\Controllers\Penjadwalan;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PeminjamanRuangan\Entities\JadwalKuliah;
use Modules\PeminjamanRuangan\Entities\MataKuliah;
use Modules\PeminjamanRuangan\Entities\Pegawai;
use Modules\PeminjamanRuangan\Entities\ProgramStudi;
use Modules\PeminjamanRuangan\Entities\Ruang;

class PenjadwalanController extends Controller
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

        $query = JadwalKuliah::query();

        if($request->has('search')) {
            $query = $query->whereHas('mataKuliah', function($q) use ($request) {
                $q->where('kode', 'like', '%'.$request->search.'%');
                $q->orWhere('nama', 'like', '%'.$request->search.'%');
            });
            $query = $query->whereHas('programStudi', function($q) use ($request) {
                $q->orWhere('nama', 'like', '%'.$request->search.'%');
            });
            $query = $query->orWhere('hari', 'like', '%'.$request->search.'%');
            $query = $query->orWhere('kelas', 'like', '%'.$request->search.'%');
        }

        $dataPenjadwalan = $query->paginate($show);

        $data = [
            'title' => 'Penjadwalan Pengguna',
            'data' => $dataPenjadwalan,
            'show' => $show,
            'search' => $request->search,
            'paginate' => $query->paginate($show)
        ];

        return view('peminjamanruangan::penjadwalan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Penjadwalan',
            'matakuliahs' => MataKuliah::all(),
            'programStudis' => ProgramStudi::all(),
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all(),
            'action' => route('penjadwalan.store')
        ];

        return view('peminjamanruangan::penjadwalan.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required',
            'semester' => 'required',
            'kelas' => 'required',
            'program_studi_id' => 'required',
            'dosen_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang_id' => 'required',
        ], [
            'mata_kuliah_id.required' => 'Mata Kuliah wajib diisi',
            'semester.required' => 'Semester wajib diisi',
            'kelas.required' => 'Kelas wajib diisi',
            'program_studi_id.required' => 'Program Studi wajib diisi',
            'dosen_id.required' => 'Dosen wajib diisi',
            'hari.required' => 'Hari wajib diisi',
            'jam_mulai.required' => 'Jam Mulai wajib diisi',
            'jam_selesai.required' => 'Jam Selesai wajib diisi',
            'ruang_id.required' => 'Ruang wajib diisi',
        ]);

        try {
            JadwalKuliah::create($request->only(['mata_kuliah_id', 'semester', 'kelas', 'program_studi_id', 'dosen_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruang_id', 'description']));
            return redirect()->route('penjadwalan')->with('success', 'Data penjadwalan berhasil disimpan');
        } catch(Exception $e) {
            echo response()->json($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(JadwalKuliah $jadwalKuliah)
    {
        $data = [
            'title' => 'Ubah Penjadwalan',
            'matakuliahs' => MataKuliah::all(),
            'programStudis' => ProgramStudi::all(),
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all(),
            'action' => route('penjadwalan.update', $jadwalKuliah->id),
            'data' => $jadwalKuliah
        ];

        return view('peminjamanruangan::penjadwalan.form', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, JadwalKuliah $jadwalKuliah)
    {
        $request->validate([
            'mata_kuliah_id' => 'required',
            'semester' => 'required',
            'kelas' => 'required',
            'program_studi_id' => 'required',
            'dosen_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang_id' => 'required',
        ], [
            'mata_kuliah_id.required' => 'Mata Kuliah wajib diisi',
            'semester.required' => 'Semester wajib diisi',
            'kelas.required' => 'Kelas wajib diisi',
            'program_studi_id.required' => 'Program Studi wajib diisi',
            'dosen_id.required' => 'Dosen wajib diisi',
            'hari.required' => 'Hari wajib diisi',
            'jam_mulai.required' => 'Jam Mulai wajib diisi',
            'jam_selesai.required' => 'Jam Selesai wajib diisi',
            'ruang_id.required' => 'Ruang wajib diisi',
        ]);

        try {
            $jadwalKuliah->update($request->only(['mata_kuliah_id', 'semester', 'kelas', 'program_studi_id', 'dosen_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruang_id', 'description']));
            return redirect()->route('penjadwalan')->with('success', 'Data penjadwalan berhasil disimpan');
        } catch(Exception $e) {
            echo response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(JadwalKuliah $jadwalKuliah)
    {
        try {
            $jadwalKuliah->delete();
            return redirect()->route('penjadwalan')->with('success', 'Data penjadwalan berhasil dihapus');
        } catch(Exception $e) {
            echo response()->json($e->getMessage());
        }
    }

    public function sync()
    {
        try {
            init_set('max_execution_time', 10000);
            $client = new Client([
                'verify' => false
            ]);

            // get pegawai
            $response = $client->request('GET', 'https://sit.poliwangi.ac.id/v2/api/v1/sitapi/pegawai?filter[staff]=4&paginate=false', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '. env('SIT_TOKEN')
                ],
            ]);

            if($response->getStatusCode() == 200) {
                $data = [];
                $items = json_decode($response->getBody()->getContents(), true);

                foreach($items as $item) {
                    $data[] = [
                        'NIK' => null,
                        'tanggal_lahir' => null,
                        'nama' => $item['gelar_dpn'] . ' ' . $item['nama'] . ' ' . $item['gelar_blk'],
                        'nomor_induk' => $item['nip'],
                        'status' => null,
                        'telepon' => null,
                        'alamat' => null,
                        'email' => null,
                        'unit_id' => null,
                        'KK' => null,
                        'NPWP' => null,
                        'jenis' => $item['staff'] == 4 ? 'Dosen' : 'Tendik',
                        'user_id' => null,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                Pegawai::insert($data);
            }


        } catch(Exception $e) {
            echo response()->json($e->getMessage());
        }
    }
}
