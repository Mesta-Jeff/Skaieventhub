<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WebEventController extends Controller
{

    // POST TO API universal function
    public function handleUserAddingRequest($endpoint, $method, $request)
    {
        $apiStartPoint = env('API_START_POINT');
        $apiURL = $apiStartPoint . $endpoint;

        try {
            $customRequest = Request::create($apiURL, $method);
            $customRequest->headers->set('Accept', 'application/json');

            // Add the request data to the custom request
            $customRequest->request->add($request->all());
            if ($endpoint === '/event/client/event-author') {
                $customRequest->files->add(['profile' => $request->file('profile')]);
                $customRequest->files->add(['id_scan' => $request->file('id_scan')]);
                $customRequest->files->add(['large_image' => $request->file('large_image')]);
                $customRequest->files->add(['medium_image' => $request->file('medium_image')]);
                $customRequest->files->add(['small_image' => $request->file('small_image')]);
                $customRequest->files->add(['banner' => $request->file('banner')]);
                // $customRequest->files->add(['promo_video' => $request->file('promo_video')]);
            }

            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            if ($response->getStatusCode() === 201) {
                session([
                    'creator_id' => $data['creator_id'],
                    'event_id' => $data['event_id'],
                ]);
                return response()->json([
                    'success' => true,
                    'creator_id' => $data['creator_id'],
                    'event_id' => $data['event_id'],
                    'redirect' => $data['redirect'],
                    'message' => $data['message'] ?? 'Operation Performed',
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $data['message'] ?? 'Failed to perform transaction',
                    'errors' => $data['errors'] ?? [],
                ], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    // POST TO API universal function
    public function handleApiRequest($endpoint, $method, $body, $status)
    {
        // Retrieve the values from the session
        $token = session('token');
        $apiKey = session('api_key');
        $apiToken = session('api_token');
        $userKey = session('user_key');

        // Build the full API URL
        $apiStartPoint = env('API_START_POINT');
        $apiURL = $apiStartPoint . $endpoint;

        try {
            // Create the request
            $customRequest = Request::create($apiURL, $method, $body);
            $customRequest->headers->set('Accept', 'application/json');

            // Add headers if status requires a token
            if ($status == "send-with-token") {
                $customRequest->headers->set('Authorization', 'Bearer ' . $token);
                $customRequest->headers->set('ApiKey', $apiKey);
                $customRequest->headers->set('ApiToken', $apiToken);
                $customRequest->headers->set('UserKey', $userKey);
            }

            // Handle the request and get the response
            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            // Check the response status code
            if ($response->getStatusCode() === 201) {
                return response()->json([
                    'success' => true,
                    'message' => $data['message'] ?? 'Operation Performed',
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $data['message'] ?? 'Failed to perform transaction',
                    'errors' => $data['errors'] ?? [],
                ], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            // Return a JSON response with error details
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    // GET FROM API universal function
    public function getViewDataFromApi($endpoint, $status)
    {
        // Retrieve the values from the session
        $token = session('token');
        $apiKey = session('api_key');
        $apiToken = session('api_token');
        $userKey = session('user_key');

        try {
            $apiStartPoint = env('API_START_POINT');
            $apiURL = $apiStartPoint . $endpoint;

            // Create the GET request
            $customRequest = Request::create($apiURL, 'GET');
            $customRequest->headers->set('Accept', 'application/json');

            // Set headers if tokens are available
            if ($status == "send-with-token") {
                $customRequest->headers->set('Authorization', 'Bearer ' . $token);
                $customRequest->headers->set('ApiKey', $apiKey);
                $customRequest->headers->set('ApiToken', $apiToken);
                $customRequest->headers->set('UserKey', $userKey);
            }

            // Handle the request and get the response
            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);

            if ($response->getStatusCode() === 200) {
                return [
                    'status' => true,
                    'data' => $data['data'],
                    'message' => 'Data retrieved successfully',
                ];
            } else {
                return [
                    'status' => false,
                    'message' => $data['message'] ?? 'Failed to retrieve data',
                    'data' => $data['errors'] ?? [],
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
                'data' => [],
            ];
        }
    }

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
    public function showEventType(Request $request)
    {
        $endpoint = '/events/types';
        $send_state = "send-with-token";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];
        if ($request->ajax()) {
            return response()->json(['events' => $idata]);
        }
        return view('backend.events.event-type', ['events' => $idata]);
    }

    public function addEventType(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'event' => 'required|string|max:50',
            'price' => 'required|string|max:10',
            'description' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/events/types';
        $method = 'POST';
        $body = [
            'event' => $request->input('event'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function modifyEventType(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'event_id' => ['required', 'numeric'],
            'event' => 'required|string|max:50',
            'price' => 'required|string|max:10',
            'description' => 'required|string|max:1000',
            'status' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/events/types/update';
        $method = 'POST';
        $body = [
            'event_id' => $request->input('event_id'),
            'event' => $request->input('event'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function removeEventType(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'event_id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/events/types/delete';
        $method = 'POST';
        $body = [
            'event_id' => $request->input('event_id'),
        ];

        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    public function getEventType(Request $request)
    {
        $endpoint = '/events/types/get';
        $send_state = "free";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['types' => $idata]);
        }
    }

    // Client signing up
    public function eventWithAuthor(Request $request)
    {
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
            'id_scan' => 'required|mimes:pdf|max:2048',
            'account_type' => 'required|string',
            'acc_num' => 'required|string',
            'acc_branch' => 'required|string',
            'profile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'region_id' => 'required|integer',
            'district_id' => 'required|integer',
            'town_id' => 'required|integer',
        ]);;

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed because: ' . json_encode($validator->errors()),
            ], 422);
        }

        $endpoint = '/event/client/event-author';
        $method = 'POST';

        return $this->handleUserAddingRequest($endpoint, $method, $request);
    }

    // Events list
    public function showEvent(Request $request)
    {
        $batch = session('batch');
        $event_host = session('host');
        // Log::info('Batch value: ' . $event_host);

        $endpoint = '/events/web?who_requested=' . $batch . '&event_host=' . $event_host;
        $send_state = "send-with-token";

        // Modify the endpoint to include the query_type parameter
        $query_type = $request->input('query_type');
        if ($query_type === 'Yes') {
            $endpoint .= '&query_type=Yes';
        } elseif ($query_type === 'No') {
            $endpoint .= '&query_type=No';
        }


        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['events' => $idata]);
        }

        if ($batch === 'skaimount') {
            return view('backend.events.events', ['events' => $idata]);
        } else {
            return view('backend.events.authior-events', ['events' => $idata]);
        }
    }

    // Setting event up
    public function setupEvent()
    {
        return view('backend.events.creating-event');
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

    // Approving event
    public function eventApprove(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'creator_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/events/approve';
        $method = 'POST';
        $body = [
            'creator_id' => $request->input('creator_id'),
            'id' => $request->input('id'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    // Decline Event
    public function eventDecline(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'creator_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/events/decline';
        $method = 'POST';
        $body = [
            'creator_id' => $request->input('creator_id'),
            'id' => $request->input('id'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    // Suspend event
    public function eventSuspend(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'creator_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/events/suspend';
        $method = 'POST';
        $body = [
            'creator_id' => $request->input('creator_id'),
            'id' => $request->input('id'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    // Verify Event
    public function eventVerify(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/events/verify';
        $method = 'POST';
        $body = [
            'id' => $request->input('id'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
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
        $roles = session('event_id');
        Log::info('Login response', ['response' => $roles]);
        return view('frontend.en.subscription-payment');
    }
}
