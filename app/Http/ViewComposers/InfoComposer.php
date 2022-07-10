<?php
namespace App\Http\ViewComposers;


use App\Repositories\Mysqls\AccountMysql;
use App\Repositories\Mysqls\AccountShopifyMysql;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class InfoComposer{
    protected $accountMysql;
    protected $shopifyMysql;
    public function __construct(AccountMysql $accountMysql,AccountShopifyMysql $shopifyMysql )
    {
        $this->accountMysql=$accountMysql;
        $this->shopifyMysql=$shopifyMysql;
    }
    public function compose(View $view){
        $id_account=Session::get('admin_id');
        $id_merchan=Session::get('merchan_id');
        if(isset($id_account)){
            $accounts=$this->accountMysql->findById($id_account);
            $nameUser=!isset($accounts->username) ? 'Admin':$accounts->username;
            return $view->with('info_name',$nameUser);
        }
        if(isset($id_merchan)){
            $shopifys=$this->shopifyMysql->findById($id_merchan);
            $nameUser=!isset($shopifys->name) ? 'MerChan':$shopifys->name;
            return $view->with('info_name',$nameUser);
        }
    
    }
}
?>