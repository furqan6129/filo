<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  /*
   * Relationship between Item and User
   * Item belongs to a User
   */
  public function lost(){
      return $this->belongsTo('App\User');
  }

}
