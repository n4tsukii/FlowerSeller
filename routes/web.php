<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\SinglePageController;
use App\Http\Controllers\frontend\PostController as FrontendPostController;
use App\Http\Controllers\frontend\ProductController as FrontendProductController;
use App\Http\Controllers\frontend\ContactController as FrontendContactController;

use App\Http\Controllers\backend\AdminHomeController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ContactController as BackendContactController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\OrderdetailController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\ProductController as BackendProductController;
use App\Http\Controllers\backend\TopicController;
use App\Http\Controllers\backend\UserController;



//home 
Route::get('/',[HomeController::Class,'index'])->name('site.home');
//product
Route::get('/product',[FrontendProductController::Class,'index'])->name('site.product');;
Route::get('/chi-tiet-san-pham/{slug}',[FrontendProductController::Class,'product_detail'])->name('site.product.detail');;
//category
Route::get('danh-muc/{slug}',[FrontendProductController::Class,'category'])->name('site.product.category');
Route::get('danh-muc/hoa-tuoi', [FrontendProductController::class, 'category'])->defaults('slug', 'hoa-tuoi')->name('site.product.category.hoatuoi');
Route::get('tim-kiem', [FrontendProductController::class, 'search_product'])->name('site.product.search');
// Route::get('danh-muc/{slug}', [FrontendProductController::class, 'category'])->name('danh-muc.slug');

 //product brand
Route::get('thuong-hieu/{slug}', [FrontendProductController::class, 'brand'])->name('site.product.brand');

//post
Route::get('/bai-viet',[FrontendPostController::class,'index'])->name('site.post');
Route::get('/chi-tiet-bai-viet/{slug}',[FrontendPostController::Class,'post_detail'])->name('site.post.detail');


//topic
Route::get('chu-de/{slug}',[FrontendPostController::Class,'topic'])->name('site.post.topic');;
 
//contact
Route::get('/lien-he',[FrontendContactController::Class,'index'])->name('site.contact');;
Route::post('store',[FrontendContactController::Class,'store'])->name('site.contact.store');;

//cart
Route::get('gio-hang', [CartController::class, 'index'])->name('site.cart.index');
Route::get('cart/addcart', [CartController::class, 'addcart'])->name('site.cart.addcart');
Route::post('cart/update', [CartController::class, 'update'])->name('site.cart.update');
Route::get('cart/delete/{id}', [CartController::class, 'delete'])->name('site.cart.delete');
Route::get('thanh-toan', [CartController::class, 'checkout'])->name('site.cart.checkout');
Route::post('thong-bao', [CartController::class, 'docheckout'])->name('site.cart.docheckout');
// Dang nhap
Route::get("dang-nhap", [AuthController::class, "getlogin"])->name('website.getlogin');
Route::post("dang-nhap", [AuthController::class, "dologin"])->name('website.dologin');
Route::get("dang-xuat", [AuthController::class, "logout"])->name('website.logout');

// Dang ky
Route::get("dang-ky", [AuthController::class, "getSignup"])->name('website.getsignup');
Route::post("dang-ky", [AuthController::class, "doSignup"])->name('website.dosignup');

//siglepge
Route::get('trang-don/{link}', [FrontendPostController::class, 'single_page'])->name('trang-don.page');
 

Route::prefix('admin')->middleware("admin")->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.dashboard.index');
    // Backward compatibility alias
    Route::get('/home', [AdminHomeController::class, 'index'])->name('admin.home');
    //product
    Route::prefix('product')->group(function () {
        Route::get('/', [BackendProductController::class, 'index'])->name('admin.product.index');
        Route::get('trash', [BackendProductController::class, 'trash'])->name('admin.product.trash');
        Route::get('show/{id}', [BackendProductController::class, 'show'])->name('admin.product.show');
        Route::get('create', [BackendProductController::class, 'create'])->name('admin.product.create');
        Route::post('store', [BackendProductController::class, 'store'])->name('admin.product.store');
        Route::get('edit/{id}', [BackendProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('update/{id}', [BackendProductController::class, 'update'])->name('admin.product.update');
        Route::get('delete/{id}', [BackendProductController::class, 'delete'])->name('admin.product.delete');
        Route::get('restore/{id}', [BackendProductController::class,'restore'])->name('admin.product.restore');
        Route::delete('destroy/{id}', [BackendProductController::class, 'destroy'])->name('admin.product.destroy');
        Route::get('status/{id}', [BackendProductController::class, 'status'])->name('admin.product.status');
    });
    
    //category
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::get('trash', [CategoryController::class, 'trash'])->name('admin.category.trash');
        Route::get('show/{id}', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::post('store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
        Route::get('restore/{id}', [CategoryController::class,'restore'])->name('admin.category.restore');
        Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::get('status/{id}', [CategoryController::class, 'status'])->name('admin.category.status');
    });
    //banner
    Route::prefix('banner')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('admin.banner.index');
        Route::get('trash', [BannerController::class, 'trash'])->name('admin.banner.trash');
        Route::get('show/{id}', [BannerController::class, 'show'])->name('admin.banner.show');
        Route::get('create', [BannerController::class, 'create'])->name('admin.banner.create');
        Route::post('store', [BannerController::class, 'store'])->name('admin.banner.store');
        Route::get('edit/{id}', [BannerController::class, 'edit'])->name('admin.banner.edit');
        Route::put('update/{id}', [BannerController::class, 'update'])->name('admin.banner.update');
        Route::get('delete/{id}', [BannerController::class, 'delete'])->name('admin.banner.delete');
        Route::get('restore/{id}', [BannerController::class,'restore'])->name('admin.banner.restore');
        Route::delete('destroy/{id}', [BannerController::class, 'destroy'])->name('admin.banner.destroy');
        Route::get('status/{id}', [BannerController::class, 'status'])->name('admin.banner.status');

    });

    //brand
    Route::prefix('brand')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index');
        Route::get('trash', [BrandController::class, 'trash'])->name('admin.brand.trash');
        Route::get('show/{id}', [BrandController::class, 'show'])->name('admin.brand.show');
        Route::get('create', [BrandController::class, 'create'])->name('admin.brand.create');
        Route::post('store', [BrandController::class, 'store'])->name('admin.brand.store');
        Route::get('edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
        Route::put('update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
        Route::get('delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');
        Route::get('restore/{id}', [BrandController::class,'restore'])->name('admin.brand.restore');
        Route::delete('destroy/{id}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
        Route::get('status/{id}', [BrandController::class, 'status'])->name('admin.brand.status');

    });

    //contact
    Route::prefix('contact')->group(function () {
        Route::get('/', [BackendContactController::class, 'index'])->name('admin.contact.index');
        Route::get('trash', [BackendContactController::class, 'trash'])->name('admin.contact.trash');
        Route::get('show/{id}', [BackendContactController::class, 'show'])->name('admin.contact.show');
        Route::get('create', [BackendContactController::class, 'create'])->name('admin.contact.create');
        Route::post('store', [BackendContactController::class, 'store'])->name('admin.contact.store');
        Route::get('edit/{id}', [BackendContactController::class, 'edit'])->name('admin.contact.edit');
        Route::put('update/{id}', [BackendContactController::class, 'update'])->name('admin.contact.update');
        Route::get('delete/{id}', [BackendContactController::class, 'delete'])->name('admin.contact.delete');
        Route::get('restore/{id}', [BackendContactController::class,'restore'])->name('admin.contact.restore');
        Route::delete('destroy/{id}', [BackendContactController::class, 'destroy'])->name('admin.contact.destroy');
        Route::get('status/{id}', [BackendContactController::class, 'status'])->name('admin.contact.status');
    });

     //menu 
     Route::prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('admin.menu.index');
        Route::get('trash', [MenuController::class, 'trash'])->name('admin.menu.trash');
        Route::get('show/{id}', [MenuController::class, 'show'])->name('admin.menu.show');
        Route::get('create', [MenuController::class, 'create'])->name('admin.menu.create');
        Route::post('store', [MenuController::class, 'store'])->name('admin.menu.store');
        Route::get('edit/{id}', [MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::put('update/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
        Route::get('delete/{id}', [MenuController::class, 'delete'])->name('admin.menu.delete');
        Route::get('restore/{id}', [MenuController::class,'restore'])->name('admin.menu.restore');
        Route::delete('destroy/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
        Route::get('status/{id}', [MenuController::class, 'status'])->name('admin.menu.status');

    });

    //order
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
        Route::get('trash', [OrderController::class, 'trash'])->name('admin.order.trash');
        Route::get('show/{id}', [OrderController::class, 'show'])->name('admin.order.show');
        Route::get('create', [OrderController::class, 'create'])->name('admin.order.create');
        Route::post('store', [OrderController::class, 'store'])->name('admin.order.store');
        Route::get('edit/{id}', [OrderController::class, 'edit'])->name('admin.order.edit');
        Route::put('update/{id}', [OrderController::class, 'update'])->name('admin.order.update');
        Route::get('delete/{id}', [OrderController::class, 'delete'])->name('admin.order.delete');
        Route::get('restore/{id}', [OrderController::class,'restore'])->name('admin.order.restore');
        Route::delete('destroy/{id}', [OrderController::class, 'destroy'])->name('admin.order.destroy');
        Route::get('status/{id}', [OrderController::class, 'status'])->name('admin.order.status');

    });

    //orderdetail 
    Route::prefix('orderdetail')->group(function () {
        Route::get('/{id}', [OrderdetailController::class, 'index'])->name('admin.orderdetail.index');
        Route::get('trash', [OrderdetailController::class, 'trash'])->name('admin.orderdetail.trash');
        Route::get('show/{id}', [OrderdetailController::class, 'show'])->name('admin.orderdetail.show');
        Route::get('create', [OrderdetailController::class, 'create'])->name('admin.orderdetail.create');
        Route::post('store', [OrderdetailController::class, 'store'])->name('admin.orderdetail.store');
        Route::get('edit/{id}', [OrderdetailController::class, 'edit'])->name('admin.orderdetail.edit');
        Route::put('update/{id}', [OrderdetailController::class, 'update'])->name('admin.orderdetail.update');
        Route::get('delete/{id}', [OrderdetailController::class, 'delete'])->name('admin.orderdetail.delete');
        Route::get('restore/{id}', [OrderdetailController::class,'restore'])->name('admin.orderdetail.restore');
        Route::delete('destroy/{id}', [OrderdetailController::class, 'destroy'])->name('admin.orderdetail.destroy');
        Route::get('status/{id}', [OrderdetailController::class, 'status'])->name('admin.orderdetail.status');

    });

    //post 
    Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('admin.post.index');
    Route::get('trash', [PostController::class, 'trash'])->name('admin.post.trash');
    Route::get('show/{id}', [PostController::class, 'show'])->name('admin.post.show');
    Route::get('create', [PostController::class, 'create'])->name('admin.post.create');
    Route::post('store', [PostController::class, 'store'])->name('admin.post.store');
    Route::get('edit/{id}', [PostController::class, 'edit'])->name('admin.post.edit');
    Route::put('update/{id}', [PostController::class, 'update'])->name('admin.post.update');
    Route::get('delete/{id}', [PostController::class, 'delete'])->name('admin.post.delete');
    Route::get('restore/{id}', [PostController::class,'restore'])->name('admin.post.restore');
    Route::delete('destroy/{id}', [PostController::class, 'destroy'])->name('admin.post.destroy');
    Route::get('status/{id}', [PostController::class, 'status'])->name('admin.post.status');

    });

    //topic 
    Route::prefix('topic')->group(function () {
        Route::get('/', [TopicController::class, 'index'])->name('admin.topic.index');
        Route::get('trash', [TopicController::class, 'trash'])->name('admin.topic.trash');
        Route::get('show/{id}', [TopicController::class, 'show'])->name('admin.topic.show');
        Route::get('create', [TopicController::class, 'create'])->name('admin.topic.create');
        Route::post('store', [TopicController::class, 'store'])->name('admin.topic.store');
        Route::get('edit/{id}', [TopicController::class, 'edit'])->name('admin.topic.edit');
        Route::put('update/{id}', [TopicController::class, 'update'])->name('admin.topic.update');
        Route::get('delete/{id}', [TopicController::class, 'delete'])->name('admin.topic.delete');
        Route::get('restore/{id}', [TopicController::class,'restore'])->name('admin.topic.restore');
        Route::delete('destroy/{id}', [TopicController::class, 'destroy'])->name('admin.topic.destroy');
        Route::get('status/{id}', [TopicController::class, 'status'])->name('admin.topic.status');

    });
    //user  
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('trash', [UserController::class, 'trash'])->name('admin.user.trash');
        Route::get('show/{id}', [UserController::class, 'show'])->name('admin.user.show');
        Route::get('create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('update/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
        Route::get('restore/{id}', [UserController::class,'restore'])->name('admin.user.restore');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        Route::get('status/{id}', [UserController::class, 'status'])->name('admin.user.status');

    });
});;
