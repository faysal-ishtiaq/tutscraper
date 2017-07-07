<?php

namespace App\Console\Commands;

use App\Jobs\ScrapePosts;
use Illuminate\Console\Command;

class ProcessPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape posts from unprocessed pages.';

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
     * @return mixed
     */
    public function handle()
    {
        $pages = \App\Page::where('processed', false)->get();

        foreach($pages as $page)
        {
            dispatch(new ScrapePosts($page));
        }
    }
}
