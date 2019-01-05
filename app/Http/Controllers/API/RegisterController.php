<?php
namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input                  = $request->all();
        $input['password']      = bcrypt($input['password']);

        /* Check Email Registered */
        $checkEmail             = User::where('email', '=', $input['email'])->get()->first();
        if ($checkEmail !== null) {
            return $this->sendError('Email Registered.');
        }

        $user                   = User::create($input);

        $access_token           = $user->createToken('MyApp')->accessToken;;
        $user->access_token     = $access_token;
        $user->save();

        $success['access_token'] = $access_token;
        $success['name']         = $user->name;


        return $this->sendResponse($success, 'User register successfully.');
    }
}
