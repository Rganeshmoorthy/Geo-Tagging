<?php
 
namespace App;
 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


 
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use Notifiable;
    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','password','mobile_no','isadmin'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $table='georegister';
   /**public function isAdmin()
    {
        return $this->is_admin;
    }*/
    
    /**Add a mutator to ensure hashed passwords
     
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }*/
}