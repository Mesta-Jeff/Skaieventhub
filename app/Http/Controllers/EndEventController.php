<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Event;
use App\Models\Author;
use App\Models\Ticket;
use App\Models\EventType;
use App\Models\EventLikes;
use App\Models\EventStars;
use App\Models\UserTicket;
use App\Models\EventViewed;
use Illuminate\Support\Str;
use App\Models\EventComment;
use App\Models\UserApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
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

    // Code to handle getting an author
    public function getAuthor(Request $request)
    {
        try {
            $data = Author::where('is_deleted', '!=', 'Yes')->orderBy('title', 'ASC')->get(['id', 'title', 'first_name', 'last_name', 'initials']);
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

    // Event Types
    public function viewEventType(Request $request)
    {
        try {
            $data = EventType::where('is_deleted', '!=', 'Yes')->orderby('id', 'DESC')->get();
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

    // Creating event type
    public function createEventType(Request $request)
    {
        try {
            $data = $request->validate([
                'event' => 'required|string|max:50',
                'price' => 'required|string|max:10',
                'description' => 'required|string|max:1000',
            ]);

            // Check if a role with the same title already exists
            if (EventType::where('event', $data['event'])->exists() && EventType::where('event', $data['event'])->where('is_deleted', 'NO')->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record already exists in the database, try a different one.'
                ], 422);
            }
            $dbRequest = EventType::create($data);
            if ($dbRequest) {
                return response()->json([
                    'success' => true,
                    'message' => 'Request to perform database operation has gone through successful',
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry request to the database has declined, try again later',
                ], 409);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    public function updateEventType(Request $request)
    {
        try {
            $data = $request->validate([
                'event_id' => 'required|integer|exists:event_types,id',
                'event' => 'required|string|max:50',
                'price' => 'required|string|max:10',
                'description' => 'required|string|max:1000',
                'status' => 'required|string|max:10',
            ]);
            $idata = EventType::find($data['event_id']);
            if ($idata) {
                $idata->update($data);
                return response()->json([
                    'success' => true,
                    'message' => 'Request to perform database operation has gone through successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Record you want to remove cannot found',
                ], 404);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    public function destroyEventType(Request $request)
    {
        try {
            $data = $request->validate([
                'event_id' => 'required|integer|exists:event_types,id',
            ]);
            $idata = EventType::find($data['event_id']);
            if ($idata) {

                $idata->is_deleted = 'Yes';
                $idata->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Request to perform database operation has gone through successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Record you want to remove cannot found',
                ], 404);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
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


    // Creating event with AUthor
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

                return response()->json(['success' => false, 'message' => $message], 422);
            }
            if (Event::where('event_title', $request->event_title)->exists()) {
                $message = 'Event title has already been taken. Please use a different one.';
                return response()->json(['success' => false, 'message' => $message], 422);
            }


            $firstName = $data['first_name'];
            $lastName = $data['last_name'];
            $initials = substr($firstName, 0, 1);
            $initials .= implode('', array_map(fn ($part) => substr($part, 0, 1), explode(' ', $lastName)));

            $data['initials'] = $initials;
            $eventTitle = str_replace(' ', '_', $request->input('event_title'));

            if ($request->hasFile('profile')) {
                $fileProfile = $request->file('profile');
                $profileName = $initials . '-' . $data['phone'] . '-' . 'Profile';
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
                'message' => 'Error occured while creating the event, so try again, make sure all fields are having the rquired values' . json_encode($e->getMessage()),
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
                ->select('e.id','e.event_title','e.sub_title','e.content','e.creator_id','e.views','e.stars','e.comments','e.likes','e.start_date',
                    'e.end_date','e.aliases','e.venue','e.banner','e.large_image','e.medium_image','e.small_image','e.promo_video','e.created_at',
                    'e.status','a.title','a.initials','a.first_name','a.last_name','a.phone','a.tel','a.email','a.profile','et.event as event_type'
                )
                ->orderby('e.start_date', 'ASC')
                ->where('e.is_deleted', 'No')
                ->where('e.approved', 1);

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

    public function someoneLiked(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'user_id' => 'required|integer',
                'event_id' => 'required|integer',
            ]);

            $existingRecord = EventLikes::where('user_id', $validatedData['user_id'])
                ->where('event_id', $validatedData['event_id'])->first();

            if ($existingRecord) {
                return response()->json([
                    'success' => false,
                    'status_code' => 400,
                    'message' => 'User has already viewed this event',
                ]);
            }
            DB::beginTransaction();
            EventLikes::create($validatedData);
            $event = Event::findOrFail($validatedData['event_id']);
            $event->increment('likes');
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Event liked successfully',
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

    public function someoneStared(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'user_id' => 'required|integer',
                'event_id' => 'required|integer',
            ]);

            $existingRecord = EventStars::where('user_id', $validatedData['user_id'])
                ->where('event_id', $validatedData['event_id'])->first();

            if ($existingRecord) {
                return response()->json([
                    'success' => false,
                    'status_code' => 400,
                    'message' => 'User has already viewed this event',
                ]);
            }
            DB::beginTransaction();
            EventStars::create($validatedData);
            $event = Event::findOrFail($validatedData['event_id']);
            $event->increment('stars');
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Event stared successfully',
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

    public function someoneCommented(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'user_id' => 'required|integer',
                'event_id' => 'required|integer',
                'comment' => 'required|string'
            ]);


            DB::beginTransaction();
            EventComment::create($validatedData);
            $event = Event::findOrFail($validatedData['event_id']);
            $event->increment('comments');
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Event commented successfully',
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
    public function viewEvent(Request $request)
    {
        try {

            $eventsQuery = DB::table('events as e')
                ->join('event_types as et', 'e.event_type_id', '=', 'et.id')
                ->select('e.id','e.event_title', 'e.sub_title','e.content', 'e.creator_id', 'e.views', 'e.stars', 'e.comments', 'e.likes',
                    'e.start_date','e.end_date','e.aliases','e.venue','e.banner','e.large_image','e.medium_image','e.small_image','e.promo_video',
                    'e.created_at', 'e.status','e.description','e.reason','e.event_type_id','e.verified','e.approved','et.event as event_type'
                )
                ->where('e.is_deleted', 'No');

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

            // Check if who_requested is provided and apply appropriate conditions
            if ($request->has('who_requested')) {
                $whoRequested = $request->input('who_requested');
                $idRequested = $request->input('event_host');
                if ($whoRequested != 'skaimount') {
                    $eventsQuery->where('e.creator_id', $idRequested);
                }
            }

            $events = $eventsQuery->orderby('e.start_date', 'ASC')->get();


            // Transform the results to add the asset URLs
            $events->transform(function ($event) {
                $event->banner = asset('storage/images/event/' . $event->banner);
                $event->large_image = asset('storage/images/event/' . $event->large_image);
                $event->medium_image = asset('storage/images/event/' . $event->medium_image);
                $event->small_image = asset('storage/images/event/' . $event->small_image);
                $event->promo_video = !empty($event->promo_video) ? asset('storage/videos/event/' . $event->promo_video) : 'None';

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


    // Creating new event from the browser
    public function createEvent(Request $request)
    {
        try {

            // Validate the request data
            $validator = Validator::make($request->all(), [
                'creator_id' => 'required|integer',
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
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed', ['errors' => $validator->errors()]);
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->all(),
                    'message' => 'Validation failed because: ' . json_encode($validator->errors()),
                ], 422);
            }

            $data = $request->all();
            if (Event::where('event_title', $request->event_title)->exists()) {
                $message = 'Event title has already been taken. Please use a different one.';
                return response()->json(['success' => false, 'message' => $message], 422);
            }

            $eventTitle = str_replace(' ', '_', $request->input('event_title'));

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
            $event = Event::create($data);

            $bannerPath = $fileBanner->storeAs('/images/event', $bannerName . '.png');
            $largeImagePath = $fileLargeImage->storeAs('/images/event', $largeImageName . '.png');
            $mediumImagePath = $fileMediumImage->storeAs('/images/event', $mediumImageName . '.png');
            $smallImagePath = $fileSmallImage->storeAs('/images/event', $smallImageName . '.png');
            return response()->json([
                'success' => true,
                'message' => 'Event created successfully, procced to the next step to complete the proccess, Thank you.',
                'data' => [
                    'event_id' => $event->id,
                    'creator_id' => $request->creator_id,
                ],
                'redirect' => '/en/subscription',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error creating event', ['exception' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error occured while creating the event, so try again, make sure all fields are having the rquired values' . json_encode($e->getMessage()),
            ], 500);
        }
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

    // Approving event
    public function eventApprove(Request $request)
    {
        try {
            $data = $request->validate([
                'creator_id' => 'required|integer|exists:authors,id',
                'id' => 'required|integer|exists:events,id'
            ]);

            DB::beginTransaction();

            // Retrieve author information
            $author = Author::select('title', 'initials', 'first_name', 'last_name', 'gender', 'dob', 'phone', 'email', 'profile')
                ->where('id', $data['creator_id'])->firstOrFail();

            // Update event status to 'Approved' and set 'approved' to true
            $event = Event::where('id', $data['id'])->firstOrFail();
            $eventUpdateResult = $event->update(['status' => 'Approved', 'approved' => true]);

            // Get the role ID where the title is 'Author'
            $role = Role::where('title', 'Author')->firstOrFail();

            $user = User::where('email', $author->email)->where('phone', $author->phone)->first();

            if ($user !== null) {
                $userUpdateResult = User::where('actions', $data['creator_id'])->update(['is_deleted' => 'No', 'status' => 'Active']);
            } else {
                // Prepare user data for mass insertion
                $userData = [
                    'name' => $author->first_name . ' ' . $author->last_name,
                    'email' => $author->email,
                    'password' => Hash::make($author->phone),
                    'image' => $author->profile,
                    'phone' => $author->phone,
                    'dob' => $author->dob,
                    'gender' => $author->gender,
                    'role_id' => $role->id,
                    'nickname' => $author->title . '-' . $author->first_name,
                    'actions' => $data['creator_id']
                ];
                $user = User::create($userData);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            // Generate encryption key
            $firstChar = substr($user->name, 0, 1);
            $lastChar = substr($user->name, -1);
            $randomNumbers = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $encryptionKey = $firstChar . $lastChar . '-' . $randomNumbers;

            $iv = Str::random(8);

            // Encrypt the token with OpenSSL using DES
            $encryptedToken = openssl_encrypt($token, 'des-cbc', $encryptionKey, 0, $iv);
            $encryptedToken = base64_encode($iv . $encryptedToken);

            // Save to user_api_tokens table
            UserApiToken::create([
                'user_id' => $user->id,
                'raw_token' => $token,
                'hash_token' => $encryptedToken,
                'user_key' => $encryptionKey
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Request to perform database operation has gone through successfully',
            ], 201);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    // Decline Event
    public function eventDecline(Request $request)
    {
        try {
            $data = $request->validate([
                'creator_id' => 'required|integer|exists:authors,id',
                'id' => 'required|integer|exists:events,id'
            ]);

            DB::beginTransaction();

            $event = Event::where('id', $data['id'])->firstOrFail();
            $event->update(['status' => 'Declined', 'approved' => false]);

            User::where('actions', $data['creator_id'])->update(['status' => 'Declined', 'is_deleted' => 'Yes']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Request to perform database operation has gone through successfully',
            ], 201);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    // Suspend event
    public function eventSuspend(Request $request)
    {
        try {
            $data = $request->validate([
                'creator_id' => 'required|integer|exists:authors,id',
                'id' => 'required|integer|exists:events,id'
            ]);

            DB::beginTransaction();

            $event = Event::where('id', $data['id'])->firstOrFail();
            $event->update(['status' => 'Suspended', 'approved' => false]);

            User::where('actions', $data['creator_id'])->update(['status' => 'Suspended', 'is_deleted' => 'Yes']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Request to perform database operation has gone through successfully',
            ], 201);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    // Verify event
    public function eventVerify(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|integer|exists:events,id'
            ]);

            $event = Event::where('id', $data['id'])->firstOrFail();
            $event->update(['verified' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Request to perform database operation has gone through successfully',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }


    // Tickets
    public function viewEventTicket(Request $request)
    {
        try {

            $ticketsQuery = DB::table('tickets as t')
                ->join('users as u', 't.user_id', '=', 'u.id')
                ->join('events as e', 't.event_id', '=', 'e.id')
                ->select(
                    'u.name', 'u.nickname',
                    't.id', 't.title', 't.event_id', 't.price','t.seat', 't.total', 't.remaining', 't.description', 't.status', 't.created_at',
                    'e.aliases','e.start_date'
                )
                ->where('t.is_deleted', 'No');

                if ($request->has('event_id') && !empty($request->input('event_id'))) {
                    $requestValue = $request->input('event_id');
                    $ticketsQuery->where(function ($query) use ($requestValue) {
                        $query->where('e.id', $requestValue);
                    });
                }

                // Apply conditions based on the request
                if ($request->has('who_requested')) {
                    $whoRequested = $request->input('who_requested');
                    $idRequested = $request->input('event_host');
                    if ($whoRequested != 'skaimount') {
                        $ticketsQuery->where('e.creator_id', $idRequested);
                    }
                }
            // Execute the query and get the results
            $tickets = $ticketsQuery->orderby('t.title', 'DESC')->get();

            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Events retrieved successfully',
                'data' => $tickets
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

    // Code to handle creating an event ticket
    public function createEventTicket(Request $request)
    {

        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'total' => 'required|numeric|min:1',
                'remaining' => 'required|numeric|min:2',
                'seat' => 'required|string|min:1',
                'price' => 'required|numeric|min:1',
                'description' => 'nullable|string|max:1000',
                'event_id' => 'required|numeric',
                'user_id' => 'required|integer|exists:users,id',
            ]);

            // Check if a role with the same title already exists
            if ((Ticket::where('title', $data['title'])->where('event_id', $data['event_id'])->where('is_deleted', 'NO')->exists())) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ticket already exists in the database, try a different one.'
                ], 422);
            }
            $dbRequest = Ticket::create($data);
            if ($dbRequest) {
                return response()->json([
                    'success' => true,
                    'message' => 'Request to perform database operation has gone through successful',
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry request to the database has declined, try again later',
                ], 409);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    // Code to handle updating an event ticket
    public function updateEventTicket(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|integer|exists:tickets,id',
                'title' => 'required|string|max:255',
                'total' => 'required|numeric|min:2',
                'seat' => 'required|string|min:3',
                'price' => 'required|numeric|min:2',
                'description' => 'nullable|string|max:1000',
                'status' => 'required|string|max:10',
            ]);
            $idata = Ticket::find($data['id']);
            if ($idata) {
                $idata->update($data);
                return response()->json([
                    'success' => true,
                    'message' => 'Request to perform database operation has gone through successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Record you want to remove cannot found',
                ], 404);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    // Code to handle deleting an event ticket
    public function destroyEventTicket(Request $request)
    {
        try {
            $data = $request->validate([
                'id' => 'required|integer|exists:tickets,id',
            ]);
            $idata = Ticket::find($data['id']);
            if ($idata) {

                $idata->is_deleted = 'Yes';
                $idata->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Request to perform database operation has gone through successful',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Record you want to remove cannot found',
                ], 404);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    public function getEventTicket(Request $request)
    {
        // Code to handle getting an event ticket
    }

    // Buy Ticket from Mobile App =======================================================================================================================
    public function eventBuyTicket(Request $request)
    {
        // Getting the value from the user request
        try {
            $data = $request->validate([
                'ticket_type' => 'required|string|max:255',
                'quantity' => 'required|numeric|min:1',
                'seat' => 'required|numeric',
                'ticket_id' => 'required|integer|exists:tickets,id',
                'user_id' => 'required|integer|exists:users,id',
            ]);

            // Check if a record with the same ticket_type, ticket_id, and not deleted already exists
            if (UserTicket::where('seat', $data['seat'])->where('ticket_id', $data['ticket_id'])->where('is_deleted', 'NO')->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This seat has been reserved already, try a different one.'
                ], 422);
            }

            // Generate a 20-digit random number for ticket_no
            $generatedCode = str_pad(mt_rand(1, 9999999999), 5, '0', STR_PAD_LEFT) . 'TN' .now()->format('Ymd-Hi');

            $data['ticket_no'] = $generatedCode;
            $data['status'] = 'UNPAID';

            // Perform the database operation
            $dbRequest = UserTicket::create($data);
            if ($dbRequest) {
                return response()->json([
                    'success' => true,
                    'ticket_number' => $generatedCode,
                    'message' => 'Your ticket has been successfully reserved with pending action! Please proceed to complete the payment process. Thank you',
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry request to the database has declined, try again later',
                ], 409);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed because: ' . json_encode($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . json_encode($e->getMessage()),
            ], 500);
        }
    }

    // Trying to find out if the seat is available or not
    public function eventReservedSeats(Request $request)
    {
        try {

            $requestValue = $request->input('ticket_id');

            $ticketsQuery = DB::table('user_tickets')->select('seat')
            ->where('is_deleted', 'No')->where('status', '=', 'PAID')->where('ticket_id', $requestValue)->orderBy('seat', 'ASC')->get();

            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Events retrieved successfully',
                'data' => $ticketsQuery
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
    public function viewEventComment(Request $request)
    {
        try {
            $event_id = $request->input('event_id');
            $user_id = $request->input('user_id');

            // Joining users table with event_comments table and using aliases
            $comments = EventComment::select('ec.id', 'ec.event_id', 'ec.user_id', 'ec.comment', 'ec.status', 'ec.created_at', 'u.nickname', 'u.image')
                ->from('event_comments AS ec')
                ->join('users AS u', 'ec.user_id', '=', 'u.id')
                ->where('ec.event_id', $event_id)
                // ->where('ec.user_id', $user_id)
                ->where('ec.is_deleted', '!=', 'Yes')
                ->get();

            $comments->transform(function ($comment) {
                $comment->image = asset('storage/images/users/' . $comment->image);
                return $comment;
            });

            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Comments retrieved successfully',
                'data' => $comments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'An error occurred while retrieving comments',
                'error' => $e->getMessage()
            ]);
        }
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

    //  Payment info
    public function paymentInfo(Request $request)
    {
        try {
            $eventsQuery = DB::table('events as e')
                ->join('event_types as et', 'e.event_type_id', '=', 'et.id')
                ->join('authors as a', 'e.creator_id', '=', 'a.id')
                ->select('e.id', 'e.event_title', 'e.aliases', 'et.event as event_type', 'et.price')
                ->where('e.is_deleted', 'No');

            // Check if id and creator_id are provided and not empty
            if ($request->has('id') && !empty($request->input('id')) && $request->has('creator_id') && !empty($request->input('creator_id'))) {
                $id = $request->input('id');
                $creator_id = $request->input('creator_id');
                $eventsQuery->where(function ($query) use ($id, $creator_id) {
                    $query->where('e.id', $id)->Where('e.creator_id', $creator_id);
                });
            }

            // Check if email and title are provided and not empty
            if ($request->has('email') && !empty($request->input('email')) && $request->has('title') && !empty($request->input('title'))) {
                $email = $request->input('email');
                $title = $request->input('title');
                $eventsQuery->where(function ($query) use ($email, $title) {
                    $query->where('e.event_title', $title) ->Where('a.email', $email)->orWhere('a.phone', $email);
                });
            }

            $events = $eventsQuery->orderBy('e.start_date', 'ASC')->get();

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



}
