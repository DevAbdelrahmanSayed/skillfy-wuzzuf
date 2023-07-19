<?php

use App\Http\Controllers\EmployeController;
use App\Http\Controllers\OpenAiController;
use App\Http\Controllers\SeekerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PostJopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JoplistingController;
use App\Http\Controllers\CompanyProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;

use App\Http\Controllers\FavoriteController;
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    $user = Auth::user();
    if ($user->user_type === 'seeker') {
        return redirect('/home/jobs');
    } else if ($user->user_type === 'employer') {
        return redirect('/dashboard');
    }
    return redirect('/home'); // Default redirect
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('register/seeker', [SeekerController::class, 'seekerCreate'])->name('seekers.create');
Route::post('register/seeker', [SeekerController::class, 'seekerStore'])->name('seeker.store');
Route::get('login', [SeekerController::class, 'showLogin'])->name('login.create');
Route::post('login', [SeekerController::class, 'storeLogin'])->name('login.store');
Route::get('logout', [SeekerController::class, 'logout'])->name('logout');



Route::get('register/employer', [EmployeController::class, 'createEmployer'])->name('employer.create');
Route::post('register/employer', [EmployeController::class, 'storeEmployer'])->name('employer.store');



Route::get('dashboard', [DashboardController::class, 'showDashboard'])->name('show.dashboard');
Route::get('verify', [DashboardController::class, 'verify'])->name('verification.notice');
Route::get('resend/email', [DashboardController::class, 'resend'])->name('email.resend');



Route::get('subscribe', [SubscriptionController::class, 'subscribeCreate'])->name('create.subscribe');
Route::get('subscribe/payment/weekly', [SubscriptionController::class, 'initiatePayment'])->name('pay.weekly');
Route::get('subscribe/payment/monthly', [SubscriptionController::class, 'initiatePayment'])->name('pay.monthly');
Route::get('subscribe/payment/yearly', [SubscriptionController::class, 'initiatePayment'])->name('pay.yearly');
Route::get('subscribe/payment/success', [SubscriptionController::class, 'paymentSuccess'])->name('payment.success');
Route::get('subscribe/payment/cancel', [SubscriptionController::class, 'paymentCancel'])->name('payment.cancel');



Route::resource('jop', PostJopController::class);



Route::get('profile', [ProfileController::class, 'createProfile'])->name('create.profile');
Route::put('profile/update', [ProfileController::class, 'updateProfile'])->name('update.profile');
Route::post('profile/password', [ProfileController::class, 'updatePassword'])->name('update.password');
Route::get('profile/seeker', [ProfileController::class, 'seekerProfile'])->name('create.seeker.profile');
Route::put('profile/seeker/resume', [ProfileController::class, 'updateResume'])->name('update.resume');
Route::get('profile/seeker/applied', [ProfileController::class, 'showApplied'])->name('show.applied');

Route::get('dashboard/application', [ApplicationController::class, 'createApplication'])->name('create.application');
Route::get('dashboard/application/{listing:slug}', [ApplicationController::class, 'showApplication'])->name('show.application');
Route::post('dashboard/application/{listingID}/{userID}', [ApplicationController::class, 'acceptedApplication'])->name('Accepted.application');
Route::put('dashboard/application/{listingID}/{userID}', [ApplicationController::class, 'rejectApplication'])->name('Reject.application');

Route::get('home/jobs', [JoplistingController::class, 'createJobs'])->name('create.jobs');
Route::get('home/jobs/show/{listing:slug}', [JoplistingController::class, 'showJobs'])->name('show.jobs');
Route::put('home/jobs/show/', [JoplistingController::class, 'updateJobsResume'])->name('update.post.resume');
Route::put('home/jobs/{listingID}/submit', [JoplistingController::class, 'submitJobsResume'])->name('submit.post.resume');

Route::get('company/{id}/profile', [CompanyProfileController::class, 'showCompany'])->name('show.company');

Route::get('home', function () {
    return view('home');
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);


Route::get('profile/seeker/contact', [\App\Http\Controllers\ContactController::class, 'showContact'])->name('show.contact');






Route::post('/posts/{post}/favorite', [FavoriteController::class, 'addFavorite'])->name('posts.favorite');

Route::DELETE('/posts/{post}/unfavorite',[FavoriteController::class, 'removeFavorite'] )->name('posts.UnFavorite');
Route::get('/posts/favorite',[FavoriteController::class, 'showFavorite'] )->name('show.Favorite');
