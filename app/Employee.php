<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';

    public $primaryKey ='id'; // seeting id as primary key in employee model
  
   public $timestamps = true;

   public function company() //for use of foreign key company function is created
   {
     return $this->belongsTo('App\Company'); // belongs to means realtionship one to many relation. one comapny has many employee or inverse
   }
}
//App\companuy means the company fuction is redirect to comany model which in App folder
