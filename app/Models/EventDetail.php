<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = "event_detail_table";
    protected $casts = [
        'event_detail_id' => 'integer',
        'event_id' => 'integer',
        'register_open_date' => 'date',
        'register_closed_date' => 'date',
        'register_status' => 'boolean',
        'total_participant' => 'integer',
        'date' => 'datetime',
        'event_handler' => 'integer',
        'cost' => 'integer',
        'total_income' => 'integer',
        'paid_status' => 'boolean',
    ];
    protected $primaryKey = "event_detail_id";
    protected $fillable = [
        "event_id",
        "event_description",
        "event_address",
        "event_speaker",
        "register_open_date",
        "register_closed_date",
        "register_status",
        "total_participant",
        "event_handler",
        "cost",
        "paid_status"
    ];

    public function event()
    {
        return $this->belongsTo(UserModel::class, 'event_id', 'event_id');
    }
}
