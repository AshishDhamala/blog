<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Navigation extends Model
{
  protected $guarded = ['id'];

  public function shown_on()
  {
    return $this->admin ? "Admin" : "Public";
  }

  public function name()
  {
    return ucfirst($this->name);
  }

  public function admin()
  {
    return ($this->admin == 1) ? "Admin" : "Public";
  }

}
