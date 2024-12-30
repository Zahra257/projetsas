<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
    protected $fillable = ['code','name', 'active', 'first_activation_date', 'activation_date', 'expiration_date', 'created_by', 'updated_by'];
   
    //get the users of this organisationId
    
    public function users()
    {
        return $this->hasMany(User::class, 'organisationId'); // Assuming the foreign key is `organisationId`
    }
    
   //many organisation created by one super admin 
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class, 'organisationId');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'organisationId');
    }
}
