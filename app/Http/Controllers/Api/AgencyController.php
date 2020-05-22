<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Agency;
class AgencyController extends Controller
{
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]); 
         $credentials = request(['email', 'password']);  
            if(!Auth::guard('webagency')->attempt($credentials))
            return response()->json(['message' => 'Unauthorized' ], 401);
      $admin  = Auth::guard('webagency')->user();
        $tokenResult = $admin->createToken('Agency Access Token',['agency']);
        $token = $tokenResult->token;
        if ($request->remember_me)
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();        
        return response()->json(['message' => 'Successfully logged out']);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function agency(Request $request)
    {
        return response()->json($request->user());
    }
}