<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebEventController extends Controller
{
    // Authors
    public function showAuthor()
    {
        // Code to handle showing authors
    }

    public function addAuthor(Request $request)
    {
        // Code to handle adding an author
    }

    public function modifyAuthor(Request $request)
    {
        // Code to handle modifying an author
    }

    public function removeAuthor(Request $request)
    {
        // Code to handle removing an author
    }

    public function getAuthor(Request $request)
    {
        // Code to handle getting an author
    }

    // Event Types
    public function showEventType()
    {
        // Code to handle showing event types
    }

    public function addEventType(Request $request)
    {
        // Code to handle adding an event type
    }

    public function modifyEventType(Request $request)
    {
        // Code to handle modifying an event type
    }

    public function removeEventType(Request $request)
    {
        // Code to handle removing an event type
    }

    public function getEventType(Request $request)
    {
        // Code to handle getting an event type
    }

    // Events
    public function showEvent()
    {
        // Code to handle showing events
    }

    public function addEvent(Request $request)
    {
        // Code to handle adding an event
    }

    public function modifyEvent(Request $request)
    {
        // Code to handle modifying an event
    }

    public function removeEvent(Request $request)
    {
        // Code to handle removing an event
    }

    public function getEvent(Request $request)
    {
        // Code to handle getting an event
    }

    // Tickets
    public function showEventTicket()
    {
        // Code to handle showing event tickets
    }

    public function addEventTicket(Request $request)
    {
        // Code to handle adding an event ticket
    }

    public function modifyEventTicket(Request $request)
    {
        // Code to handle modifying an event ticket
    }

    public function removeEventTicket(Request $request)
    {
        // Code to handle removing an event ticket
    }

    public function getEventTicket(Request $request)
    {
        // Code to handle getting an event ticket
    }

    // User Tickets
    public function showUserTicket()
    {
        // Code to handle showing user tickets
    }

    public function addUserTicket(Request $request)
    {
        // Code to handle adding a user ticket
    }

    public function modifyUserTicket(Request $request)
    {
        // Code to handle modifying a user ticket
    }

    public function removeUserTicket(Request $request)
    {
        // Code to handle removing a user ticket
    }

    public function getUserTicket(Request $request)
    {
        // Code to handle getting a user ticket
    }

    // Event Comments
    public function showEventComment()
    {
        // Code to handle showing event comments
    }

    public function addEventComment(Request $request)
    {
        // Code to handle adding an event comment
    }

    public function modifyEventComment(Request $request)
    {
        // Code to handle modifying an event comment
    }

    public function removeEventComment(Request $request)
    {
        // Code to handle removing an event comment
    }

    public function getEventComment(Request $request)
    {
        // Code to handle getting an event comment
    }

    // Event Likes
    public function showEventLike()
    {
        // Code to handle showing event likes
    }

    public function addEventLike(Request $request)
    {
        // Code to handle adding an event like
    }

    public function modifyEventLike(Request $request)
    {
        // Code to handle modifying an event like
    }

    public function removeEventLike(Request $request)
    {
        // Code to handle removing an event like
    }

    public function getEventLike(Request $request)
    {
        // Code to handle getting an event like
    }

    // Event Stars
    public function showEventStar()
    {
        // Code to handle showing event stars
    }

    public function addEventStar(Request $request)
    {
        // Code to handle adding an event star
    }

    public function modifyEventStar(Request $request)
    {
        // Code to handle modifying an event star
    }

    public function removeEventStar(Request $request)
    {
        // Code to handle removing an event star
    }

    public function getEventStar(Request $request)
    {
        // Code to handle getting an event star
    }






    // FRONT END USERS CREATING EVENT
    public function enCreateEvent()
    {
        return view('frontend.en.create-event');
    }

    public function enCreateEventIndex()
    {
        return view('frontend.en.regulations');
    }

    public function ensubscribe()
    {
        return view('frontend.en.subscription-payment');
    }
}



