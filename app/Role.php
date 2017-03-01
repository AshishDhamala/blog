<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $guarded = ['id'];

  /*public function users()
  {
    return $this->belongsToMany('App\User');
  }*/

  public function users() {
    return $this->hasMany('App\User');
  }

  public function name()
  {
    return ucfirst($this->name);
  }
}
