<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDetail;
use Carbon\Carbon;
use App\Models\Registered;
use Illuminate\Support\Facades\DB;
use App\Models\Participant;

class AttendanceController extends Controller
{
    public function scan(Request $request)
    {
        $request->validate([
            'event_id' => 'required|integer',
            'registered_id' => 'required|integer',
        ]);

        $eventId = $request->event_id;
        $registeredId = $request->registered_id;
        $sessionId = $request->session_id;
        // if ($request->registered_id == $request->scannedEventId) {
        //     $eventId = $request->event_id;
        //     $registeredId = $request->registered_id;
        // }
        // cek apakah QR valid
        $registered = Registered::where('registered_id', $registeredId)
            ->where('event_id', $eventId)
            ->first();

        if (!$registered) {
            return response()->json([
                'success' => false,
                'message' => 'QR tidak valid untuk event ini.'
            ], 400);
        }

        // cek apakah sudah absen
        $already = Participant::where('registered_id', $registeredId)
            ->where('event_id', $eventId)
            ->where('session_id', $sessionId)
            ->exists();
        if ($already) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta sudah absen untuk sesi ini.'
            ]);
        }
        // insert absensi
        Participant::create([
            'event_id' => $eventId,
            'session_id' => $sessionId,
            'registered_id' => $registeredId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil.'
        ]);
    }

}