<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bankAccount extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bank_accounts';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['account_number', 'bank_name', 'employee_id'];

    
}
