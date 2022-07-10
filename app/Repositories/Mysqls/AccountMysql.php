<?php
namespace App\Repositories\Mysqls;

use App\Models\Account;

class AccountMysql{
   function findByEmail($request){
        return Account::Where('email',$request->input('email'))->first();
   }
   function findById($id){
      return Account::Where('id',$id)->first();

   }
}