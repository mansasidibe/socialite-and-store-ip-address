<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;

class SocialController extends Controller
{
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

 public function handleProviderCallback($social)
   {
       $userSocial = Socialite::driver($social)->user();
       $user = User::where(['email' => $userSocial->getEmail()])->first();
       if($user){
           Auth::login($user);
           return redirect()->action('HomeController@index');
       }else{
           return view('auth.register',['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()]);
       }
    }

}
