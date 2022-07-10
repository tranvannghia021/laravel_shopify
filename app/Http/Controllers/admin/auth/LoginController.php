<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Repositories\Mysqls\AccountMysql;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

class LoginController extends Controller
{
    protected $accountMysql;
    public function __construct(AccountMysql $accountMysql)
    {
        $this->accountMysql = $accountMysql;
    }
    public function index()
    {
        if (FacadesSession::get('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.layouts.login');
    }
    public function checkLogin(Request $request)
    {
        $account = $this->accountMysql->findByEmail($request);

        if (!is_null($account)) {
            if (Hash::check($request->input('password'), $account->password)) {
                //save session
                $request->session()->put("admin_id", $account->id);

                if( $request->session()->has('merchan_id')){
                    $request->session()->forget('merchan_id');
                }

                return response()->json([
                    'error' => false,
                    'message' => 'Đăng nhập thành công!'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Mật khẩu không chính xác!'
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Tài khoản không tồn tại!'
            ]);
        }
    }
    public function logOutAdmin(Request $request)
    {
        if ($request->session()->has('admin_id') ||$request->session()->has('merchan_id') ) {
            $request->session()->flush();
        }

        return back();
    }
}
