<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Authenticatable 
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'address', 'age', 'password', 'role', 'email_verified_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'enrollments');
    }


   
}
