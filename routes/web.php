<?php
//admin
use App\Http\Controllers\admin\auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CrawlController;

// client
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\PostController;
use Illuminate\Support\Facades\Http;
// shopify
use App\Http\Controllers\shopify\LoginController as ShopifyLoginController;
use App\Http\Controllers\shopify\ProductController as ShopifyProducsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// check login
Route::prefix('/admin')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'checkLogin']);
    Route::get('/logout', [LoginController::class, 'logOutAdmin'])->name('admin.logout');
});
//admin(sẽ áp dụng check role)
Route::middleware(['checkLoginAdmin'])->prefix('/admin')->group(function () {
    // products
    Route::prefix('/products')->group(function () {
        Route::get('/list', [ProductsController::class, 'index'])->name('products.list');
        Route::post('/list', [ProductsController::class, 'index']);
        Route::get('/show/{id}', [ProductsController::class, 'show'])->name('products.show');
        Route::get('/add', [ProductsController::class, 'create'])->name('products.add');
        Route::post('/add', [ProductsController::class, 'store']);
        Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
        Route::post('/edit/{id}', [ProductsController::class, 'update']);
        //áp dụng ajax vào để delete tránh mã độc
        //Route::delete('/destroy',[ProductsController::class,'destroy']);
        // tạm thời fix cứng
        Route::get('/destroy/{id}', [ProductsController::class, 'destroy'])->name('products.delete');
    });

    // category
    Route::prefix('/category')->group(function () {
        //add
        Route::get('/list', [CategoryController::class, 'index'])->name('categorys.list');
        Route::post('/list', [CategoryController::class, 'store'])->name('categorys.add');

        //update
        Route::get('/list/{id}', [CategoryController::class, 'edit'])->name('categorys.edit');
        Route::post('/list/{id}', [CategoryController::class, 'update']);
        // áp dụng ajax vào để delete tránh mã độc
        // Route::delete('/destroy',[CategoryController::class,'destroy']);
        // tạm thời fix cứng
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('categorys.delete');
    });
    // dân trí
    Route::prefix('/crawls')->group(function () {
        Route::get('/', [CrawlController::class, 'index'])->name('crawls.list');
        Route::get('/edit/{id}', [CrawlController::class, 'edit'])->name('crawls.edit');
        Route::post('/edit/{id}', [CrawlController::class, 'update']);
        Route::delete('/destroy', [CrawlController::class, 'destroy'])->name('crawls.delete');
        Route::get('/show/{id}', [CrawlController::class, 'show'])->name('crawls.show');
    });
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});
//client

Route::prefix('/')->group(function () {
    Route::prefix('posts')->group(function () {
        Route::get('/list', [PostController::class, 'index'])->name('posts.list');
        Route::get('/show/{id}', [PostController::class, 'show'])->name('posts.show');
    });
   
    // fit cứng
   // Route::get('/', [HomeController::class, 'index']);
});
// shopify
Route::prefix('shopify')->group(function (){
    Route::prefix('/install')->group(function () {
        Route::get('/', [ShopifyLoginController::class, 'index'])->name('shopify.index');
        Route::post('/', [ShopifyLoginController::class, 'store']);
        // respon khi install success 
        Route::get('/res',[ShopifyLoginController::class, 'getData']);
    });
});
Route::middleware(['checkLoginAdmin'])->prefix('shopify')->group(function (){
    Route::prefix('product')->group(function (){
        Route::get('/list',[ShopifyProducsController::class,'index'])->name('shopify.product.list');
        Route::get('/add',[ShopifyProducsController::class,'create'])->name('shopify.product.add');
        Route::post('/add',[ShopifyProducsController::class,'store']);
        Route::get('/edit/{id}',[ShopifyProducsController::class,'show'])->name('shopify.product.edit');
        Route::post('/edit/{id}',[ShopifyProducsController::class,'update']);
        Route::post('/destroy',[ShopifyProducsController::class,'destroy'])->name('shopify.product.delete');
        
    });

});





