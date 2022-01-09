<?php
namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * @inheritDoc
     */
    public function toResponse($request)
    {
        if(auth()->user()->tipe_user == "Admin"){
            $home = "/Admin/index";
        }else if(auth()->user()->tipe_user == "Pengusul"){
            $home = "/Pengusul/index";
        }else if(auth()->user()->tipe_user == "PBJ"){
            $home = "/PBJ/index";
        }else if(auth()->user()->tipe_user == "Validator"){
            $home = "/Validator/index";
        }
        return redirect()->intended($home);
    }
}