<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends Controller{ 



    public function register(Request $request){
       

        
        $validator = Validator::make($request->all(), [

            "name" => "required|max:191",
            "email" => "required|email|max:191|unique:users,email",
            "password" =>   "required|min:8"

        ]);


        if($validator->fails()){

            return response()->json([
                'validation_errors' => $validator->messages(), 
                'message' => 'Sikertelen (Laravel)'
            ]);

            }else{


            $clean_name = strip_tags($request->input('name'));
            $clean_email = strip_tags($request->input('email'));



            $user = User::create([
                 'name' => $clean_name,   
                 'email' => $clean_email,   
                 'password' => Hash::make($request->password),   
            ]);

            $token = $user->createToken($user->email.'_Token')->plainTextToken;

            return response()->json([
                'status' => 200, 
                'username' => $user->name, 
                'token' => $token, 
                'message' => 'Sikeres (Laravel)'
            ]);

        }   

    }


    public function login(Request $request){

        $validator = Validator::make($request->all() ,[

            'email' => 'required|max:191',
            'password' => 'required',

        ]);


        if ($validator->fails()) {
            
         return response()->json([
        'validation_errors' => $validator->messages(), 
       
            ]); 


        }else{

        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
 
        return response()->json([
        'status' => 401, 
        'message' => 'Érvénytelen hitelesítő adatok', 
       
            ]);  

       }else{

         $token = $user->createToken($user->email.'_Token')->plainTextToken;

            return response()->json([
                'status' => 200, 
                'username' => $user->name, 
                'token' => $token, 
                'message' => 'Sikeres belépés(Laravel)'
            ]);
       }

        }

    }




    public function logout(Request $request){

        auth()->user()->tokens()->delete();
        return response()->json([

            'status' => 200,
            'message' => 'Sikeres kilépés'
        ]);
    }






   
}
