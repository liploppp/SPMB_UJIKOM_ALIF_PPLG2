<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class TestEmailController extends Controller
{
    public function sendTest(Request $request)
    {
        $email = $request->get('email', 'alifnurimam2007@gmail.com');
        
        try {
            Mail::to($email)->send(new TestEmail());
            return response()->json(['success' => true, 'message' => 'Email berhasil dikirim ke ' . $email]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
    
    public function testPage()
    {
        return view('test-email');
    }
}