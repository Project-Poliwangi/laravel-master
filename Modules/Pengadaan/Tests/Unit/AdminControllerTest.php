<?php

namespace Modules\Pengadaan\Tests\Unit;

use Tests\TestCase;
use Modules\Pengadaan\Entities\Document;
use App\Models\Core\User;

class AdminControllerTest extends TestCase
{
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // Membuat user admin untuk pengujian
        $this->admin = User::factory()->create([
            'role_aktif' => 'admin',
        ]);

        // Tambahkan izin jika diperlukan oleh middleware 'permission'
        $this->admin->givePermissionTo('admin.index');
    }

    public function test_index_displays_documents_successfully()
    {
        // Autentikasi sebagai admin
        $this->actingAs($this->admin);

        // Membuat beberapa dokumen untuk pengujian
        $documents = Document::factory()->count(3)->create();

        // Akses route index admin
        $response = $this->get(route('admin.index'));

        // Verifikasi status respons adalah 200
        $response->assertStatus(200);

        // Verifikasi view yang dikembalikan
        $response->assertViewIs('pengadaan::admin.keloladokumen');

        // Verifikasi data dokumen ada di view
        // $response->assertViewHas('documents', function ($docs) use ($documents) {
        //     return $documents->pluck('id')->toArray() === $docs->pluck('id')->toArray();
        // });
    }

    // public function test_index_displays_documents_successfully()
    // {
    //     // Autentikasi sebagai admin
    //     $this->actingAs($this->admin);

    //     // Membuat beberapa dokumen untuk pengujian
    //     $documents = Document::factory()->count(3)->create();

    //     // Akses route index admin
    //     $response = $this->get(route('admin.index'));

    //     // Verifikasi status respons adalah 200
    //     $response->assertStatus(200);

    //     // Verifikasi view yang dikembalikan
    //     $response->assertViewIs('pengadaan::admin.keloladokumen');

    //     // Debugging: Lihat isi dari dokumen yang dioper ke view
    //     $response->assertViewHas('documents', function ($docs) use ($documents) {
    //         // Debug: Lihat data yang ada
    //         // dd($docs, $documents);

    //         return $documents->pluck('id')->toArray() === $docs->pluck('id')->toArray();
    //     });
    // }
}
