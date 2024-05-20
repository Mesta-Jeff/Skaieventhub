<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Author;
use App\Models\Ticket;
use App\Models\EventType;
use App\Models\EventLikes;
use App\Models\EventStars;
use App\Models\UserTicket;
use App\Models\EventComment;
use Illuminate\Http\Request;

class EndEventController extends Controller
{
    //
    // Authors
    public function viewAuthor()
    {
        $authors = Author::all();
        return response()->json($authors);
    }

    public function createAuthor(Request $request)
    {
        $author = Author::create($request->only('name'));
        return response()->json($author, 201);
    }

    public function updateAuthor(Request $request)
    {
        $author = Author::find($request->id);
        if ($author) {
            $author->update($request->only('name'));
            return response()->json($author);
        }
        return response()->json(['error' => 'Author not found'], 404);
    }

    public function destroyAuthor(Request $request)
    {
        $author = Author::find($request->id);
        if ($author) {
            $author->delete();
            return response()->json(['message' => 'Author deleted']);
        }
        return response()->json(['error' => 'Author not found'], 404);
    }

    public function sortAuthor()
    {
        $authors = Author::orderBy('name')->get();
        return response()->json($authors);
    }

    // Event Types
    public function viewEventType()
    {
        $eventTypes = EventType::all();
        return response()->json($eventTypes);
    }

    public function createEventType(Request $request)
    {
        $eventType = EventType::create($request->only('name'));
        return response()->json($eventType, 201);
    }

    public function updateEventType(Request $request)
    {
        $eventType = EventType::find($request->id);
        if ($eventType) {
            $eventType->update($request->only('name'));
            return response()->json($eventType);
        }
        return response()->json(['error' => 'Event Type not found'], 404);
    }

    public function destroyEventType(Request $request)
    {
        $eventType = EventType::find($request->id);
        if ($eventType) {
            $eventType->delete();
            return response()->json(['message' => 'Event Type deleted']);
        }
        return response()->json(['error' => 'Event Type not found'], 404);
    }

    public function sortEventType()
    {
        $eventTypes = EventType::orderBy('name')->get();
        return response()->json($eventTypes);
    }

    // Events
    public function viewEvent()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function createEvent(Request $request)
    {
        $event = Event::create($request->only(['name', 'description', 'date', 'author_id', 'event_type_id']));
        return response()->json($event, 201);
    }

    public function updateEvent(Request $request)
    {
        $event = Event::find($request->id);
        if ($event) {
            $event->update($request->only(['name', 'description', 'date', 'author_id', 'event_type_id']));
            return response()->json($event);
        }
        return response()->json(['error' => 'Event not found'], 404);
    }

    public function destroyEvent(Request $request)
    {
        $event = Event::find($request->id);
        if ($event) {
            $event->delete();
            return response()->json(['message' => 'Event deleted']);
        }
        return response()->json(['error' => 'Event not found'], 404);
    }

    public function sortEvent()
    {
        $events = Event::orderBy('date')->get();
        return response()->json($events);
    }

    // Event Tickets
    public function viewEventTicket()
    {
        $eventTickets = Ticket::all();
        return response()->json($eventTickets);
    }

    public function createEventTicket(Request $request)
    {
        $eventTicket = Ticket::create($request->only(['event_id', 'price', 'quantity']));
        return response()->json($eventTicket, 201);
    }

    public function updateEventTicket(Request $request)
    {
        $eventTicket = Ticket::find($request->id);
        if ($eventTicket) {
            $eventTicket->update($request->only(['event_id', 'price', 'quantity']));
            return response()->json($eventTicket);
        }
        return response()->json(['error' => 'Event Ticket not found'], 404);
    }

    public function destroyEventTicket(Request $request)
    {
        $eventTicket = Ticket::find($request->id);
        if ($eventTicket) {
            $eventTicket->delete();
            return response()->json(['message' => 'Event Ticket deleted']);
        }
        return response()->json(['error' => 'Event Ticket not found'], 404);
    }

    public function sortEventTicket()
    {
        $eventTickets = Ticket::orderBy('price')->get();
        return response()->json($eventTickets);
    }

    // User Tickets
    public function viewUserTicket()
    {
        $userTickets = UserTicket::all();
        return response()->json($userTickets);
    }

    public function createUserTicket(Request $request)
    {
        $userTicket = UserTicket::create($request->only(['user_id', 'event_ticket_id']));
        return response()->json($userTicket, 201);
    }

    public function updateUserTicket(Request $request)
    {
        $userTicket = UserTicket::find($request->id);
        if ($userTicket) {
            $userTicket->update($request->only(['user_id', 'event_ticket_id']));
            return response()->json($userTicket);
        }
        return response()->json(['error' => 'User Ticket not found'], 404);
    }

    public function destroyUserTicket(Request $request)
    {
        $userTicket = UserTicket::find($request->id);
        if ($userTicket) {
            $userTicket->delete();
            return response()->json(['message' => 'User Ticket deleted']);
        }
        return response()->json(['error' => 'User Ticket not found'], 404);
    }

    public function sortUserTicket()
    {
        $userTickets = UserTicket::orderBy('user_id')->get();
        return response()->json($userTickets);
    }

    // Event Comments
    public function viewEventComment()
    {
        $eventComments = EventComment::all();
        return response()->json($eventComments);
    }

    public function createEventComment(Request $request)
    {
        $eventComment = EventComment::create($request->only(['event_id', 'user_id', 'comment']));
        return response()->json($eventComment, 201);
    }

    public function updateEventComment(Request $request)
    {
        $eventComment = EventComment::find($request->id);
        if ($eventComment) {
            $eventComment->update($request->only(['event_id', 'user_id', 'comment']));
            return response()->json($eventComment);
        }
        return response()->json(['error' => 'Event Comment not found'], 404);
    }

    public function destroyEventComment(Request $request)
    {
        $eventComment = EventComment::find($request->id);
        if ($eventComment) {
            $eventComment->delete();
            return response()->json(['message' => 'Event Comment deleted']);
        }
        return response()->json(['error' => 'Event Comment not found'], 404);
    }

    public function sortEventComment()
    {
        $eventComments = EventComment::orderBy('created_at')->get();
        return response()->json($eventComments);
    }

    // Event Likes
    public function viewEventLike()
    {
        $eventLikes = EventLikes::all();
        return response()->json($eventLikes);
    }

    public function createEventLike(Request $request)
    {
        $eventLike = EventLikes::create($request->only(['event_id', 'user_id']));
        return response()->json($eventLike, 201);
    }

    public function updateEventLike(Request $request)
    {
        $eventLike = EventLikes::find($request->id);
        if ($eventLike) {
            $eventLike->update($request->only(['event_id', 'user_id']));
            return response()->json($eventLike);
        }
        return response()->json(['error' => 'Event Like not found'], 404);
    }

    public function destroyEventLike(Request $request)
    {
        $eventLike = EventLikes::find($request->id);
        if ($eventLike) {
            $eventLike->delete();
            return response()->json(['message' => 'Event Like deleted']);
        }
        return response()->json(['error' => 'Event Like not found'], 404);
    }

    public function sortEventLike()
    {
        $eventLikes = EventLikes::orderBy('event_id')->get();
        return response()->json($eventLikes);
    }

    // Event Stars
    public function viewEventStar()
    {
        $eventStars = EventStars::all();
        return response()->json($eventStars);
    }

    public function createEventStar(Request $request)
    {
        $eventStar = EventStars::create($request->only(['event_id', 'user_id', 'stars']));
        return response()->json($eventStar, 201);
    }

    public function updateEventStar(Request $request)
    {
        $eventStar = EventStars::find($request->id);
        if ($eventStar) {
            $eventStar->update($request->only(['event_id', 'user_id', 'stars']));
            return response()->json($eventStar);
        }
        return response()->json(['error' => 'Event Star not found'], 404);
    }

    public function destroyEventStar(Request $request)
    {
        $eventStar = EventStars::find($request->id);
        if ($eventStar) {
            $eventStar->delete();
            return response()->json(['message' => 'Event Star deleted']);
        }
        return response()->json(['error' => 'Event Star not found'], 404);
    }

    public function sortEventStar()
    {
        $eventStars = EventStars::orderBy('stars', 'desc')->get();
        return response()->json($eventStars);
    }
}
