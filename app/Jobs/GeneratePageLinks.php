<?php

namespace App\Jobs;

use App\User;
use App\Post;
use App\Site;
use App\Page;
use App\Category;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GeneratePageLinks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $category;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!(Page::where('link', $this->category->link)->count()))
        {
            $page = Page::create([
                'link'          => $this->category->link,
                'processed'     => false,
                'category_id'   => $this->category->id,
            ]);
        }
        

        for($i = 2; $i <= $this->category->page_count; $i++)
        {
            if(!(Page::where('link', $this->category->pagination_pattern.$i)->count()))
            {
                $page = Page::create([
                    'link'          => $this->category->pagination_pattern.$i,
                    'processed'     => false,
                    'category_id'   => $this->category->id,
                ]);
            }
        }

        echo "Pages created for ".$this->category->name;
    }
}
