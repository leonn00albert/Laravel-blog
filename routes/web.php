    <?php

    use Illuminate\Support\Facades\Route;

    use App\Models\Post;
    use \App\Models\Category;
    use \App\Models\User;
    use \App\Http\Controllers\PostsController;
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    Route::get('/',[PostsController::class,'index'])->name('home');
    Route::get('/posts/{post:slug}',[PostsController::class,'show'])->whereNumber(1);

    Route::get('/categories/{category:slug}', function (Category $category) {
        return view('welcome', [
            "posts" => $category->posts->load(["category", "author"])
        ]);
    })->whereNumber(1);

    Route::get('/authors/{author:username}', function (User $author) {
        return view('welcome', [
            "posts" => $author->posts->load(["category", "author"])
        ]);
    })->whereNumber(1);

    Route::get('/post', function () {
        return view('post');
    });
