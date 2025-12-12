<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{   
    public $timestamps = false;
    protected  $table = "event_table";
    protected $primaryKey = "event_id";
    protected $casts = [
    'event_id' => 'integer',
];

    protected $fillable = [
        "event_name",
        "event_status",
    ];

    public function eventDetail(){
        return $this->hasOne(EventDetail::class,'event_id','event_id');
    }
    public function participant(){
        return $this->hasMany(Participant::class,'event_id','event_id');
    }
}