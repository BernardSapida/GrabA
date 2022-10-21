<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use PragmaRX\Google2FA\Google2FA;
use App\Models\Helper;
use App\Models\Project;
use App\Models\OAuthHelper;
use App\Models\SwsReport;
use App\Notifications\MemberTemporaryPassword;
use Request;
use Str;
use Log;
use Mail;
use Hash;
use Crypt;
use DB;
use File;
use Auth;
use Exception;
use Notification;

class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password'];

    protected $table = 'users';
    protected $primaryKey = 'id';

    public function projects()
    {
        return $this->hasMany(Project::class, 'id', 'user_id');
    }

    public function checkBasicAuthentication($member)
    {
        $email = $member['email'];
        $password = $member['password'];
        $member = self::where('email', $email)->first();
        $helper = new Helper();
        $response_obj = new \stdClass();

        if ($member) {
            if (Hash::check($password, $member->password)) {
                $response_obj->error = false;
                $response_obj->message = 'Valid Credentials.';
                $response_obj->token = $member->createToken(
                    'Member Authentication'
                )->accessToken;
                $member->token = $response_obj->token;
                $member->save();
            } else {
                $response_obj->error = true;
                $response_obj->message = 'Invalid Credentials.';
                $response_obj->token = '';
            }
        } else {
            $response_obj->error = true;
            $response_obj->message = 'Your account does not exist.';
            $response_obj->token = '';
        }

        return $response_obj;
    }

    public function checkEmailHasOTP($email, $secret_key)
    {
        $member = self::where('email', $email)->first();
        if ($member) {
            if ($member->otp_key != null) {
                return $member->otp_key;
            } else {
                $member->otp_key = $secret_key;
                $member->save();
                return null;
            }
        } else {
            return null;
        }
    }

    public function checkGoogleAuthentication($member)
    {
        try {
            $response_obj = new \stdClass();
            $code = $member['code'];
            $secret_key = $member['secret_key'];
            $email = $member['email'];
            $password = $member['password'];
            $member_details = self::where('email', $email)->first();

            if ($member_details) {
                $google2fa = new Google2FA();
                $window = 8;
                $valid = $google2fa->verifyKey($secret_key, $code, $window);

                $credentials = [
                    'email' => $email,
                    'password' => $password,
                ];

                if (!$valid) {
                    $response_obj->error = true;
                    $response_obj->message = 'Invalid Authentication code';
                } else {
                    $logged_in = $this->checkBasicAuthentication($credentials);
                    if (!$logged_in->error) {
                        $access_token = $member_details->createToken(
                            'Member Authentication'
                        )->accessToken;
                        $member_details->token = $access_token;
                        $member_details->save();

                        $response_obj->error = false;
                        $response_obj->message = 'Valid Authentication code';
                        $response_obj->token = $member_details->token;
                        $response_obj->login_type = 'member';
                    }
                }
            } else {
                $response_obj->error = true;
                $response_obj->message = 'Cannot find your account';
            }
        } catch (\Exception $e) {
            Log::debug(print_r($e->getMessage(), true));
            $response_obj = new \StdClass();
            $response_obj->error = true;
            $response_obj->message = $e->getMessage();
        } finally {
            return $response_obj;
        }
    }

    public function getLoggedInMember()
    {
        $member = Auth::guard('member')->user();
        return $member;
    }

    public function changePassword($password)
    {
        $response_obj = new \stdClass();
        try {
            $user = Auth::user();
            if ($user) {
                $user->password = Hash::make($password);
                $user->save();

                $response_obj->error = false;
                $response_obj->message = 'Password changed successfully';
            }
        } catch (Exception $e) {
            Log::debug(print_r($e->getMessage(), true));
            $response_obj->error = true;
            $response_obj->message = $e->getMessage();
        } finally {
            return $response_obj;
        }
    }
}