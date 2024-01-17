<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name','type_id', 'slug', 'url','language','created', 'updated', 'commits','image'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function type(){
        return $this->belongsTo(types::class);
    }
    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
}
