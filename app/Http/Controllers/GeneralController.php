<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeneralController extends Controller
{
    //

    // getting the events count statistics
    public function clientEventStatistics(Request $request)
    {
        try {
            // Check if creator_id is provided and not empty
            if ($request->has('creator_id') && !empty($request->input('creator_id'))) {
                $creator_id = $request->input('creator_id');

                // Build the query with aggregation
                $eventsQuery = DB::table('events as e')
                    ->select(
                        DB::raw('SUM(e.views) as views'), DB::raw('SUM(e.comments) as comments'),
                        DB::raw('SUM(e.likes) as likes'),DB::raw('SUM(e.stars) as stars')
                    )
                    ->where('e.is_deleted', 'No')
                    ->where('e.creator_id', $creator_id);

                // Get the aggregated statistics
                $events = $eventsQuery->first();

                return response()->json([
                    'success' => true,
                    'status_code' => 200,
                    'message' => 'Event statistics retrieved successfully',
                    'data' => $events
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'status_code' => 400,
                    'message' => 'creator id is required to proceed'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'An error occurred while retrieving event statistics',
                'error' => $e->getMessage()
            ]);
        }
    }


    // Getting event detailes for client
    public function clientPersonalEvents(Request $request)
    {

        try {
            // Check if creator_id is provided and not empty
            if ($request->has('creator_id') && !empty($request->input('creator_id'))) {
                $creator_id = $request->input('creator_id');

                // Build the query with aggregation
                $eventsQuery = DB::table('events as e')
                    ->join('event_types as et', 'e.event_type_id', '=', 'et.id')
                    ->select('e.id', 'e.event_title', 'e.aliases', 'et.event as event_type', 'et.created_at')
                    ->where('e.is_deleted', 'No')
                    ->where('e.creator_id', $creator_id);

                // Get the aggregated statistics
                $events = $eventsQuery->get();

                return response()->json([
                    'success' => true,
                    'status_code' => 200,
                    'message' => 'Event statistics retrieved successfully',
                    'data' => $events
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'status_code' => 400,
                    'message' => 'creator id is required to proceed'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'An error occurred while retrieving event statistics',
                'error' => $e->getMessage()
            ]);
        }
        
    }




}
