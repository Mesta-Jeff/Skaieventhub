<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EndPaymentController extends Controller
{
    // Payments
    public function viewPayment()
    {
        // Code to handle viewing payments
    }

    // Code to handle creating ticket payment payment
    public function initializeTicketPayment(Request $request)
    {
        try {
            $data = $request->validate([
                'ref_number' => 'required|string|max:255',
                'ipaddress' => 'required|string|max:25',
                'acc_number' => 'required|numeric|min:3',
                'acc_host' => 'required|string|min:3',
                'amount' => 'required|numeric|min:2',
                'ticket_id' => 'required|integer|exists:tickets,id',
                'user_id' => 'required|integer|exists:users,id',
            ]);

            $dbRequest = Payment::create($data);
            if ($dbRequest) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful',
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

    // Code to handle updating a payment status
    public function updateTicketPaymentStatus(Request $request)
    {
        $data = $request->validate([
            'ref_number' => 'required|string|max:30',
            'seat' => 'required|integer',
            'ticket_id' => 'required|integer|exists:tickets,id',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        DB::beginTransaction();

        try {
            // Update payment status
            $payment = Payment::where('ref_number', $data['ref_number'])->first();
            if (!$payment) {
                DB::rollBack();
                return response()->json([ 'success' => false, 'message' => 'Payment not found with the provided reference number', ], 404);
            }
            $payment->update(['status' => 'PAID']);

            // Update user ticket status
            $userTicket = UserTicket::where('ticket_id', $data['ticket_id']) ->where('user_id', $data['user_id']) ->where('seat', $data['seat']) ->first();

            if (!$userTicket) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'User ticket not found with the provided details',], 404);
            }
            $userTicket->update(['status' => 'PAID']);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Payment and ticket status updated successfully',], 200);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $e->errors(),], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,  'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function destroyPayment(Request $request)
    {
        // Code to handle deleting a payment
    }

    public function getPayment(Request $request)
    {
        // Code to handle getting a payment
    }
}



