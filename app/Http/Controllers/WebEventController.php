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
        $token = session('token');
        $apiKey = session('api_key');
        $apiToken = session('api_token');
        $userKey = session('user_key');

        $apiStartPoint = env('API_START_POINT');
        $apiURL = $apiStartPoint . $endpoint;

        try {
            // Create the custom request
            $customRequest = Request::create($apiURL, $method);
            $customRequest->headers->set('Accept', 'application/json');

            // Add the request data to the custom request
            $customRequest->request->add($request->all());

            // Handle file uploads for specific endpoints
            if ($endpoint === '/event/client/event-author') {
                $this->addFilesToRequest($customRequest, $request, ['profile', 'id_scan', 'large_image', 'medium_image', 'small_image', 'banner']);
            }
            if ($endpoint === '/events/create') {
                // Add authorization headers for this endpoint
                $customRequest->headers->set('Authorization', 'Bearer ' . $token);
                $customRequest->headers->set('ApiKey', $apiKey);
                $customRequest->headers->set('ApiToken', $apiToken);
                $customRequest->headers->set('UserKey', $userKey);

                // Add file uploads
                $this->addFilesToRequest($customRequest, $request, ['large_image', 'medium_image', 'small_image', 'banner']);
            }

            // Handle the custom request and get the response
            $response = app()->handle($customRequest);
            $data = json_decode($response->getContent(), true);
            // Log::info('Data from JSON response:', $data);


            // Check if JSON decoding was successful
            if ($data !== null) {
                // Check for a successful response
                if ($response->getStatusCode() === 200) {
                    // Check if the expected keys exist in the JSON data
                    if (isset($data['data']['creator_id'], $data['data']['event_id'], $data['redirect'])) {
                        // Store data in the session
                        session([
                            'creator_id' => $data['data']['creator_id'],
                            'event_id' => $data['data']['event_id'],
                        ]);
                        return response()->json([
                            'success' => true,
                            'redirect' => $data['redirect'],
                            'message' => $data['message'] ?? 'Operation Performed',
                        ], 201);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to perform transaction.',
                        'message' => $data['message'] ?? 'Failed to perform transaction',
                        'errors' => $data['errors'] ?? [],
                    ], $response->getStatusCode());
                }
            } else {
                // Handle JSON decoding error
                return response()->json([
                    'success' => false,
                    'error' => 'Error decoding JSON response.',
                ], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    // Helper function to add files to the request
    private function addFilesToRequest($customRequest, $request, $fileKeys)
    {
        foreach ($fileKeys as $key) {
            if ($request->hasFile($key)) {
                $customRequest->files->add([$key => $request->file($key)]);
            }
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
                    'url' => $data['url'] ?? '',
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $data['message'] ?? 'Failed to perform transaction','errors' => $data['errors'] ?? [],
                ], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false,'message' => 'An error occurred: ' . $e->getMessage()], 500);
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

    // Code to handle getting an author
    public function getAuthor(Request $request)
    {
        $endpoint = '/events/authors/get';
        $send_state = "send-with-token";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];
        // Log::info($idata);

        if ($request->ajax()) {
            return response()->json(['authors' => $idata]);
        }
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
            return view('backend.events.authior-events', ['events' => $idata, 'host' =>$event_host]);
        }
    }

    // Setting event up
    public function setupEvent(Request $request)
    {
        $fullQueryString = $request->getQueryString();
        preg_match('/~(\d+)%/', $fullQueryString, $matches);
        $host_id = isset($matches[1]) ? $matches[1] : null;

        // Check if host_id is null or empty and the session batch value is not 'skaimount'
        if (is_null($host_id) || $host_id === '') {
            if (session('batch') !== 'skaimount') {
                return redirect()->route('events.show');
            }
        }
        return view('backend.events.creating-event', compact('host_id'));
    }

    // Code to handle adding an event
    public function addEvent(Request $request)
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
            'creator_id' => 'required|integer',
        ]);;

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed because: ' . json_encode($validator->errors()),
            ], 422);
        }

        $endpoint = '/events/create';
        $method = 'POST';

        return $this->handleUserAddingRequest($endpoint, $method, $request);
    }

    // Code to handle modifying an event
    public function modifyEvent(Request $request)
    {

    }

    // Code to handle removing an event
    public function removeEvent(Request $request)
    {

    }

    // Get event for a list
    public function getEvent(Request $request)
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
    public function showEventTicket(Request $request)
    {
        $batch = session('batch'); $event_host = session('host');

        $fullQueryString = $request->getQueryString();
        preg_match('/%(\d+)%/', $fullQueryString, $matches);
        $event_id = isset($matches[1]) ? $matches[1] : null;

        // Modify the endpoint to include the query_type parameter
        $endpoint = '/events/event-tickets?who_requested=' . $batch . '&event_host=' . $event_host;
        if ($event_id != '') {
            $endpoint .= '&event_id=' . $event_id;
        }

        $send_state = "send-with-token";
        $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
        $idata = $apiResponse['status'] ? $apiResponse['data'] : [];

        if ($request->ajax()) {
            return response()->json(['tickets' => $idata]);
        }
        if ($event_id) {
            return view('backend.events.event-ticket',['event_id' => $event_id, 'tickets' => $idata]);
        } else {
            if ($batch === 'skaimount') {
                return view('backend.events.events');
            } else if ($batch === 'skaiclient') {
                return view('backend.events.authior-events');
            }
        }

    }

    // Code to handle adding an event ticket
    public function addEventTicket(Request $request)
    {

        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'ticket' => 'required|string|max:255',
            'total' => 'required|numeric|min:1',
            'seat' => 'required|string|min:1',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:1000',
            'event_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ], 422);
        }

        $id = session('user_id');
        $endpoint = '/events/event-tickets';
        $method = 'POST';
        $body = [
            'title' => $request->input('ticket'),
            'total' => $request->input('total'),
            'remaining' => $request->input('total'),
            'seat' => $request->input('seat'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'event_id' => $request->input('event_id'),
            'user_id' => $id,
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    // Code to handle modifying an event ticket
    public function modifyEventTicket(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'ticket' => 'required|string|max:255',
            'total' => 'required|numeric|min:2',
            'seat' => 'required|string|min:3',
            'price' => 'required|numeric|min:2',
            'description' => 'nullable|string|max:1000',
            'id' => 'required|numeric',
            'status' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ], 422);
        }

        $endpoint = '/events/event-tickets/update';
        $method = 'POST';
        $body = [
            'title' => $request->input('ticket'),
            'total' => $request->input('total'),
            'seat' => $request->input('seat'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'id' => $request->input('id'),
            'status' => $request->input('status'),
        ];
        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    // Code to handle removing an event ticket
    public function removeEventTicket(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all(),
            ], 422);
        }

        $endpoint = '/events/event-tickets/delete';
        $method = 'POST';
        $body = [
            'id' => $request->input('id'),
        ];

        $sending_status = "send-with-token";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
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

    // View the subscription page
    public function ensubscribe(Request $request)
    {
        $event_id = session('event_id');
        $creator_id = session('creator_id');

        $endpoint = '/event/get-even-info';
        $send_state = "free";

        $queryParams = [];
        $idata = [];

        if (!empty($event_id)) {
            $queryParams['id'] = $event_id;
            $queryParams['creator_id'] = $creator_id;
        }

        if ($request->has('title') && $request->has('email')) {
            $queryParams['title'] = $request->input('title');
            $queryParams['email'] = $request->input('email');
        }

        if (!empty($queryParams)) {
            $endpoint .= '?' . http_build_query($queryParams);
            $apiResponse = $this->getViewDataFromApi($endpoint, $send_state);
            $idata = $apiResponse['status'] ? $apiResponse['data'] : [];
        }

        Log::info('got: ' . json_encode($idata));
        // Log::info('got: ' . $event_id);

        if ($request->ajax()) {
            return response()->json(['info' => $idata]);
        }
        
        return view('frontend.en.subscription-payment', ['info' => $idata[0] ?? []]);
    }

    // Initializing payment for subscription
    public function paymentInitializeSubcription(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'email' => 'required|string',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['message' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $endpoint = '/subcription/initialize-payment';
        $method = 'POST';
        $body = [
            'email' => $request->input('email'),
            'event_title' => $request->input('title'),
            'callback' => route('subscription.callback'),
        ];
        $sending_status = "free";
        return $this->handleApiRequest($endpoint, $method, $body, $sending_status);
    }

    // the callback page for subscription
    public function subscriptionCallback(Request $request)
    {
        // Extract the reference from the URL
        $reference = $request->query('reference');
        if (!$reference) {
            return redirect()->route('en.event.subscribe');
        }

        // Prepare the API request
        $endpoint = '/subscription/verify-payment';
        $method = 'POST';
        $body = ['reference' => $reference];
        $sending_status = "free";

        $apiResponse = $this->handleApiRequest($endpoint, $method, $body, $sending_status);
        $apiResponseData = $apiResponse->getData(true);
        Log::info('Api response One ', [$apiResponseData]);

        // Check the status of the API response
        if ($apiResponseData['success']) {
            return view('frontend.en.subscription-callback', ['message' => $apiResponseData['message'], 'success' => true]);
        } else {
            //return view('frontend.en.subscription-payment');
            return redirect()->route('en.event.subscribe');
        }
    }


}
