<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function saveAccount($args)
    {
        $response_obj = new \stdClass();
        // $id = $args['id'];
        try {
            $account = new self();
            $response_obj->message = 'Account was created successfully';
            $response_obj->error = false;
            $account->firstname = $args['firstname'];
            $account->lastname = $args['lastname'];
            $account->email = $args['email'];
            $account->position = $args['jobPosition'];
            $account->password = Hash::make($args['password']);
            $account->save();
        } catch (Exception $e) {
            Log::debug(print_r($e->getMessage(), true));
            $response_obj->error = true;
            $response_obj->message = $e->getMessage();
        } finally {
            return $response_obj;
        }
    }
}
