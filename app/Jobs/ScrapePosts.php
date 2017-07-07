<?php

namespace App\Jobs;

use App\User;
use App\Post;
use App\Site;
use App\Page;
use App\Category;
use Goutte;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ScrapePosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $page;
    public $crawler;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $page = $this->page;

        $crawler = Goutte::request('GET', $page->link);

        $crawler->filter('article.post')->each(function($node) use(&$page){
            $title  = $node->filter('h2.title')->first()->text();
            $link   = $node->filter('h2.title a')->first()->attr('href');
            $author = $node->filter('.post-meta .author .fn a')->first()->text();
            $author_link = $node->filter('.post-meta .author .fn a')->first()->attr('href');
            $published_on = $node->filter('.published')->first()->text();
            $author = $node->filter('.post-meta .author .fn a')->first()->text();
            $excerpt = $node->filter('section.entry p')->first()->text();
            $comment_count = $node->filter('.comments a')->first()->text();

            $category_ids = [];
            $category_ids[] = $page->category->id;
            
            $node->filter('.categories a')->each(function($n) use(&$category_ids, &$page){
               
                $link = $n->attr('href');
                $name = $n->text();
            
                if(!(Category::where('link', $link)->count()))
                {
                    $category = new Category;
                    $category->site_id = $page->category->site_id;
                    $category->name = $name;
                    $category->link = $link;
                    $category->page_count = 0;
                    $category->pagination_pattern='';
                    $category->save();

                    $category_ids[] = $category->id;
                }
                else
                {
                    $category = Category::where('link', $link)->first();
                    $categoty_ids[] = $category->id;
                }
            });

            if(!(Post::where('link', $link)->count()))
            {
                $post = new Post;
                $post->title = $title;
                $post->link = $link;
                $post->author = $author;
                $post->author_link = $author_link;
                $post->published_on = $published_on;
                $post->comment_count = $comment_count;
                $post->like_count = 0;
                $post->excerpt = $excerpt;
                $post->save();
            }
            else
            {
                $post = Post::where('link', $link)->first();
            }
            

            $post->categories()->attach($category_ids);

            echo "post created!!!";
        });

        Page::find($this->page->id)->update(['processed' => true]);
    }
}
