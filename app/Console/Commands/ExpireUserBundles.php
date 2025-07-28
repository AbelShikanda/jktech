<?php

namespace App\Console\Commands;

use App\Models\UserBundle;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireUserBundles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire bundles that have passed their end date';

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
        $expired = UserBundle::where('status', 'active')
            ->where('end_date', '<', Carbon::now())
            ->update(['status' => 'expired']);

        if ($expired > 0) {
            $this->info("✅ {$expired} user bundle(s) expired successfully.");
        } else {
            $this->warn('ℹ️ No bundles to expire at this time.');
        }

        return 0;
    }
}
