<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Quiz extends Model
{
    use HasFactory;
    use sluggable;
    
    protected $fillable=['title', 'description', 'status', 'finished_at', 'slug'];

    protected $dated = ['finished_at'];

    public function getFinishedAtAttribute($date){
        return $date ? Carbon::parse($date) : null;
    }

    public function questions(){
        return $this->hasMany('App\Models\Question');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                 'onUpdate' => true,
                'source' => 'title'
            ]
        ];
    }
}
