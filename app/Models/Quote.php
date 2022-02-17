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
            case 'allExceptToday':
                $query->allExceptToday();
            break;
            case 'userQuotes':
                $query->userQuotes();
            break;
        }
    }

    public function scopeDaily($query)
    {
        $query->withUser()
            ->whereDate('created_at', Carbon::today());
    }

    public function scopeAllExceptToday($query)
    {
        $query->withUser()
            ->whereDate('created_at', '<', Carbon::today());
    }

    public function scopeUserQuotes($query)
    {
        $query->withUser()
            ->whereHas('users', function ($q) {
                $q->where('user_id', auth()->user()->id);
            });
    }

    public function scopeWithUser($query)
    {
        $query->select('id', 'author', 'quote')
            ->with('users');
    }
}
