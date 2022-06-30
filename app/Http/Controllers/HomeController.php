<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\NewMember;
use Illuminate\Http\Request;
use App\Mail\NewMemberNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $isGuest = Auth::guest();
        
        if ($isGuest) {

            $checkSettings = Settings::orderBy('created_at', 'ASC')->count();
            
            if ($checkSettings > 0) {
                
                $settings = Settings::orderBy('created_at', 'ASC')->first();

                return view('NewMember', compact('settings'));

            } else {
                
                return redirect()->route('maintenance');

            }

        } else {
            
            return redirect()->route('dashboard');

        }

    }

    public function chekWaNumber($wa)
    {

        try {
            
            $number = $wa;
            $country_code = str_replace('0', '+62', substr($number, '0', '1'));
            $wa_number = $country_code . substr($number, 1, 14);
            
            $wa = NewMember::where('wa', $wa_number)->count();

            if ($wa > 0) {
                
                return response()->json([
                    $status = 200,
                    'error' => false,
                    'return' => false,
                    'message' => 'WhatsApp number alredy registered'
                ]);

            } else {
               
                return response()->json([
                    $status = 200,
                    'error' => false,
                    'return' => true,
                    'message' => 'WhatsApp number not registered'
                ]);

            }

        } catch (QueryException $e) {
            
            return response()->json([
                $status = 500,
                'error' => true,
                'return' => false,
                'message' => [
                    'Failed to check whatsapp number',
                    'script' => $e
                ]
            ]);

        }

    }

    public function checkEmail($email)
    {
        
        try {
            
            $email = NewMember::where('email', $email)->count();

            if ($email > 0) {

                return response()->json([
                    $status = 200,
                    'error' => false,
                    'return' => false,
                    'message' => 'Email alredy registered'
                ]);

            } else {
                
                return response()->json([
                    $status = 200,
                    'error' => false,
                    'return' => true,
                    'message' => 'Email not registered'
                ]);

            }

        } catch (QueryException $e) {
            
            return response()->json([
                $status = 500,
                'error' => true,
                'return' => false,
                'message' => [
                    'Failed to check email',
                    'script' => $e
                ]
            ]);

        }

    }

    public function saveNewMember(Request $request)
    {
        
        try {

            $link = Settings::orderBy('created_at', 'ASC')->select('whatsapp_group_link', 'discord_server_link')->first();

            $no = $request->wa;
            $country_code = str_replace('0', '+62', substr($no, '0', '1'));
            $wa_number = $country_code . substr($no, 1, 14);

            $newMember = [
                'nama' => $request->nama,
                'jurusan' => $request->jurusan,
                'wa' => $wa_number,
                'email' => $request->email,
                'alasan' => $request->alasan,
            ];

            $sessionDataHasRegistered = [
                'nama' => $request->nama,
                'email' => $request->email
            ];

            $memberName = $request->nama;

            Mail::to($request->email)
                ->send(new NewMemberNotification($memberName, $link));

            NewMember::create($newMember);

            session()->put('success', $sessionDataHasRegistered);

            return response()->json([
                $status = 201,
                'error' => false,
                'return' => true,
                'message' => 'Success, a new member has been added.'
            ]);
        
        } catch (QueryException $e) {
            
            return response()->json([
                $status = 500,
                'error' => true,
                'return' => false,
                'message' => [
                    'Failed to add new member.',
                    'script' => $e
                ]
            ]);

        }

    }

    public function resendLink(Request $request)
    {
        
        try {

            $checkMember = NewMember::where('email', $request->email)->count();

            if ($checkMember > 0) {
                
                $link = Settings::orderBy('created_at', 'ASC')
                        ->select('whatsapp_group_link', 'discord_server_link')->first();
            
                $member = NewMember::where('email', $request->email)->first();

                $memberName = $member->nama;

                Mail::to($request->email)->send(new NewMemberNotification($memberName, $link));

                return response()->json([
                    $status = 200,
                    'error' => false,
                    'return' => true,
                    'message' => 'Success resend notification.'
                ]);

            } else {
                
                return response()->json([
                    $status = 200,
                    'error' => false,
                    'return' => false,
                    'message' => 'Email not registered.'
                ]);

            }

        } catch (QueryException $e) {
            
            return response()->json([
                $status = 200,
                'error' => true,
                'return' => false,
                'message' => 'Failed to resend notification'
            ]);

        }

    }

    public function countDownTimer()
    {
        
        try {
            
            $settings = Settings::orderBy('created_at', 'ASC')
                    ->select('register_start_at', 'register_end_at')
                    ->first();

            $register_end_at = date('d F Y, H:i:s', strtotime($settings->register_end_at));

            $date_time_now = date('d F Y, H:i:s');

            $isRegisterEnd = $date_time_now > $register_end_at;

            return response()->json([
                $status = 200,
                'error' => false,
                'return' => true,
                'settings' => $settings,
                'isRegisterEnd' => $isRegisterEnd,
                'message' => 'Success'
            ]);

        } catch (QueryException $e) {
            
            return response()->json([
                $status = 500,
                'error' => true,
                'return' => false,
                'message' => [
                    'Failed to get settings',
                    'script' => $e
                ]
            ]);

        }

    }

    public function registerEndAt()
    {
        
        try {
            
            $settings = Settings::orderBy('created_at', 'ASC')->first();

            $register_end_at = date('d F Y, H:i:s', strtotime($settings->register_end_at));

            $date_time_now = date('d F Y, H:i:s');

            $isRegisterEnd = $date_time_now > $register_end_at;

            return response()->json([
                $status = 200,
                'error' => false,
                'return' => true,
                'data' => [
                    'isRegisterEnd' => $isRegisterEnd,
                    'register_end_at' => $settings->register_end_at,
                    'register_end_at_formated' => $register_end_at
                ],
                'message' => 'Success, data found'
            ]);

        } catch (QueryException $e) {
            
            return response()->json([
                $status = 500,
                'error' => true,
                'return' => false,
                'message' => [
                    'Data not found',
                    'script' => $e
                ]
            ]);

        }

    }

}
