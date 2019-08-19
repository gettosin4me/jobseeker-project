<?php

namespace Jobseeker\App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public $fillable = ['id', 'first_name', 'middle_name', 'last_name', 'gender', 'date_of_birth', 'state_of_origin',
        'lga', 'address', 'mobile_number', 'email', 'password', 'course_of_study', 'highest_qualification', 'step_completed',
        'survey_total', 'is_admin', 'cv'     
    ];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'applications', 'applicant_id', 'job_id')
            ->withPivot(['id', 'status', 'canceled', 'created_at', 'updated_at']);
    }

    public function getCvPathAttribute()
    {
        if($this->cv == null) {
            return null;
        }

        return '/../../public/uploads/' . $this->cv;
    }
}