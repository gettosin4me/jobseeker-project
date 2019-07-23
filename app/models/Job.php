<?php

namespace Jobseeker\App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $primaryKey = 'id';
    public $fillable = ['id', 'created_by_user_id', 'company', 'title', 'position', 'description', 'rate',
        'salary_range', 'total_candidate_needed', 'closing_date', 'minimum_qualification'    
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'applications', 'job_id', 'applicant_id')
            ->withPivot(['id', 'status', 'canceled', 'created_at', 'updated_at']);
    }
}