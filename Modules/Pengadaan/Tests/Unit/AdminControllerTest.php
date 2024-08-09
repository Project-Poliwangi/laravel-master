<?php

namespace Modules\Pengadaan\Tests\Unit;

use Tests\TestCase;
use Modules\Pengadaan\Entities\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class AdminControllerTest extends TestCase
{
    // Metode setUp untuk menginisialisasi pengaturan
    protected function setUp(): void
    {
        parent::setUp();
    }
    /** @test */
    public function it_displays_paginated_documents_on_index()
{
    // Membuat beberapa dokumen menggunakan factory
    $documents = \Modules\Pengadaan\Entities\Document::factory()->create();

    // Memanggil route index
    $response = $this->get(route('admin.index'));

    // Memastikan status respons 200 (berhasil)
    $response->assertStatus(200);

    // Memastikan bahwa view memiliki dokumen yang sama seperti yang kita buat
    $response->assertViewHas('documents', function ($docs) use ($documents) {
        return $docs->pluck('id')->contains($documents->first()->id);
    });    
}

    /** @test */
    public function it_shows_a_valid_document()
    {
        // Setup storage fake
        Storage::fake('public');

        // Buat satu dokumen dengan file valid
        $document = Document::factory()->create([
            'file' => UploadedFile::fake()->create('valid_document.docx')->name,
        ]);

        // Panggil route show
        $response = $this->get(route('admin.show', $document->id));

        // Pastikan file ditampilkan
        $response->assertStatus(200);
    }

    /** @test */
    public function it_aborts_if_invalid_file_type_in_show()
    {
        // Buat satu dokumen dengan file yang tidak valid
        $document = Document::factory()->create([
            'file' => 'invalid_document.pdf',
        ]);

        // Panggil route show dan pastikan 404
        $response = $this->get(route('admin.show', $document->id));

        $response->assertStatus(404);
    }

    /** @test */
    public function it_edits_a_document()
    {
        // Buat satu dokumen
        $document = Document::factory()->create();

        // Panggil route edit
        $response = $this->get(route('admin.edit', $document->id));

        // Pastikan status respons 200
        $response->assertStatus(200);

        // Pastikan view berisi dokumen yang benar
        $response->assertViewHas('documents', $document);
    }

    /** @test */
    public function it_updates_a_document_successfully()
    {
        // Setup storage fake
        Storage::fake('public');

        // Buat satu dokumen
        $document = Document::factory()->create();

        // Data baru untuk diupdate
        $newData = [
            'nama_dokumen' => 'Dokumen Update',
            'deskripsi' => 'Deskripsi Update',
            'file' => UploadedFile::fake()->create('updated_file.docx'),
        ];

        // Panggil route update dengan data baru
        $response = $this->put(route('admin.update', $document->id), $newData);

        // Pastikan redirect sukses
        $response->assertStatus(302);

        // Pastikan data sudah diupdate di database
        $this->assertDatabaseHas('documents', [
            'id' => $document->id,
            'nama_dokumen' => 'Dokumen Update',
            'deskripsi' => 'Deskripsi Update',
            'file' => 'updated_file.docx',
        ]);
    }
}
