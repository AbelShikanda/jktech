<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateBlade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blade:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update content in a Blade file';

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
        // Define all the file groups
        $fileGroups = [
            'viewFiles' => [
                'files' => [
                    resource_path('views/pages/portfolio.blade.php'),
                    resource_path('views/admin/portfolio/show.blade.php'),
                    resource_path('views/admin/portfolio/edit.blade.php'),
                ],
                'search' => 'storage/',
                'replace' => 'storage/app/public/',
            ],
            // 'adminFiles' => [
            //     'files' => [
            //         resource_path('views/admin/portfolio/show.blade.php'),
            //     ],
            //     'search' => 'storage/img/blogs/',
            //     'replace' => 'storage/app/public/img/blogs/',
            // ],
            // 'controllerFiles' => [
            //     'files' => [
            //         app_path('Http/Controllers/PagesController.php'),
            //     ],
            //     'search' => ['storage/img/products/', 'storage/img/blogs/'],
            //     'replace' => ['storage/app/public/img/products/', 'storage/app/public/img/blogs/'],
            // ],
        ];

        // Process each file group
        foreach ($fileGroups as $groupName => $data) {
            $this->info("Processing $groupName...");
            $this->processFiles($data['files'], $data['search'], $data['replace']);
        }

        $this->info('All files processed successfully.');
        return 0;
    }

    private function processFiles(array $files, $search, $replace)
    {
        foreach ($files as $filePath) {
            if (File::exists($filePath)) {
                $content = File::get($filePath);

                // Check if there's anything to replace
                if (strpos($content, is_array($search) ? $search[0] : $search) !== false) {
                    $updatedContent = str_replace($search, $replace, $content);
                    File::put($filePath, $updatedContent);
                    $this->info("Updated: $filePath");
                } else {
                    $this->warn("No matches found in: $filePath");
                }
            } else {
                $this->warn("File does not exist: $filePath");
            }
        }
    }
}
