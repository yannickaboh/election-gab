<?php

use App\Http\Controllers\RootController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [SiteController::class, 'accueil'])->name('accueil');
Route::get('/organisation/conseil-electoral', [SiteController::class, 'conseil'])->name('conseil');
Route::get('/organisation/direction-generale', [SiteController::class, 'direction'])->name('direction');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/documentation/rapports', [SiteController::class, 'rapport'])->name('rapport');
Route::get('/documentation/textes-et-lois', [SiteController::class, 'lois'])->name('lois');
Route::get('/medias/galerie', [SiteController::class, 'galerie'])->name('galerie');
Route::get('/medias/videos', [SiteController::class, 'video'])->name('video');
Route::get('/contacts', [SiteController::class, 'contact'])->name('contact');


Route::middleware(['auth'])->group(function () {

    ################################################################################################################
    #                                                                                                              #
    #   ROOT                                                                                                       #
    #                                                                                                              #
    ################################################################################################################

    /* Debut routage Root */

    /* Start Tableau de bord */
    Route::get('/dashboard/root', [RootController::class, 'rootHome'])->name('rootHome');
    /* End Tableau de bord */

    /* Start Profil */
    Route::get('/dashboard/root/profil', [RootController::class, 'rootProfil'])->name('rootProfil');
    Route::post('/dashboard/root/up-profil', [RootController::class, 'rootUpProfil'])->name('rootUpProfil');
    Route::post('/dashboard/root/up-avatar', [RootController::class, 'rootUpAvatar'])->name('rootUpAvatar');
    Route::post('/dashboard/root/up-password', [RootController::class, 'rootUpPassword'])->name('rootUpPassword');
    /* End Profil */

    /* Start Compte */
    Route::get('/dashboard/root/comptes', [RootController::class, 'rootCompte'])->name('rootCompte');
    Route::post('/dashboard/root/add-compte', [RootController::class, 'rootAddCompte'])->name('rootAddCompte');
    Route::post('/dashboard/root/edit-compte', [RootController::class, 'rootEditCompte'])->name('rootEditCompte');
    Route::post('/dashboard/root/avatar-compte', [RootController::class, 'rootAvatarCompte'])->name('rootAvatarCompte');
    Route::get('/dashboard/root/recherche-compte', [RootController::class, 'rootSearchCompte'])->name('rootSearchCompte');
    /* End Compte */

    /* Start Pays */
    Route::get('/dashboard/root/liste-des-pays', [RootController::class, 'rootPays'])->name('rootPays');
    Route::post('/dashboard/root/add-pays', [RootController::class, 'rootAddPays'])->name('rootAddPays');
    Route::post('/dashboard/root/flag-pays', [RootController::class, 'rootFlagPays'])->name('rootFlagPays');
    Route::post('/dashboard/root/edit-pays', [RootController::class, 'rootEditPays'])->name('rootEditPays');
    Route::get('/dashboard/root/recherche-pays', [RootController::class, 'rootSearchPays'])->name('rootSearchPays');
    /* End Pays */

    /* Start Province */
    Route::get('/dashboard/root/liste-des-provinces', [RootController::class, 'rootProvince'])->name('rootProvince');
    Route::post('/dashboard/root/add-province', [RootController::class, 'rootAddProvince'])->name('rootAddProvince');
    Route::post('/dashboard/root/edit-province', [RootController::class, 'rootEditProvince'])->name('rootEditProvince');
    Route::get('/dashboard/root/recherche-province', [RootController::class, 'rootSearchProvince'])->name('rootSearchProvince');
    /* End Province */

    /* Start Ville */
    Route::get('/dashboard/root/liste-des-villes', [RootController::class, 'rootVille'])->name('rootVille');
    Route::post('/dashboard/root/add-ville', [RootController::class, 'rootAddVille'])->name('rootAddVille');
    Route::post('/dashboard/root/edit-ville', [RootController::class, 'rootEditVille'])->name('rootEditVille');
    Route::get('/dashboard/root/recherche-ville', [RootController::class, 'rootSearchVille'])->name('rootSearchVille');
    /* End Ville */

    /* Start Centre */
    Route::get('/dashboard/root/centres-enrollement', [RootController::class, 'rootCentreEnroll'])->name('rootCentreEnroll');
    Route::get('/dashboard/root/centres-de-vote', [RootController::class, 'rootCentreVote'])->name('rootCentreVote');
    Route::post('/dashboard/root/add-centre', [RootController::class, 'rootAddCentre'])->name('rootAddCentre');
    Route::post('/dashboard/root/edit-centre', [RootController::class, 'rootEditCentre'])->name('rootEditCentre');
    Route::post('/dashboard/root/affect-centre', [RootController::class, 'rootAffectCentre'])->name('rootAffectCentre');
    Route::get('/dashboard/root/recherche-centre-enrollement', [RootController::class, 'rootSearchCentreEnroll'])->name('rootSearchCentreEnroll');
    Route::get('/dashboard/root/recherche-centre-de-vote', [RootController::class, 'rootSearchCentreVote'])->name('rootSearchCentreVote');
    /* End Centre */

    /* Start Bureau */
    Route::get('/dashboard/root/liste-des-bureaux', [RootController::class, 'rootBureau'])->name('rootBureau');
    Route::post('/dashboard/root/add-bureau', [RootController::class, 'rootAddBureau'])->name('rootAddBureau');
    Route::post('/dashboard/root/edit-bureau', [RootController::class, 'rootEditBureau'])->name('rootEditBureau');
    Route::post('/dashboard/root/affect-bureau', [RootController::class, 'rootAffectBureau'])->name('rootAffectBureau');
    Route::get('/dashboard/root/recherche-bureau', [RootController::class, 'rootSearchBureau'])->name('rootSearchBureau');
    /* End Bureau */

    /* Start Election */
    Route::get('/dashboard/root/elections', [RootController::class, 'rootElection'])->name('rootElection');
    Route::post('/dashboard/root/add-election', [RootController::class, 'rootAddElection'])->name('rootAddElection');
    Route::post('/dashboard/root/code-election', [RootController::class, 'rootCodeElection'])->name('rootCodeElection');
    Route::post('/dashboard/root/edit-election', [RootController::class, 'rootEditElection'])->name('rootEditElection');
    Route::get('/dashboard/root/recherche-election', [RootController::class, 'rootSearchElection'])->name('rootSearchElection');
    /* End Election */

    /* Start Enrollement Candidat */
    Route::get('/dashboard/root/enrollements-candidat', [RootController::class, 'rootCandidat'])->name('rootCandidat');
    Route::post('/dashboard/root/add-candidat', [RootController::class, 'rootAddCandidat'])->name('rootAddCandidat');
    Route::post('/dashboard/root/photo-candidat', [RootController::class, 'rootPhotoCandidat'])->name('rootPhotoCandidat');
    Route::post('/dashboard/root/edit-candidat', [RootController::class, 'rootEditCandidat'])->name('rootEditCandidat');
    Route::get('/dashboard/root/recherche-candidat', [RootController::class, 'rootSearchCandidat'])->name('rootSearchCandidat');
    /* End Enrollement Candidat */

    /* Start Enrollement Electeur */
    Route::get('/dashboard/root/enrollements-citoyen', [RootController::class, 'rootCitoyen'])->name('rootCitoyen');
    Route::post('/dashboard/root/add-citoyen', [RootController::class, 'rootAddCitoyen'])->name('rootAddCitoyen');
    Route::post('/dashboard/root/photo-citoyen', [RootController::class, 'rootPhotoCitoyen'])->name('rootPhotoCitoyen');
    Route::post('/dashboard/root/edit-citoyen', [RootController::class, 'rootEditCitoyen'])->name('rootEditCitoyen');
    Route::get('/dashboard/root/recherche-citoyen', [RootController::class, 'rootSearchCitoyen'])->name('rootSearchCitoyen');
    /* End Enrollement Electeur */

    /* Start Vote */
    Route::get('/dashboard/root/liste-des-votes', [RootController::class, 'rootVote'])->name('rootVote');
    Route::post('/dashboard/root/add-vote', [RootController::class, 'rootAddVote'])->name('rootAddVote');
    Route::get('/dashboard/root/recherche-vote', [RootController::class, 'rootSearchVote'])->name('rootSearchVote');
    /* End Vote */

    /* Start Resultat */
    Route::get('/dashboard/root/liste-des-resultats', [RootController::class, 'rootResultat'])->name('rootResultat');
    Route::get('/dashboard/root/recherche-resultat', [RootController::class, 'rootSearchResultat'])->name('rootSearchResultat');
    /* End Resultat */


});












//Clear Cache facade value:
Route::get('/key', function () {
    $exitCode = Artisan::call('key:generate');
    return '<h1>Key generated with success !</h1>';
});

//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cache cleared</h1>';
});

//Storage link:
Route::get('/link-storage', function () {
    $exitCode = Artisan::call('storage:link');
    return '<h1>Clear Config cache cleared</h1>';
});

//Clear Config cache:
Route::get('/proc-open-error', function () {
    $exitCode = Artisan::call('vendor:publish', ['--tag' => 'flare-config']);
    return '<h1>Proc open error resolved -> Think to change parameters in config/flare.php !!!</h1>';
});

//Storage route link
Route::get('/any-route', function () {
    $exitCode = Artisan::call('storage:link');
    echo $exitCode; // 0 exit code for no errors.
});


Auth::routes();


