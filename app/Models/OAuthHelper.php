<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contacts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\Passport;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;

use Hash;
use Log;
use Session;
use Request;
use GuzzleHttp\Client;

use App\User;

class OAuthHelper extends Authenticatable
{
    use HasApiTokens, Notifiable;

    private $member_client_secret = '4hleIwgP7ZbWyLIRklsdUeoFx9QuOpGNTBn3kpFN';
    private $admin_client_secret = 'r8iCZLJwJhWG9hxuoMiuxsKGHw09UPOAdtFbqMLF';

    public function generateMemberToken($email, $password)
    {
        $client = new Client();
        try {
            $form_params = [
                'grant_type' => 'password',
                'client_id' => 3,
                'client_secret' => $this->member_client_secret,
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ];
            $response = $client
                ->post(url('/oauth/token'), [
                    'form_params' => $form_params,
                ])
                ->getBody()
                ->getContents();
            return $response;
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    public function generateAdminToken($email, $password)
    {
        $client = new Client();
        try {
            $form_params = [
                'grant_type' => 'password',
                'client_id' => 4,
                'client_secret' => $this->admin_client_secret,
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ];
            $response = $client
                ->post(url('/oauth/token'), [
                    'form_params' => $form_params,
                ])
                ->getBody()
                ->getContents();
            return $response;
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
        }
    }

    public function refreshAdminToken($refresh_token)
    {
        $client = new Client();
        $response_obj = new \stdClass();
        try {
            $response = $client
                ->post(url('oauth/token'), [
                    'form_params' => [
                        'grant_type' => 'refresh_token',
                        'refresh_token' => $refresh_token,
                        'client_id' => 4,
                        'client_secret' => $this->admin_client_secret,
                        'scope' => '',
                    ],
                ])
                ->getBody()
                ->getContents();
            $response_obj->response = $response;
            $response_obj->error = false;
        } catch (\Exception $e) {
            $response_obj->error = true;
            Log::debug($e->getMessage());
        } finally {
            return $response_obj;
        }
    }

    public function refreshMemberToken($refresh_token)
    {
        $client = new Client();
        $response_obj = new \stdClass();
        try {
            $response = $client
                ->post(url('oauth/token'), [
                    'form_params' => [
                        'grant_type' => 'refresh_token',
                        'refresh_token' => $refresh_token,
                        'client_id' => 3,
                        'client_secret' => $this->member_client_secret,
                        'scope' => '',
                    ],
                ])
                ->getBody()
                ->getContents();
            $response_obj->response = $response;
            $response_obj->error = false;
        } catch (\Exception $e) {
            $response_obj->error = true;
            Log::debug($e->getMessage());
        } finally {
            return $response_obj;
        }
    }
}
