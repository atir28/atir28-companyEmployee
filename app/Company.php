<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $table = 'company';

  public $primaryKey ='id'; // seeting id as primary key in company model

 public $timestamps = true;

}
