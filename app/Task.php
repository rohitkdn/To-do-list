<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    // protected $table = 'tasks';

    use SoftDeletes;

    protected $fillable = [
        'task',
        'completed'
    ];

    protected $hidden = ['deleted_at'];

    protected $casts = [
        'completed' => 'bool'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }


    public function setCompletedAttribute ($val) {
        $this->attributes['completed'] = hash_equals('on', $val);
    }
}
