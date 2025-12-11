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

        // if ($request->registered_id == $request->scannedEventId) {
        //     $eventId = $request->event_id;
        //     $registeredId = $request->registered_id;
        // }
        $eventScanId = $request->event_id;
        $registeredScanId = $request->registered_id;

        $registered = Registered::where('registered_id', $registeredScanId)
            ->where('event_id', $eventScanId)
            ->first();

        if (!$registered) {
            return response()->json([
                'success' => false,
                'message' => 'QR tidak valid untuk event ini.'
            ]);
        }
        if (Participant::where('registered_id', $registered->registered_id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Peserta sudah melakukan absensi.'
            ]);
        }
        Participant::create(['event_id'->$eventScanId,'registered_id'->$registeredScanId]);
        return response()->json([
                'success' => false,
                'message' => 'Absensi Berhasil.'
            ]);
    }
}