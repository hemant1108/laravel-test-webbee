<?php

namespace App\Http\Services;

use App\Models\Event;

class EventsService
{
    public function getAllEvents($includes = [])
    {
        $events = Event::with($includes)->get();
        return $events;
    }
}
