<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'author',
        'quote'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->wherePivot('deleted_at', null);
    }

    public function getAddedAttribute()
    {
        return $this->users
            ->contains(auth()->user());
    }

    public function scopeScope($query, $scope)
    {
        switch($scope) {
            case 'daily':
                $query->daily();
            break;
        }
    }

    public function scopeDaily($query)
    {
        $query->select('id', 'author', 'quote')
            ->with('users')
            ->whereDate('created_at', Carbon::today());
    }
}
