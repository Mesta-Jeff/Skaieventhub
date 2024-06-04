<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Author;
use App\Models\Ticket;
use App\Models\EventType;
use App\Models\EventLikes;
use App\Models\EventStars;
use App\Models\UserTicket;
use App\Models\EventViewed;
use App\Models\EventComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EndEventController extends Controller
{
    // Authors
    public function viewAuthor()
    {
        // Code to handle viewing authors
    }

    public function createAuthor(Request $request)
    {
        // Code to handle creating an author
    }

    public function updateAuthor(Request $request)
    {
        // Code to handle updating an author
    }

    public function destroyAuthor(Request $request)
    {
        // Code to handle deleting an author
    }

    public function getAuthor(Request $request)
    {
        // Code to handle getting an author
    }

    // Event Types
    public function viewEventType()
    {
        // Code to handle viewing event types
    }

    public function createEventType(Request $request)
    {
        // Code to handle creating an event type
    }

    public function updateEventType(Request $request)
    {
        // Code to handle updating an event type
    }

    public function destroyEventType(Request $request)
    {
        // Code to handle deleting an event type
    }

    public function getEventType(Request $request)
    {
        try {
            $data = EventType::where('is_deleted', '!=', 'Yes')->orderBy('event', 'ASC')->orderBy('id', 'ASC')->get(['id', 'event', 'price']);
            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function eventWithAuthor(Request $request)
    {

        DB::beginTransaction();

        try {

            // Validate the request data
            $validator = Validator::make($request->all(), [
                'event_title' => 'required|string',
                'sub_title' => 'required|string',
                'content' => 'required|string',
                'description' => 'required|string',
                'reason' => 'required|string',
                'event_type_id' => 'required|integer',
                'aliases' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'venue' => 'required|string',
                'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'large_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'medium_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'small_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

                'title' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'phone' => 'required|string|max:10',
                'tel' => 'required|string|max:10',
                'gender' => 'required|in:Male,Female',
                'dob' => 'required|date',
                'email' => 'required|email',
                'identity_type_id' => 'required|integer',
                'id_number' => 'required|string',
                'account_type' => 'required|string',
                'acc_num' => 'required|string',
                'acc_branch' => 'required|string',
                'region_id' => 'required|integer',
                'district_id' => 'required|integer',
                'town_id' => 'required|integer',
                'id_scan' => 'required|mimes:pdf|max:2048',
                'profile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($validator->fails()) {
                DB::rollBack();
                Log::error('Validation failed', ['errors' => $validator->errors()]);
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Validation failed because: ' . json_encode($validator->errors()),
                ], 422);
            }

            $data = $request->all();
            // Check if the phone or email exists
            if (Author::where('phone', $request->phone)->orWhere('email', $request->email)->exists()) {
                $message = '';

                if (Author::where('phone', $request->phone)->exists()) {
                    $message = 'Phone number has already been taken. Please use a different one.';
                } elseif (Author::where('email', $request->email)->exists()) {
                    $message = 'Email has already been taken. Please use a different one.';
                }

                return response()->json(['success' => false, 'message' => $message ], 422);
            }
            if (Event::where('event_title', $request->event_title)->exists()) {
                $message = 'Event title has already been taken. Please use a different one.';
                return response()->json(['success' => false, 'message' => $message ], 422);
            }


            $firstName = $data['first_name'];
            $lastName = $data['last_name'];
            $initials = substr($firstName, 0, 1);
            $initials .= implode('', array_map(fn($part) => substr($part, 0, 1), explode(' ', $lastName)));

            $data['initials'] = $initials;
            $eventTitle = str_replace(' ', '_', $request->input('event_title'));

            if ($request->hasFile('profile')) {
                $fileProfile = $request->file('profile');
                $profileName = $initials . '-' . $data['phone'] .'-'. 'Profile';
                $data['profile'] = $profileName . '.png';
            }
            if ($request->hasFile('id_scan')) {
                $fileIdScan = $request->file('id_scan');
                $idScanName = $initials . '-' . $data['phone'] . 'ID';
                $data['id_scan'] = $idScanName . '.pdf';
            }

            if ($request->hasFile('banner')) {
                $fileBanner = $request->file('banner');
                $bannerName = $eventTitle . '_Banner';
                $data['banner'] = $bannerName . '.png';
            }
            if ($request->hasFile('large_image')) {
                $fileLargeImage = $request->file('large_image');
                $largeImageName = $eventTitle . '_Large';
                $data['large_image'] = $largeImageName . '.png';
            }
            if ($request->hasFile('medium_image')) {
                $fileMediumImage = $request->file('medium_image');
                $mediumImageName = $eventTitle . '_Medium';
                $data['medium_image'] = $mediumImageName . '.png';
            }
            if ($request->hasFile('small_image')) {
                $fileSmallImage = $request->file('small_image');
                $smallImageName = $eventTitle . '_Small';
                $data['small_image'] = $smallImageName . '.png';
            }

            $author = Author::create($data);
            $authorId = $author->id;
            $data['creator_id'] = $authorId;
            $event = Event::create($data);

            DB::commit();

            $profilePath = $fileProfile->storeAs('/images/authors', $profileName . '.png');
            $idScanPath = $fileIdScan->storeAs('/images/authors', $idScanName . '.pdf');
            $bannerPath = $fileBanner->storeAs('/images/event', $bannerName . '.png');
            $largeImagePath = $fileLargeImage->storeAs('/images/event', $largeImageName . '.png');
            $mediumImagePath = $fileMediumImage->storeAs('/images/event', $mediumImageName . '.png');
            $smallImagePath = $fileSmallImage->storeAs('/images/event', $smallImageName . '.png');

            return response()->json([
                'success' => true,
                'message' => 'Event created successfully, procced to the next step to complete the proccess, Thank you.',
                'event_id' => $event->id,
                'creator_id' => $author->id,
                'redirect' => '/en/subscription',
            ], 200);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Error creating event', ['exception' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error occured while creating the event, so try again, make sure all fields are having the rquired values'. json_encode($e->getMessage()),
            ], 500);
        }
    }

    // Events view for Mobile
    public function viewEventMobile(Request $request)
    {
        try {

            $eventsQuery = DB::table('events as e')
                ->join('authors as a', 'e.creator_id', '=', 'a.id')
                ->join('event_types as et', 'e.event_type_id', '=', 'et.id')
                ->select(
                    'e.id', 'e.event_title', 'e.sub_title', 'e.content', 'e.creator_id', 'e.views', 'e.stars', 'e.comments','e.likes', 'e.start_date', 'e.end_date', 'e.aliases', 'e.venue', 'e.banner', 'e.large_image', 'e.medium_image', 'e.small_image', 'e.promo_video', 'e.created_at', 'e.status', 'a.title', 'a.initials', 'a.first_name', 'a.last_name', 'a.phone', 'a.tel', 'a.email', 'a.profile', 'et.event as event_type'
                )
                ->orderby('e.start_date', 'ASC')
                ->where('e.is_deleted', 'No')
                ->where('e.approved', 'Yes');

                // Check if request_value is provided and not empty
                if ($request->has('request_value') && !empty($request->input('request_value'))) {
                    $requestValue = $request->input('request_value');
                    $eventsQuery->where(function ($query) use ($requestValue) {
                        $query->where('e.id', $requestValue)
                            ->orWhere('e.event_title', $requestValue);
                    });
                }

                // Check if query_type is provided and add appropriate where clause
                if ($request->has('query_type')) {
                    $queryType = $request->input('query_type');
                    $today = date('Y-m-d');
                    if ($queryType === 'Yes') {
                        $eventsQuery->where('e.end_date', '<', $today);
                    } else {
                        $eventsQuery->where('e.end_date', '>', $today);
                    }
                }

            $events = $eventsQuery->get();

            // Transform the results to add the asset URLs
            $events->transform(function ($event) {
                $event->banner = asset('storage/images/event/' . $event->banner);
                $event->large_image = asset('storage/images/event/' . $event->large_image);
                $event->medium_image = asset('storage/images/event/' . $event->medium_image);
                $event->small_image = asset('storage/images/event/' . $event->small_image);
                $event->promo_video = !empty($event->promo_video) ? asset('storage/videos/event/' . $event->promo_video) : 'None';
                $event->profile = asset('storage/images/authors/' . $event->profile);

                // Format start_date and end_date
                $event->start_date = date('M d, Y', strtotime($event->start_date));
                $event->end_date = date('M d, Y', strtotime($event->end_date));
                return $event;
            });

            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Events retrieved successfully',
                'data' => $events
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'An error occurred while retrieving events',
                'error' => $e->getMessage()
            ]);
        }
    }

    // Someone wiewing the event
    public function someoneViewed(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'user_id' => 'required|integer',
                'event_id' => 'required|integer',
            ]);

            $existingRecord = EventViewed::where('user_id', $validatedData['user_id'])
                ->where('event_id', $validatedData['event_id'])->first();

            if ($existingRecord) {
                return response()->json([
                    'success' => false,
                    'status_code' => 400,
                    'message' => 'User has already viewed this event',
                ]);
            }

            DB::beginTransaction();
            EventViewed::create($validatedData);
            $event = Event::findOrFail($validatedData['event_id']);
            $event->increment('views');
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Event viewed successfully',
                'status_code' => 200,
            ]);
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error inserting data: ' . $e->getMessage(),
                'status_code' => 500,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
                'status_code' => 500,
            ]);
        }
    }

    // Event view for web
    public function viewEvent()
    {

    }


    public function createEvent(Request $request)
    {
        // Code to handle creating an event
    }

    public function updateEvent(Request $request)
    {
        // Code to handle updating an event
    }

    public function destroyEvent(Request $request)
    {
        // Code to handle deleting an event
    }

    public function getEvent(Request $request)
    {
        // Code to handle getting an event
    }

    // Tickets
    public function viewEventTicket()
    {
        // Code to handle viewing event tickets
    }

    public function createEventTicket(Request $request)
    {
        // Code to handle creating an event ticket
    }

    public function updateEventTicket(Request $request)
    {
        // Code to handle updating an event ticket
    }

    public function destroyEventTicket(Request $request)
    {
        // Code to handle deleting an event ticket
    }

    public function getEventTicket(Request $request)
    {
        // Code to handle getting an event ticket
    }

    // User Tickets
    public function viewUserTicket()
    {
        // Code to handle viewing user tickets
    }

    public function createUserTicket(Request $request)
    {
        // Code to handle creating a user ticket
    }

    public function updateUserTicket(Request $request)
    {
        // Code to handle updating a user ticket
    }

    public function destroyUserTicket(Request $request)
    {
        // Code to handle deleting a user ticket
    }

    public function getUserTicket(Request $request)
    {
        // Code to handle getting a user ticket
    }

    // Event Comments
    public function viewEventComment()
    {
        // Code to handle viewing event comments
    }

    public function createEventComment(Request $request)
    {
        // Code to handle creating an event comment
    }

    public function updateEventComment(Request $request)
    {
        // Code to handle updating an event comment
    }

    public function destroyEventComment(Request $request)
    {
        // Code to handle deleting an event comment
    }

    public function getEventComment(Request $request)
    {
        // Code to handle getting an event comment
    }

    // Event Likes
    public function viewEventLike()
    {
        // Code to handle viewing event likes
    }

    public function createEventLike(Request $request)
    {
        // Code to handle creating an event like
    }

    public function updateEventLike(Request $request)
    {
        // Code to handle updating an event like
    }

    public function destroyEventLike(Request $request)
    {
        // Code to handle deleting an event like
    }

    public function getEventLike(Request $request)
    {
        // Code to handle getting an event like
    }

    // Event Stars
    public function viewEventStar()
    {
        // Code to handle viewing event stars
    }

    public function createEventStar(Request $request)
    {
        // Code to handle creating an event star
    }

    public function updateEventStar(Request $request)
    {
        // Code to handle updating an event star
    }

    public function destroyEventStar(Request $request)
    {
        // Code to handle deleting an event star
    }

    public function getEventStar(Request $request)
    {
        // Code to handle getting an event star
    }
}
