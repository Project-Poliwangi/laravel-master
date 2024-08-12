<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Pengadaan\Entities\Pengadaan;

class UpdatePengadaanStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pengadaan:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update pengadaan status based on rencana_mulai';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pengadaans = Pengadaan::with('subPerencanaan')->get();
        foreach ($pengadaans as $pengadaan) {
            $pengadaan->checkAndUpdateStatus();
        }

        $this->info('Pengadaan statuses have been updated.');
    }
}
