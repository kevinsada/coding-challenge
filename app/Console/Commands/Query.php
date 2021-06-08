<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Query extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:query {token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The query command';

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
     * @return bool
     */
    public function handle()
    {
        $token = $this->argument('token');
        // get all files inside storage
        $files = Storage::files();
        $indexes = [];
        foreach ($files as $file) {
            $filePath = Storage::path($file);
            $content = file_get_contents($filePath);
            // get only token(s) without index
            $tokens = substr(strstr($content, ' '), 1);
            // the query: search with given argument inside tokens
            if (strpos($tokens, $token) !== false) {
                // get index
                $index = explode(' ', trim($content))[0];
                $indexes[] = $index;
            }
        }
        // if no results found
        if (empty($indexes)) {
            echo 'query error: no results found';
            return true;
        }
        // if results found print doc-id with it's index
        foreach ($indexes as $index) {
            echo 'doc-id' . $index . ' ';
        }
    }
}
