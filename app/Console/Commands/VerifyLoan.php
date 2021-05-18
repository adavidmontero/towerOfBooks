<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Copy;
use App\Models\Loan;
use Carbon\Carbon;

class VerifyLoan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:loan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificar fecha para actualizar estado del ejemplar';

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
        $loans = Loan::all()->filter(function($loan) {
            return $loan->devolution_date === null;
        });

        foreach ($loans as $loan) {
            if ($loan->limit_date < Carbon::now()->toDateString()) {
                Copy::findOrFail($loan->copy_id)->update([
                    'state' => 'Retrasado'
                ]);
            }
        }
    }
}
