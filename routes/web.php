<?php


// ... other routes
use App\Http\Controllers\CMS\CreateBackup;
use App\Http\Controllers\CMS\CMSBackupController;
use App\Http\Controllers\CMS\CMSLicenseKeysController;
use App\Http\Controllers\CMS\InstallationInfoController;
use App\Http\Controllers\CMS\PingController;
use App\Http\Controllers\CMS\NewInstallationController;
use App\Http\Controllers\CMS\ResetAdminPasswordController;
use App\Http\Controllers\CMS\TableController;
use App\Http\Controllers\DailyDigestController;
use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\FLSController;
use App\Http\Controllers\GetPFSenseBackups;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Search;
use App\Http\Controllers\CustomCSS;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

//TODO Re-write all shell scripts to php scripts? Maybe? There is a way we should do it for consistency

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/cms', function () {
    return view('cms_state');
})->middleware(['auth', 'verified'])->name('cms');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/search', [Search::class, 'search'])->name('search');
    Route::get('/explorer', [ExplorerController::class, 'index'])->name('explorer.index');
    Route::get('/profile/css', [CustomCSS::class, 'saveColorChoices'])->name('save.color.choices');
    Route::get('/explorer/{directory}', [ExplorerController::class, 'explorePath'])->where('directory', '.*')->name('explorer');
    Route::get('/download/{filePath}', [ExplorerController::class, 'download'])->where('filePath', '.*');

    Route::get('/flsForm', [FLSController::class, 'index'])->name('fls.form.submit');
    Route::get('/flsFormResult', [FLSController::class, 'result'])->name('fls.schedule.result');

    Route::get('/cmsBackup', [CMSBackupController::class, 'showContent'])->name('cmsBackups.showContent');
    Route::get('/cmsBackup/result', [CMSBackupController::class, 'progress'])->name('cmsBackups.progress');
    Route::get('/cmsBackup/newBackup', [CMSBackupController::class, 'startBackup'])->name('startBackup');

    Route::get('/dailyDigestSubmit', [DailyDigestController::class, 'index'])->name('dailyDigest.submit');
    Route::post('/dailyDigestResult', [DailyDigestController::class, 'result'])->name('dailyDigest.result');

    Route::get('/getPFSenseBackups', [GetPFSenseBackups::class, 'index'])->name('getPFSenseBackups.get');
    Route::get('/getPFSenseBackups/progress', [GetPFSenseBackups::class, 'progress'])->name('getPFSenseBackups.progress');

    Route::get('/vpn/start', function (){
        Artisan::call('app:start-vpn-command');
        return 'Starting VPN';
    })->name('vpn.start');

    Route::get('/vpn/stop', function (){
        Artisan::call('app:stop-vpn-command');
        return 'Stopping VPN';
    })->name('vpn.stop');

    Route::get('/get/table', [TableController::class, 'index'])->name('get.table');

    Route::get('/new/installation', [NewInstallationController::class, 'index'])->name('new.installation');
    Route::post('/submit-new-installation', [NewInstallationController::class, 'store'])->name('new.installation.submit');

    Route::get('/get/installation/{id}', [InstallationInfoController::class, 'index'])->name('get.installation.info');
    Route::post('/update/installation', [InstallationInfoController::class, 'update'])->name('update.installation.info');
//    Route::post('/delete/installation/{id}', [InstallationInfoController::class, 'delete'])->name('delete.installation.info');
    Route::get('/delete/installation/{id}', [InstallationInfoController::class, 'delete'])->name('delete.installation.info');

    //Route::put('/update/installation', [InstallationInfoController::class, 'update'])->name('update.installation.info'); TODO
    Route::get('/get/licenseKeys/{id}', [CMSLicenseKeysController::class, 'get_specific_license_keys'])->name('get.specific.license.keys')->where('id', '.*');
    Route::get('/get/licenseKeys', [CMSLicenseKeysController::class, 'get_all_license_keys'])->name('get.all.license.keys')->where('ip', '.*'); //TODO

    //Route::get('/reset/password/admin/{id}', [ResetAdminPasswordController::class, 'index'])->name('reset.password.admin');
    Route::get('/ping/{ip}', [PingController::class, 'index'])->name('check')->where('ip', '.*');

    Route::get('/CreateBackup/{floorName}', [CreateBackup::class, 'CreateBackup'])->name('CreateBackup');
});

require __DIR__.'/auth.php';

