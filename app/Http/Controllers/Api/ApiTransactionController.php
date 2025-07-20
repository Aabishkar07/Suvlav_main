<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\TransactionPin;
use Illuminate\Http\Request;

class ApiTransactionController extends Controller
{
    public function addpin(Request $request, $id)
    {


        try {
            $member = Member::find($id);
            if (!$member) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            $t_pin = $request->pin;
            if (empty($t_pin)) {
                return response()->json([
                    'message' => 'Pin is required',
                ], 400);
            }

            TransactionPin::create([
                'user_id' => $member->id,
                'pin' => $t_pin,
                'status' => 'active',
            ]);

            return response()->json([
                'message' => 'PIN  successfully Added',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function checkpin($id)
    {
        try {
            $checkTransactionPin = TransactionPin::where('user_id', $id)->first();
            if (!$checkTransactionPin) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No PIN found for this user',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'PIN  successfully Found',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function changepin(Request $request, $id)
    {
        try {
            $allData = $request->all();
            $checkTransactionPin = TransactionPin::where('user_id', $id)->first();
            if (!$checkTransactionPin) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No PIN found for this user',
                ], 404);
            }
            if ($checkTransactionPin->pin != $allData['oldPin']) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Old PIN does not match',
                ], 200);
            }
            error_log(json_encode($allData));

            $checkTransactionPin->update([
                'pin' => $allData['newPin'],
            ]);

            return response()->json([
                'message' => 'PIN  successfully Updated',
            ], 200);
        } catch (\Exception $e) {
            error_log(json_encode($e->getMessage()));

            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }
    public function checkuser($unique_id)
    {
        try {
            $member = Member::where('unique_id', $unique_id)->first();
            if (!$member) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'data' => $member,
                'status' => 'success',
                'message' => 'User found successfully',
            ], 200);
        } catch (\Exception $e) {
            error_log(json_encode($e->getMessage()));

            return response()->json([
                'message' => 'An error occurred while processing your checkuser.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function checkuserpin(Request $request, $id)
    {
        $all = $request->all();
        error_log(json_encode($all));

        try {
            $member = Member::find($id);
            if (!$member) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            $t_pin = (int) $request->pin;
            if (empty($t_pin)) {
                return response()->json([
                    'message' => 'Pin is required',
                ], 400);
            }
            $checkpin = TransactionPin::where('user_id', $member->id)->where('pin', $t_pin)->first();

            if ($checkpin) {
                error_log(json_encode($checkpin));
                return response()->json([
                    'status' => 'success',
                    'message' => 'PIN successfully matched',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid PIN',
                ], 400);

            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function transferpoint(Request $request, $id)
    {
        $all = $request->all();
        error_log(json_encode($id));
        error_log(json_encode($all));
        // return false;
        try {
            $user_member = Member::where('id', $id)->first();
            $gain_member = Member::where('unique_id', $all["unique_id"])->first();

            if (!$user_member || !$gain_member) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found',
                ], 404);
            }
            if ($user_member->id == $gain_member->id) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You cannot transfer points to yourself',
                ], 400);
            }
            $user_member->total_points = $user_member->total_points - $all['coinamount'];
            $user_member->save();


            error_log(json_encode($user_member));

            $gain_member->total_points = $gain_member->total_points + $all['coinamount'];
            $gain_member->save();
            error_log(json_encode($gain_member));

            Notification::create(attributes: [
                'user_id' => $user_member->id,
                'message' => 'You has transferred Rs.' . $all['coinamount'] . ' coins to ' . $gain_member->name,
                'transferById' => $user_member->id,
                'gainById' => $gain_member->id,
                'transferBy' => $user_member->name,
                'gainBy' => $gain_member->name,
                'status' => 'unread',
                'check' => 0,
            ]);
            Notification::create(attributes: [
                'user_id' => $gain_member->id,
                'message' => $user_member->name . ' has transferred ' . $all['coinamount'] . ' coins to you.',
                'transferById' => $user_member->id,
                'gainById' => $gain_member->id,
                'transferBy' => $user_member->name,
                'gainBy' => $gain_member->name,
                'status' => 'unread',
                'check' => 0,
            ]);


            return response()->json([
                'status' => 'success',
                'message' => 'Coin successfully transferred',
            ], 200);
        } catch (\Exception $e) {
            error_log(json_encode($e->getMessage()));

            return response()->json([
                'message' => 'An error occurred while processing your checkuser.',
                'error' => $e->getMessage(),
            ], 500);
        }

    }

    public function getnotification($user_id)
    {
        try {
            $notifications = Notification::where('user_id', $user_id)->get();

            if ($notifications->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'status' => 'error',
                    'message' => 'No notifications found for this user',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'status' => 'success',
                'notifications' => $notifications,
            ], 200);
        } catch (\Exception $e) {
            error_log(json_encode($e->getMessage()));

            return response()->json([
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
