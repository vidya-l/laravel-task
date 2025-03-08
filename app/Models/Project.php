<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    /**
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     *
     * @return void
     */
    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }


    public function attributes()
    {
        return $this->hasManyThrough(AttributeValue::class, Attribute::class, 'entity_id', 'attribute_id');
    }


    public function dynamicAttributes()
    {
        return $this->hasMany(AttributeValue::class, 'entity_id');
    }
}
