<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\Admin\AdminResetPasswordLink;
use App\Services\AdminUserService\AdminUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    private $adminUserService;
    public function __construct(AdminUserService $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    public function login(Request $request) {
        if($request->isMethod('post')){
            try
            {
                $rules = [
                    'email'=> 'required|email',
                    'password'=>'required|min:8|max:16',
                ];
                $messages = [
                    'email.required'=> 'Email is required.',
                    'email.email'=> 'Please enter valid e-mail.',
                    'password.required'=> 'Password is required.',
                    'password.min'=> 'Password must be between 8 to 16 characters.',
                    'password.max'=> 'Password must be between 8 to 16 characters.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator);
                }

                $credentials = array('email'=> $request->email, 'password'=> $request->password);

                if(Auth::attempt($credentials))
                {
                    $notification = array(
                        'msg' => 'Admin user logged in successfully.',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('admin.dashboard')->with($notification);
                }
                else
                {
                    return redirect()->route('admin.login')->with('error', 'Invalid Credentials.');
                }

            }
            catch(\Exception $e)
            {
                return redirect()->back()->with('error','An error occurred. Try Again!');
            }
        }
        return view('backend.auth.login');
    }

    public function logout() {

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function forgotPassword(Request $request)
    {
        if($request->isMethod('post')){

            try {
                $rules = [
                    'email'=> 'required|email',
                ];
                $messages = [
                    'email.required'=> 'E-mail is required.',
                    'email.email'=> 'Please enter valid e-mail.',
                ];
                $validator = Validator::make($request->all(), $rules, $messages);
                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator);
                }

                $adminData = $this->adminUserService->getUserByEmail($request->email);
                if($adminData != null)
                {
                    // algorithm to creat token
                    $token = hash('sha256', time());

                    $data = [
                        'remember_token' => $token,
                    ];

                    $user = $this->adminUserService->updateUser($data, $adminData[0]->id);

                    $resetLink = url('admin/reset-password/'.$token. '/'. $adminData[0]->email);
                    // $subject = "Reset Password";
                    $message = "Please click on below link to reset your password" . "<br/><br/>";
                    $message.= "<a href='". $resetLink . "'>Click Here</a><br/>";

                    Mail::to($adminData[0]->email)->send(new AdminResetPasswordLink($message));

                    // dispatch(new SendForgetPasswordLinkMail($adminData[0]->email, $subject, $message));

                    $notification = array(
                        'msg' => 'Reset password link is sent to your email.',
                        'alert-type' => 'success'
                    );

                    return redirect()->back()->with($notification);
                }
                return redirect()->back()->with('error','Email Not Found.');
                //if(count($adminData) === 0) {

                // return redirect()->back()->with('error','Email Not Found.');
                // }


            }
            catch(\Exception $e){
                \Log::info($e->getMessage());

                \Log::info($e->getTrace());
                return redirect()->back()->with('error','An error occurred. Try Again!');

            }
        }
        return view('backend.auth.forgot_password');
    }

    public function resetPassword(Request $request, $token=null, $email=null)
    {
        if($request->isMethod('post')){
            try {
                $rules = [
                    'password' => 'required|min:8',
                    'password_confirmation' => 'required|same:password',
                    'email' => 'required|email',
                    'token' => 'required',
                ];
                $messages = [
                    'password.required'=> 'Password is required.',
                    'password.min'=> 'Password must be of minimum 8 characters.',
                    'password_confirmation.required'=> 'Confirm password is required',
                    'password_confirmation.same'=> 'Confirm password must be same as password.',
                    'email.required'=> 'E-mail is required',
                    'email.email'=> 'Please enter valid email.',
                    'token.required'=> 'Token is required',
                ];

                $validator = Validator::make($request->all(), $rules, $messages);
                if($validator->fails())
                {
                    redirect()->back()->withErrors($validator);
                }

                $admin = $this->adminUserService->getUserByTokenAndEmail($request->token, $request->email);

                if(count($admin) == 0) {
                    $notification = array(
                        'msg' => 'Token is expired.',
                        'alert-type' => 'warning'
                    );
                    return redirect()->route('admin.login')->with($notification);
                }

                $adminDataToUpdate = [
                    'password' => Hash::make($request->password),
                    'remember_token' => ''
                ];

                $this->adminUserService->updateUser($adminDataToUpdate, $admin[0]->id);
                $notification = array(
                    'msg' => 'Password reset successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.login')->with($notification);
            }
            catch(\Exception $e) {
                return redirect()->back()->with('error','An error occurred. Try Again!');
            }
        }
        $adminData = $this->adminUserService->getUserByTokenAndEmail($token,$email);

        if(!$adminData) {
            return redirect()->back()->with('error', 'Invalid email or token.');
        }
        return view('backend.auth.reset_password',compact('token', 'email'));
    }

}
