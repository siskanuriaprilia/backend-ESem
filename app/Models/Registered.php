<?php
namespace App\Models;

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;

class Registered extends Model
{
    public $timestamps = false;
    protected $table = "registered_table";
    protected $casts = [
        'registered_id' => 'integer',
        'event_id' => 'integer',
        'payment_status' => 'boolean',
    ];

    protected $primaryKey = "registered_id";

    protected $fillable = [
        "event_id",
        "registered_name",
        "registered_email",
        "registered_phone",
        "payment_status",
    ];

    public function participant()
    {
        return $this->hasMany(Participant::class, 'registered_id', 'registered_id');
    }
}