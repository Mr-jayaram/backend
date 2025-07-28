<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Log;
use Hash;
class apiController extends Controller
{

  public function register(Request $request)
  {
       

          $user = DB::table('users')->insert([
              'name' => "jai",
              'email' =>"jai@demo.com",
              'password' => Hash::make("12345678"),
          ]);
          

          return response()->json([
              'name' => $user->name,
              'email' => $user->email,
          ]);
  }



  public function login(Request $request){
      $user = User::where('email', $request->email)->first(); 
  
      if (! $user || ! Hash::check($request->password, $user->password)) {
          return response()->json([
              'message' => 'incorrect',
          ]);
      }
      $user->tokens()->delete();

  
      return response()->json([
          'status' => 'success',
          'message' => 'login',
          'name' => $user->name,
          'token' => $user->createToken('auth_token')->plainTextToken,
      ]);
  }

  public function logout(Request $request){
    $request->user()->currentAccessToken()->delete();
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'User logged out successfully'
                ]);
}


  


    public function data(){

      $filghtData=DB::table('plains')->get();
        return response()->json($filghtData);
    }

    public function flight_data(Request $request){
         $data=$request->post('data'); 
        $filghtData=DB::table('plains')->where('slug',$data)->get();

        return response()->json($filghtData);
    }
}
