<?php

namespace Modules\Pengadaan\Tests\Unit;

use Tests\TestCase;
use App\Models\Core\User;
use Modules\Pengadaan\Entities\Document;

class AdminControllerTest extends TestCase
{
    public function test_index_displays_documents_successfully()
    {
        // Nonaktifkan middleware untuk tes ini
        $this->withoutMiddleware();

        // Menggunakan factory untuk membuat pengguna admin
        $admin = \database\factories\UserFactory::new()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        // Buat beberapa dokumen
        $documents = Document::factory()->count(3)->create();

        // Akses route index
        $response = $this->get(route('admin.index'));

        // Verifikasi status respons adalah 200
        $response->assertStatus(200);

        // Verifikasi bahwa view yang dikembalikan adalah yang benar
        $response->assertViewIs('pengadaan::admin.keloladokumen');

        // Verifikasi bahwa view menerima data documents
        $response->assertViewHas('documents', function ($docs) use ($documents) {
            return $documents->pluck('id')->toArray() === $docs->pluck('id')->toArray();
        });
    }
}

