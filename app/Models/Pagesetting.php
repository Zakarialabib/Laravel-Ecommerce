<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagesetting extends Model
{
    public $table = 'pagesettings';

    protected $fillable = [
        'contact_email','street','phone','email',
        'home','blog','faq','contact','category','arrival_section',
        'our_services','blog','popular_products','slider','flash_deal',
        'deal_of_the_day','best_sellers','brands','top_big_trending','top_brand',
        'section'
    ];

    public $timestamps = false;

    public function upload($name,$file,$oldname)
    {
        $file->move('assets/images',$name);
        if($oldname != null)
        {
            if (file_exists(public_path().'/assets/images/'.$oldname)) {
                unlink(public_path().'/assets/images/'.$oldname);
            }
        }
    }

}
