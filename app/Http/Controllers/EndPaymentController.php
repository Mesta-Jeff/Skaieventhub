<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class EndPaymentController extends Controller
{
    //
     // Payments
     public function viewPayment()
     {
         $payments = Payment::all();
         return response()->json($payments);
     }

     public function createPayment(Request $request)
     {
         $payment = Payment::create($request->only(['user_id', 'event_id', 'amount', 'status']));
         return response()->json($payment, 201);
     }

     public function updatePayment(Request $request)
     {
         $payment = Payment::find($request->id);
         if ($payment) {
             $payment->update($request->only(['user_id', 'event_id', 'amount', 'status']));
             return response()->json($payment);
         }
         return response()->json(['error' => 'Payment not found'], 404);
     }

     public function destroyPayment(Request $request)
     {
         $payment = Payment::find($request->id);
         if ($payment) {
             $payment->delete();
             return response()->json(['message' => 'Payment deleted']);
         }
         return response()->json(['error' => 'Payment not found'], 404);
    }

    public function sortPayment()
    {
        $payments = Payment::orderBy('amount', 'desc')->get();
        return response()->json($payments);
    }
 }


