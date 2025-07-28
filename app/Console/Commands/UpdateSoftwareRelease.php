<?php

namespace App\Console\Commands;

use App\Models\Software;
use Illuminate\Console\Command;

class UpdateSoftwareRelease extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'software:sync {name} {--platform=} {--release=} {--url=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update or add a release to a software by name, platform, release and URL';

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
        $name = $this->argument('name');
        $platforms = array_map('trim', explode(',', $this->option('platform')));
        $releases = explode(',', $this->option('release'));
        $urls = explode(',', $this->option('url'));

        if (count($platforms) !== count($releases) || count($platforms) !== count($urls)) {
            $this->error('Each platform must have a matching release and URL.');
            return 1;
        }

        $software = Software::where('name', $name)->first();

        if (!$software) {
            $this->error("Software '{$name}' not found.");
            return 1;
        }

        foreach ($platforms as $index => $platform) {
            $version = $releases[$index];
            $url = $urls[$index];

            $existingRelease = $software->releases()->where('os', $platform)->first();

            if ($existingRelease) {
                $existingRelease->update([
                    'version' => $version,
                    'download_url' => $url,
                ]);
                $this->info("Updated {$platform} to version {$version}.");
            } else {
                $software->releases()->create([
                    'os' => $platform,
                    'version' => $version,
                    'download_url' => $url,
                ]);
                $this->info("Created new release for {$platform} v{$version}.");
            }
        }

        return 0;
    }
}
