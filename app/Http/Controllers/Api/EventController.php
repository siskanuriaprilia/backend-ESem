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
use App\Http\Controllers\Api\ValidationException;

class EventController extends Controller
{
    public function getEvent(Request $request)
    {
        $comingSoonEvent = Event::with('eventDetail')->where('event_status', 'Coming Soon')->get();
        $openRegisterEvent = Event::with(relations: 'eventDetail')->where('event_status', 'Open Register')->get();
        $recentEvent = Event::with('eventDetail')->where('event_status', 'Ended')->get();
        $activeEvent = Event::with('eventDetail')->where('event_status', 'On Going')->get();
        $allCollections = [
            'comingSoonEvent' => $comingSoonEvent,
            'openRegisterEvent' => $openRegisterEvent,
            'recentEvent' => $recentEvent,
            'activeEvent' => $activeEvent,
        ];
        $registeredCount = Registered::select('event_id', DB::raw('COUNT(*) as total_registered'))
            ->groupBy('event_id')
            ->get();
        foreach ($allCollections as $key => $collection) {
            $allCollections[$key] = $collection->map(function ($event) {
                if ($event->eventDetail && $event->eventDetail->date) {
                    // Pastikan date selalu string ISO
                    $carbonDate = Carbon::parse($event->eventDetail->date);
                    $event->eventDetail->date_string = $carbonDate->translatedFormat('d F Y');
                    $event->eventDetail->time_string = $carbonDate->format('H:i');
                }
                $event->eventDetail->registered_count = $registeredCounts[$event->event_id]->total_registered ?? 0;
                $event->eventDetail->image_url = url('https://res.cloudinary.com/dv5yjqds0/image/upload/v1765423290/event2_r3oaea.png');
                return $event;
            })->toArray();
        }

        return response()->json([
            'status' => 'success',
            'comingSoonEvent' => $allCollections['comingSoonEvent'],
            'openRegisterEvent' => $allCollections['openRegisterEvent'],
            'recentEvent' => $allCollections['recentEvent'],
            'activeEvent' => $allCollections['activeEvent'],
        ], 200);
    }
    public function getDetail(int $id)
    {
        $event = Event::with(['eventDetail'])->where('event_id', $id)->first();
        $participants = Participant::with('registered')
            ->where('event_id', $id)
            ->select('registered_id', DB::raw('GROUP_CONCAT(session_id) as sessions'))
            ->groupBy('registered_id')
            ->get();
        if ($event->eventDetail && $event->eventDetail->date) {
            // Pastikan date selalu string ISO
            $carbonDate = Carbon::parse($event->eventDetail->date);
            $event->eventDetail->date_string = $carbonDate->translatedFormat('d F Y');
            $event->eventDetail->time_string = $carbonDate->format('H:i');
        }
        $event->eventDetail->registered_count = $registeredCounts[$event->event_id]->total_registered ?? 0;
        $event->eventDetail->image_url = url('https://res.cloudinary.com/dv5yjqds0/image/upload/v1765423290/event2_r3oaea.png');

        return response()->json([
            'status' => 'success',
            'event' => $event,
            'participants' => $participants,
        ], 200);
    }
    public function createEvent(Request $request)
    {
        // Validasi seperlunya saja
        
        try {
            // Validasi seperlunya saja
            $validated = $request->validate([
                "event_name" => "required|string",
                "event_status" => "required|string",
                "event_description" => "required|string",
                "event_address" => "required|string",
                "event_speaker" => "nullable|string",
                "register_open_date" => "required|date",
                "register_closed_date" => "required|date",
                "register_status" => "boolean",
                "date" => "required|date",
                "paid_status" => "boolean",
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                "success" => false,
                "message" => "Validasi gagal",
                "errors" => $e->errors(),
            ], 422);
        }

        // Insert ke tabel event_table
        $event = Event::create([
            "event_name" => $request->event_name,
            "event_status" => $request->event_status,
        ]);

        // Insert ke tabel event_detail_table
        EventDetail::create([
            "event_id" => $event->event_id,
            "event_description" => $request->event_description,
            "event_address" => $request->event_address,
            "event_speaker" => $request->event_speaker,
            "register_open_date" => $request->register_open_date,
            "register_closed_date" => $request->register_closed_date,
            "register_status" => $request->register_status ?? false,
            "total_participant" => 0,        // default 0
            "date" => $request->date,
            "event_handler" => $request->user_id,
            "cost" => 0,                     // default 0
            "total_income" => 0,             // default 0
            "paid_status" => $request->paid_status ?? false,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Event berhasil dibuat",
            "event_id" => $event->event_id
        ]);
    }

}