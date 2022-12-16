<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class contract extends Model 
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contracts';

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
    protected $fillable = ['contract_name', 'currency', 'date_start', 'date_end', 'wages', 'pph21', 'food', 'transport', 'active', 'work_day', 'bpjs_category_id'];

}
