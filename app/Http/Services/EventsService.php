<?php

namespace App\Http\Services;

use App\Models\Event;
use Carbon\Carbon;

class EventsService
{
    public function getAllEvents($includes = [])
    {
        $events = Event::with($includes)->get();
        return $events;
    }

    public function getFutureEvents()
    {
        $events = Event::with(["workshops"])->whereHas("workshops", function ($query) {
            $query->where('start', '>=', Carbon::now());
        })->get();
        return $events;
    }

    public function getWarmupevents()
    {
        $events = Event::all();
        return $events;
    }
}
