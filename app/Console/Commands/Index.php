<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Index extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:file {doc_id} {tokens*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a text file which contains an unique Id and one or several tokens';

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
     * @return string
     */
    public function handle()
    {
        $docId = $this->argument('doc_id');
        $tokens = $this->argument('tokens');
        // check if index is a number & positive
        if (!is_numeric($docId) || $docId <= 0) {
            echo 'Index error: Index must be a positive number';
            return false;
        }
        // check if token(s) are alphanumeric
        foreach ($tokens as $token) {
            if (!ctype_alnum($token)) {
                echo 'Token Error: Token must be alphanumeric';
                return false;
            }
        }
        // name of the file which will be created
        $file = 'Index' . $docId . '.txt';
        // convert array of tokens into string with space between them
        $stringTokens = implode(' ', $tokens);
        // content of the file
        $content = $docId . ' ' . $stringTokens;
        //Store the file inside storage folder
        Storage::put($file, $content);
        //response
        echo 'index ok ' . $docId;
        return true;
    }
}
