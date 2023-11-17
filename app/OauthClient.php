<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class OauthClient extends Model
{
    use HasApiTokens, Notifiable;
}
