<?php
use App\Http\Livewire\User\DashboardReportExport as DashboardReportExport;
use App\Http\Middleware\EnsureOtpVerified;
use App\Livewire\Admin\Document as AdminDocument;
use App\Livewire\Admin\Recyclebin as AdminRecyclebin;
use App\Livewire\User\RecycleBin as RecycleBin;
use App\Livewire\Admin\Settings;
use App\Livewire\User\Document as UserDocument;
use App\Livewire\Admin\ApproveUser;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Login as AdminLogin;
use App\Livewire\User\BeneficiaryTable as BeneficiaryTable;
use App\Livewire\User\ReportingTable as ReportingTable;
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\User\Login as UserLogin;
use App\Livewire\User\Register as Register;
use App\Http\Controllers\ExportController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AICSExport;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

// Admin login route as default for root URL
Route::get('/', UserLogin::class)->name('user.login');

# User Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/user/register', Register::class)->name('user.register');
    Route::get('/user/login', UserLogin::class)->name('user.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', UserDashboard::class)->name('user.dashboard');
    Route::get('/user/document', UserDocument::class)->name('user.document');
    Route::get('/user/recyclebin', Recyclebin::class)->name('user.recyclebin');
    Route::get('/recycle-bin', RecycleBin::class)->name('recyclebin');
    Route::get('/user/beneficiary-table', BeneficiaryTable::class)->name('user.BeneficiaryTable');
    Route::get('/user/reporting', ReportingTable::class)->name('user.ReportingTable');
    Route::get('/export',[AICSExport::class, 'export'])->name('export') ;
    Route::prefix('user/dashboard')->group(function () {
        Route::get('/', UserDashboard::class)->name('user.dashboard');
        Route::post('/save-image', [UserDashboard::class, 'saveImage'])->name('user.dashboard.save-image');
        Route::get('/download-pdf/{reportId}', [UserDashboard::class, 'downloadPdf'])->name('user.dashboard.download-pdf');
    });
});

// Admin Routes
Route::middleware(['guest:admin'])->group(function () {
    Route::get('/admin/login', AdminLogin::class)->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard',  AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/users', ApproveUser::class)->name('admin.users');
    Route::get('/admin/document', AdminDocument::class)->name('admin.document');
    Route::get('/admin/recyclebin', Recyclebin::class)->name('admin.recyclebin');
    Route::get('/admin/settings', Settings::class)->name('admin.settings');
    Route::get('/documents/view/{id}', AdminDocument::class)->name('documents.view');
});

Route::get('/get-document-content/{documentId}', [AdminDocument::class, 'getDocumentContent'])
    ->name('get.document.content');

Route::get('/get-document-content/{documentId}', [UserDocument::class, 'getDocumentContent'])
    ->name('get.document.content');


