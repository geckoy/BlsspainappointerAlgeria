<?php

namespace App\Models; // use App\Models\applicant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applicant extends Model
{
    use HasFactory;

    /**
     * serialize data
     *
     * @param  string  $value
     * @return void
     */
    public function setApplicantsAttribute($value)
    {
        $this->attributes['applicants'] = serialize($value);
    }

    /**
     * deserialize data.
     *
     * @param  string  $value
     * @return string
     */
    public function getApplicantsAttribute($value)
    {
        return unserialize($value);
    }
}
