<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_id', 'name', 'link', 'page_count','pagination_pattern'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function site()
    {
        return $this->belongsTo('App\Site');
    }


    public function pages()
    {
        return $this->hasMany('App\Page');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
