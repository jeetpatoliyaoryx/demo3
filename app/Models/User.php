<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Request;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    static public function getAdmin(){
        $return = self::select('users.*')
                    ->where('users.is_admin', '=', 0);
                   // ->where('users.is_delete', '=', 0)

                if(!empty(Request::get('id')))
                {
                    $return = $return->where('users.id', '=', Request::get('id'));
                }

                if(!empty(Request::get('name')))
                {
                    $return = $return->where('users.name','like','%'.Request::get('name').'%');
                }

                if(!empty(Request::get('email')))
                {
                    $return = $return->where('users.email','like','%'.Request::get('email').'%');
                }

                if(!empty(Request::get('status'))){
                    $status = Request::get('status');
                    if (Request::get('status') == '1000') {
                        $status = '0';
                    }
                    $return = $return->where('users.status', '=', $status);
                }
               


                $return = $return->orderBy('users.id', 'desc')
                ->paginate(50);;

        return $return;
    }

    static public function get_single($user_id)
    {
        return self::find($user_id);
    }


    static public function checkUserEmail($email)
    {
        return self::where('email', '=', $email)->first();
    }

    

    public function getImage()
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
                return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return url('backend/assets/images/user.png');   
        }
    }

    static public function getRecord($request)
    {
        return self::orderBy('id','desc')->paginate(25);
    }


}
