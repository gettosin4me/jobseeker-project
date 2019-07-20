<?php

namespace Jobseeker\App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';
    protected $primaryKey = 'id';

    public $fillable = ['id', 'status', 'canceled', 'created_at', 'updated_at'];
}