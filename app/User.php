<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\Rule;
use PhpParser\Builder\Class_;
use Carbon\Carbon;

class User extends Authenticatable
{
  use Notifiable;

  protected $fillable = [
      'name', 'email', 'password',
  ];

  protected $hidden = [
      'password', 'remember_token',
  ];

  public function posts()
  {
    return $this->hasMany('App\Post');
  }

  /*public function roles()
  {
    return $this->belongsToMany('App\Role');
  }*/
  public function role()
  {
    return $this->belongsTo('App\Role');
  }

  public function name()
  {
    return ucfirst($this->name);
  }

  public function contribution_time()
  {
    $dt = Carbon::now();
    $creation_date = new Carbon($this->created_at);
    $contribution = $dt->diffInSeconds($creation_date);
    return $contribution;
  }

  public function isCore()
  {
    return $this->role->name == "core";
  }

  public function isMain()
  {
    return $this->role->name == "main";
  }

  public function isNormal()
  {
    return $this->role->name == "normal";
  }

  public function isUnknown()
  {
    return $this->role->name == "" || $this->role->name == null;
  }

}
