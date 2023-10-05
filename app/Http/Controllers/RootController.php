<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

// Models
use App\Models\Bureau;
use App\Models\Centre;
use App\Models\Election;
use App\Models\Enrollement;
use App\Models\Mouchard;
use App\Models\Pays;
use App\Models\Province;
use App\Models\Resultat;
use App\Models\User;

// Utilitaires
use App\Models\Ville;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 


use Jenssegers\Agent\Facades\Agent;

class RootController extends Controller
{
    ################################################################################################################
    #                                                                                                              #
    #   TABLEAU DE BORD                                                                                            #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootHome(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Tableau de bord";
        $dash = "side-menu--active";

        $agents = User::where('role', 'Agent')->get();
        $admins = User::where('role', 'Admin')->get();
        $candidats = User::where('role', 'Candidat')->get();
        $electeurs = User::where('role', 'Electeur')->get();

        $centres_enrollement = Centre::where('type_centre', 'Enrollement')->get();
        $centres_vote = Centre::where('type_centre', 'Vote')->get();
        $bureaux = Bureau::all();

        $enrollements = Enrollement::where('role', 'Electeur')->get();

        $anneeEnCours = Carbon::now()->year;
        $election = Election::where('code', 'LIKE', '%' . $anneeEnCours . '%')->first();

        $mouchards = Mouchard::orderBy('id', 'DESC')->limit(6)->get();

        // Mouchard
        $this->mouchard(
            $this->getClientIPaddress(),
            $this->getOS(),
            $this->getBrowser(),
            "Acces Dashbord Root - " . Auth::user()->name . " * ",
            "Le root nommé " . Auth::user()->name . " a consulte son tableau de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
            $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
            depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."

        );



        return view('root.rootHome', compact(
            'app_name', 'page_title', 'dash',
            'agents', 'admins', 'candidats', 'electeurs', 
            'centres_enrollement', 'centres_vote', 'bureaux', 
            'enrollements', 'election', 'mouchards'
        ));
    }
    

    ################################################################################################################
    #                                                                                                              #
    #   MON PROFIL                                                                                                 #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootProfil(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Profil";
        $account = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Mouchard
        $this->mouchard(
            $this->getClientIPaddress(),
            $this->getOS(),
            $this->getBrowser(),
            "Acces Profil Root - " . Auth::user()->name . " * ",
            "Le root nommé " . Auth::user()->name . " a consulte son profil de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
            $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
            depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."

        );

        return view('root.rootProfil', compact(
            'page_title',
            'app_name',
            'root',
            'account', 
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootUpProfil(Request $request)
    {
        $root = User::find(Auth::user()->id);
        $root_id = Auth::user()->id;

        // Récupérer les données du formulaire
        $root->name = $request->input('name');
        $root->email = $request->input('email');
        $root->phone = $request->input('phone');
        $root->adresse = $request->input('adresse');
        $root->sexe = $request->input('sexe');

        // Mouchard
        $this->mouchard(
            $this->getClientIPaddress(),
            $this->getOS(),
            $this->getBrowser(),
            "Modification Profil Root - " . Auth::user()->name . " * ",
            "Le root nommé " . Auth::user()->name . " a modifie son profil de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
            $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
            depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."

        );

        if ($root->save()) {

            // Redirection
            return back()->with('success', 'Profil modifié avec succès !');
        }
        return back()->with('failed', 'Impossible de modifier votre profil !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootUpAvatar(Request $request)
    {
        // Récupérer utilisateur connecté
        $root = User::find(Auth::user()->id);
        $root_id = Auth::user()->id;

        // Récupérer le logo
        $image = $request->file('avatar');

        // Vérifier si le fichier n'est pas vide
        if ($image != null) {

            // Recuperer l'extension du fichier
            $ext = $image->getClientOriginalExtension();

            // Renommer le fichier
            $filename = rand(10000, 50000) . '.' . $ext;

            // Verifier les extensions
            if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'jfif') {

                // Upload le fichier
                if ($image->move(public_path('photos'), $filename)) {

                    // Attribuer l'url
                    $root->photo = url('photos') . '/' . $filename;

                    // Sauvegarde
                    if ($root->save()) {

                        // Mouchard
                        $this->mouchard(
                            $this->getClientIPaddress(),
                            $this->getOS(),
                            $this->getBrowser(),
                            "Modification Avatar Root - " . Auth::user()->name . " * ",
                            "Le root nommé " . Auth::user()->name . " a modifie son avatar de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
                            $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
                            depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."
                
                        );

                        // Redirection
                        return back()->with('success', 'Avatar modifiée avec succès !');
                    }
                    return back()->with('failed', 'Impossible de modifier votre avatar !');
                }
                return back()->with('failed', 'Imposible d\'uploader le fichier vers le répertoire défini !');
            }
            return back()->with('failed', 'L\'extension du fichier doit être soit du jpg ou du png !');
        }
        return back()->with('failed', 'Aucun fichier téléchargé. Veuillez réessayer svp !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootUpPassword(Request $request)
    {
        // Récupérer utilisateur connecté
        $root = User::find(Auth::user()->id);
        $root_id = Auth::user()->id;

        // Verifier si les mots de passe sont identiques
        if ($request->input('new_password') == $request->input('confirm_password')) {

            // Récupérer les données du formulaire
            if (Hash::check($request->input('old_password'), $root->password)) {

                // Preparer le mot de passe
                $root->password = Hash::make($request->input('new_password'));

                // Sauvergarder
                if ($root->save()) {

                    // Mouchard
                    $this->mouchard(
                        $this->getClientIPaddress(),
                        $this->getOS(),
                        $this->getBrowser(),
                        "Modification Mot de Passe Root - " . Auth::user()->name . " * ",
                        "Le root nommé " . Auth::user()->name . " a modifie son mot de passe de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
                        $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
                        depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."

                    );

                    // Redirection
                    return back()->with('success', 'Mot de passe modifié avec succès !');
                }
                return back()->with('failed', 'Impossible de modifier votre mot de passe !');
            }
            return back()->with('failed', 'Votre ancien mot de passe semble incorrect. Veuillez saisir le bon svp !');
        }
        return back()->with('failed', 'Les mots de passe ne sont pas identiques. Veuillez réessayer svp !');
    }
    
    
    ################################################################################################################
    #                                                                                                              #
    #   COMPTE                                                                                                     #
    #                                                                                                              #
    ################################################################################################################


    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootCompte(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Comptes";
        $account = "side-menu--active";
        $account_sub = "side-menu__sub-open";
        $account2 = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        $comptes = User::orderBy('id', 'DESC')->paginate(10);

        // Mouchard
        $this->mouchard(
            $this->getClientIPaddress(),
            $this->getOS(),
            $this->getBrowser(),
            "Acces Compte Root - " . Auth::user()->name . " * ",
            "Le root nommé " . Auth::user()->name . " a consulte gestion des comptes de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
            $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
            depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."

        );

        return view('root.rootCompte', compact(
            'page_title',
            'app_name',
            'root',
            'comptes',
            'account',
            'account_sub',
            'account2'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAddCompte(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        $user = new User();

        // Récupérer les données du formulaire
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->adresse = $request->input('adresse');
        $user->profession = $request->input('profession');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->active = $request->input('active');
        $user->sexe = $request->input('sexe');
        $user->photo = url('photos/avatar.png');

        if ($user->save()) {

            // Mouchard
            $this->mouchard(
                $this->getClientIPaddress(),
                $this->getOS(),
                $this->getBrowser(),
                "Ajout Compte Root - " . Auth::user()->name . " * ",
                "Le root nommé " . Auth::user()->name . " a ajoute le compte " . $user->name . " de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
                $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
                depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."
    
            );

            // Redirection
            return back()->with('success', 'Nouveau Compte cree avec succès !');

        } else {

            return back()->with('failed', 'Impossible de creer ce compte !');

        }
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAvatarCompte(Request $request)
    {
        // Récupérer utilisateur connecté
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get user by id
        $user = User::find($request->input('compte_id'));
        if (!empty($user)) {

            // Récupérer le logo
            $image = $request->file('avatar');

            // Vérifier si le fichier n'est pas vide
            if ($image != null) {

                // Recuperer l'extension du fichier
                $ext = $image->getClientOriginalExtension();

                // Renommer le fichier
                $filename = rand(10000, 50000) . '.' . $ext;

                // Verifier les extensions
                if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'jfif') {

                    // Upload le fichier
                    if ($image->move(public_path('photos'), $filename)) {

                        // Attribuer l'url
                        $user->photo = url('photos') . '/' . $filename;

                        // Sauvegarde
                        if ($user->save()) {

                            // Mouchard
                            $this->mouchard(
                                $this->getClientIPaddress(),
                                $this->getOS(),
                                $this->getBrowser(),
                                "Avatar Compte Root - " . Auth::user()->name . " * ",
                                "Le root nommé " . Auth::user()->name . " a modifie l'avatar du compte " . $user->name . " de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
                                $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
                                depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."
                    
                            );

                            // Redirection
                            return back()->with('success', 'Avatar modifiée avec succès !');
                        }
                        return back()->with('failed', 'Impossible de modifier votre avatar !');
                    }
                    return back()->with('failed', 'Imposible d\'uploader le fichier vers le répertoire défini !');
                }
                return back()->with('failed', 'L\'extension du fichier doit être soit du jpg ou du png !');
            }
            return back()->with('failed', 'Aucun fichier téléchargé. Veuillez réessayer svp !');
        }
        return back()->with('failed', 'Impossible de trouver ce compte !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootEditCompte(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get user by id
        $user = User::find($request->input('compte_id'));
        if (!empty($user)) {

            // Récupérer les données du formulaire
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->adresse = $request->input('adresse');
            $user->profession = $request->input('profession');
            $user->password = Hash::make($request->input('password'));
            $user->role = $request->input('role');
            $user->active = $request->input('active');
            $user->sexe = $request->input('sexe');

            if ($user->save()) {

                // Mouchard
                $this->mouchard(
                    $this->getClientIPaddress(),
                    $this->getOS(),
                    $this->getBrowser(),
                    "Modification Compte Root - " . Auth::user()->name . " * ",
                    "Le root nommé " . Auth::user()->name . " a modifie le compte " . $user->name . " de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
                    $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
                    depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."
        
                );

                // Redirection
                return back()->with('success', 'Compte modifié avec succès !');
            }
            return back()->with('failed', 'Impossible de modifier ce compte !');
        }
        return back()->with('failed', 'Impossible de trouver ce compte !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchCompte(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Compte";
        $account = "side-menu--active";
        $account_sub = "side-menu__sub-open";
        $account2 = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        $comptes = User::where('name', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('email', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('sexe', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('phone', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('role', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('adresse', 'LIKE', '%' . $request->input('q') . '%')
            ->simplePaginate(10);

            // Mouchard
            $this->mouchard(
                $this->getClientIPaddress(),
                $this->getOS(),
                $this->getBrowser(),
                "Recherche Compte Root - " . Auth::user()->name . " * ",
                "Le root nommé " . Auth::user()->name . " a recherche le compte par mot-cle " . $request->input('q') . " de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
                $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
                depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."
    
            );

        return view('root.rootCompte', compact(
            'page_title',
            'app_name',
            'root',
            'comptes',
            'account',
            'account_sub',
            'account2'
        ));
    }

    ################################################################################################################
    #                                                                                                              #
    #   PAYS                                                                                                       #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootPays(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Pays";
        $place = "side-menu--active";
        $place_sub = "side-menu__sub-open";
        $place1 = "side-menu--active";

        $countries = Pays::paginate(10);

        $root = Auth::user();
        $root_id = Auth::user()->id;


        return view('root.rootPays', compact(
            'page_title',
            'app_name',
            'countries',
            'place',
            'place_sub',
            'place1'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAddPays(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        $country = new Pays();

        // Récupérer les données du formulaire
        $country->code = $request->input('code');
        $country->libelle = $request->input('libelle');
        $country->flag = url('pays/drapeaux/drapeau.jpg');
        $country->active = $request->input('active');

        if ($country->save()) {

            // Redirection
            return back()->with('success', 'Nouveau Pays cree avec succès !');
        }
        return back()->with('failed', 'Impossible de creer ce pays !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootEditPays(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get pays by id
        $country = Pays::find($request->input('pays_id'));
        if (!empty($country)) {

            // Récupérer les données du formulaire
            $country->code = $request->input('code');
            $country->libelle = $request->input('libelle');
            $country->active = $request->input('active');

            if ($country->save()) {

                // Redirection
                return back()->with('success', 'Pays modifié avec succès !');
            }
            return back()->with('failed', 'Impossible de modifier ce pays !');
        }
        return back()->with('failed', 'Impossible de trouver ce pays !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootFlagPays(Request $request)
    {
        // Récupérer utilisateur connecté
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get projet by id
        $country = Pays::find($request->input('pays_id'));
        if (!empty($country)) {

            // Récupérer le logo
            $image = $request->file('image');

            // Vérifier si le fichier n'est pas vide
            if ($image != null) {

                // Recuperer l'extension du fichier
                $ext = $image->getClientOriginalExtension();

                // Renommer le fichier
                $filename = rand(10000, 50000) . '.' . $ext;

                // Verifier les extensions
                if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'jfif' || $ext == 'PNG') {

                    // Upload le fichier
                    if ($image->move(public_path('pays/drapeaux'), $filename)) {

                        // Attribuer l'url
                        $country->flag = url('pays/drapeaux') . '/' . $filename;

                        // Sauvegarde
                        if ($country->save()) {

                            // Redirection
                            return back()->with('success', 'Drapeau modifiée avec succès !');
                        }
                        return back()->with('failed', 'Impossible de modifier votre drapeau !');
                    }
                    return back()->with('failed', 'Imposible d\'uploader le fichier vers le répertoire défini !');
                }
                return back()->with('failed', 'L\'extension du fichier doit être soit du jpg ou du png !');
            }
            return back()->with('failed', 'Aucun fichier téléchargé. Veuillez réessayer svp !');
        }
        return back()->with('failed', 'Impossible de trouver ce pays !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchPays(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Pays";
        $place = "side-menu--active";
        $place_sub = "side-menu__sub-open";
        $place1 = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        $q = $request->input('q');

        $countries = Pays::where('code', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('libelle', 'LIKE', '%' . $request->input('q') . '%')
            ->paginate(10);

        return view('root.rootPays', compact(
            'page_title',
            'app_name',
            'countries',
            'place',
            'place_sub',
            'place1'
        ));
    }

    ################################################################################################################
    #                                                                                                              #
    #   PROVINCES                                                                                                  #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootProvince(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Provinces";
        $place = "side-menu--active";
        $place_sub = "side-menu__sub-open";
        $place2 = "side-menu--active";

        $provinces = Province::paginate(10);
        $countries = Pays::all();


        $root = Auth::user();
        $root_id = Auth::user()->id;


        return view('root.rootProvince', compact(
            'page_title',
            'app_name',
            'provinces',
            'countries',
            'place',
            'place_sub',
            'place2'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchProvince(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Provinces";
        $place = "side-menu--active";
        $place_sub = "side-menu__sub-open";
        $place2 = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        $q = $request->input('q');

        $provinces = Province::where('code', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('libelle', 'LIKE', '%' . $request->input('q') . '%')
            ->paginate(10);
        $countries = Pays::all();

        return view('root.rootProvince', compact(
            'page_title',
            'app_name',
            'provinces',
            'countries',
            'place',
            'place_sub',
            'place2'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAddProvince(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        $province = new Province();

        // Récupérer les données du formulaire
        $province->code = $request->input('code');
        $province->pays_id = $request->input('pays_id');
        $province->libelle = $request->input('libelle');
        $province->active = $request->input('active');

        if ($province->save()) {

            // Redirection
            return back()->with('success', 'Nouvelle Province créee avec succès !');
        }
        return back()->with('failed', 'Impossible de creer cette province !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootEditProvince(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get province by id
        $province = Province::find($request->input('province_id'));
        if (!empty($province)) {

            // Récupérer les données du formulaire
            $province->code = $request->input('code');
            $province->pays_id = $request->input('pays_id');
            $province->libelle = $request->input('libelle');
            $province->active = $request->input('active');

            if ($province->save()) {

                // Redirection
                return back()->with('success', 'Province modifiée avec succès !');
            }
            return back()->with('failed', 'Impossible de modifier cette province !');
        }
        return back()->with('failed', 'Impossible de trouver cette province !');
    }

    ################################################################################################################
    #                                                                                                              #
    #   VILLES                                                                                                     #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootVille(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Villes";
        $place = "side-menu--active";
        $place_sub = "side-menu__sub-open";
        $place3 = "side-menu--active";

        $villes = Ville::paginate(10);
        $provinces = Province::all();


        $root = Auth::user();
        $root_id = Auth::user()->id;


        return view('root.rootVille', compact(
            'page_title',
            'app_name',
            'villes',
            'provinces',
            'place',
            'place_sub',
            'place3'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchVille(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Villes";
        $place = "side-menu--active";
        $place_sub = "side-menu__sub-open";
        $place3 = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        $q = $request->input('q');

        $villes = Ville::where('code', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('libelle', 'LIKE', '%' . $request->input('q') . '%')
            ->paginate(10);
        $provinces = Province::all();

        return view('root.rootVille', compact(
            'page_title',
            'app_name',
            'villes',
            'provinces',
            'place',
            'place_sub',
            'place3'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAddVille(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        $ville = new Ville();

        // Récupérer les données du formulaire
        $ville->code = $request->input('code');
        $ville->province_id = $request->input('province_id');
        $ville->libelle = $request->input('libelle');
        $ville->active = $request->input('active');

        if ($ville->save()) {

            // Redirection
            return back()->with('success', 'Nouvelle Ville créee avec succès !');
        }
        return back()->with('failed', 'Impossible de creer cette ville !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootEditVille(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get ville by id
        $ville = Ville::find($request->input('ville_id'));
        if (!empty($ville)) {

            // Récupérer les données du formulaire
            $ville->code = $request->input('code');
            $ville->province_id = $request->input('province_id');
            $ville->libelle = $request->input('libelle');
            $ville->active = $request->input('active');

            if ($ville->save()) {

                // Redirection
                return back()->with('success', 'Ville modifiée avec succès !');
            }
            return back()->with('failed', 'Impossible de modifier cette ville !');
        }
        return back()->with('failed', 'Impossible de trouver cette ville !');
    }

    ################################################################################################################
    #                                                                                                              #
    #   CENTRES                                                                                                    #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootCentreEnroll(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Centres d'enrollement";
        $centr = "side-menu--active";
        $centr_sub = "side-menu__sub-open";
        $centr1 = "side-menu--active";

        $centres = Centre::where('type_centre', 'Enrollement')->paginate(10);
        $villes = Ville::all();
        $users = User::where('role', 'Admin')->get();


        $root = Auth::user();
        $root_id = Auth::user()->id;


        return view('root.rootCentreEnroll', compact(
            'page_title',
            'app_name',
            'centres',
            'villes',
            'users',
            'centr',
            'centr_sub',
            'centr1'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootCentreVote(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Centres de vote";
        $centr = "side-menu--active";
        $centr_sub = "side-menu__sub-open";
        $centr2 = "side-menu--active";

        $centres = Centre::where('type_centre', 'Vote')->paginate(10);
        $villes = Ville::all();
        $users = User::where('role', 'Admin')->get();


        $root = Auth::user();
        $root_id = Auth::user()->id;


        return view('root.rootCentreVote', compact(
            'page_title',
            'app_name',
            'centres',
            'villes',
            'users',
            'centr',
            'centr_sub',
            'centr2'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAddCentre(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        $centre = new Centre();

        // Récupérer les données du formulaire
        $centre->code = $request->input('code');
        $centre->type_centre = $request->input('type_centre');
        $centre->ville_id = $request->input('ville_id');
        $centre->libelle = $request->input('libelle');
        $centre->phone = $request->input('phone');
        $centre->adresse = $request->input('adresse');
        $centre->statut = 1;
        $centre->active = $request->input('active');

        if ($centre->save()) {

            // Redirection
            return back()->with('success', 'Nouveau Centre créee avec succès !');
        }
        return back()->with('failed', 'Impossible de creer ce centre !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootEditCentre(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get centre by id
        $centre = Centre::find($request->input('centre_id'));
        if (!empty($centre)) {

            // Récupérer les données du formulaire
            $centre->code = $request->input('code');
            $centre->type_centre = $request->input('type_centre');
            $centre->ville_id = $request->input('ville_id');
            $centre->libelle = $request->input('libelle');
            $centre->phone = $request->input('phone');
            $centre->adresse = $request->input('adresse');
            $centre->statut = 1;
            $centre->active = $request->input('active');

            if ($centre->save()) {

                // Redirection
                return back()->with('success', 'Centre modifiée avec succès !');
            }
            return back()->with('failed', 'Impossible de modifier ce centre !');
        }
        return back()->with('failed', 'Impossible de trouver ce centre !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAffectCentre(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get centre by id
        $centre = Centre::find($request->input('centre_id'));
        if (!empty($centre)) {

            // Check if this user is already affected
            $check_centres = Centre::where('responsable_id', $request->input('responsable_id'))->whereNot('id', $centre->id)->get();
            if(empty($check_centres)) {

                // Redirection
                return back()->with('failed', 'Cet agent a deja ete affecte dans un autre centre !');

            }

            // Récupérer les données du formulaire
            $centre->responsable_id = $request->input('responsable_id');

            if ($centre->save()) {

                // Redirection
                return back()->with('success', 'Affectation effectuee avec succès !');
            }
            return back()->with('failed', 'Impossible de soumettre cette affectation !');
        }
        return back()->with('failed', 'Impossible de trouver ce centre !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchCentreEnroll(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Centres >> Enrollement";
        $centr = "side-menu--active";
        $centr_sub = "side-menu__sub-open";
        $centr1 = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        $q = $request->input('q');

        $centres = Centre::where('type_centre', 'Enrollement')
            ->orWhere('code', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('libelle', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('phone', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('adresse', 'LIKE', '%' . $request->input('q') . '%')
            ->paginate(10);

        $villes = Ville::all();
        $users = User::where('role', 'Admin')->get();

        return view('root.rootCentreEnroll', compact(
            'page_title',
            'app_name',
            'centres',
            'villes',
            'users',
            'centr',
            'centr_sub',
            'centr1'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchCentreVote(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Centres >> Vote";
        $centr = "side-menu--active";
        $centr_sub = "side-menu__sub-open";
        $centr2 = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        $q = $request->input('q');

        $centres = Centre::where('type_centre', 'Vote')
            ->orWhere('code', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('libelle', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('phone', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('adresse', 'LIKE', '%' . $request->input('q') . '%')
            ->paginate(10);
            
        $villes = Ville::all();
        $users = User::where('role', 'Admin')->get();

        return view('root.rootCentreVote', compact(
            'page_title',
            'app_name',
            'centres',
            'villes',
            'users',
            'centr',
            'centr_sub',
            'centr2'
        ));
    }

    ################################################################################################################
    #                                                                                                              #
    #   BUREAUX                                                                                                    #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootBureau(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Bureaux de vote";
        $buro = "side-menu--active";

        $bureaux = Bureau::paginate(10);
        $centres = Centre::all();
        $users = User::where('role', 'Admin')->get();


        $root = Auth::user();
        $root_id = Auth::user()->id;


        return view('root.rootBureau', compact(
            'page_title',
            'app_name',
            'bureaux',
            'centres',
            'users',
            'buro'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchBureau(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Bureaux de vote";
        $buro = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        $q = $request->input('q');

        $bureaux = Bureau::where('code', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('libelle', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('type_bureau', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('adresse', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('phone', 'LIKE', '%' . $request->input('q') . '%')
            ->paginate(10);

        $centres = Centre::all();

        return view('root.rootBureau', compact(
            'page_title',
            'app_name',
            'bureaux',
            'centres',
            'buro'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAddBureau(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        $bureau = new Bureau();

        // Get ville's id
        $centre = Centre::find($request->input('centre_id'));

        // Récupérer les données du formulaire
        $bureau->code = $request->input('code');
        $bureau->type_bureau = $request->input('type_bureau');
        $bureau->centre_id = $request->input('centre_id');
        $bureau->ville_id = !empty($centre) ? $centre->ville_id : 0;
        $bureau->libelle = $request->input('libelle');
        $bureau->phone = $request->input('phone');
        $bureau->adresse = $request->input('adresse');
        $bureau->active = $request->input('active');

        if ($bureau->save()) {

            // Redirection
            return back()->with('success', 'Nouveau Bureau créee avec succès !');
        }
        return back()->with('failed', 'Impossible de creer ce bureau !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootEditBureau(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get bureau by id
        $bureau = Bureau::find($request->input('bureau_id'));
        if (!empty($bureau)) {

            // Get ville's id
            $centre = Centre::find($request->input('centre_id'));

            // Récupérer les données du formulaire
            $bureau->code = $request->input('code');
            $bureau->type_bureau = $request->input('type_bureau');
            $bureau->centre_id = $request->input('centre_id');
            $bureau->ville_id = !empty($centre) ? $centre->ville_id : 0;
            $bureau->libelle = $request->input('libelle');
            $bureau->phone = $request->input('phone');
            $bureau->adresse = $request->input('adresse');
            $bureau->active = $request->input('active');

            if ($bureau->save()) {

                // Redirection
                return back()->with('success', 'Bureau modifiée avec succès !');
            }
            return back()->with('failed', 'Impossible de modifier ce bureau !');
        }
        return back()->with('failed', 'Impossible de trouver ce bureau !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAffectBureau(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get bureau by id
        $bureau = Bureau::find($request->input('bureau_id'));
        if (!empty($bureau)) {

            // Check if this user is already affected
            $check_bureaux = Bureau::where('responsable_id', $request->input('responsable_id'))->whereNot('id', $bureau->id)->get();
            if(empty($check_bureaux)) {

                // Redirection
                return back()->with('failed', 'Cet agent a deja ete affecte dans un autre centre !');

            }

            // Récupérer les données du formulaire
            $bureau->responsable_id = $request->input('responsable_id');

            if ($bureau->save()) {

                // Redirection
                return back()->with('success', 'Affectation effectuee avec succès !');
            }
            return back()->with('failed', 'Impossible de soumettre cette affectation !');
        }
        return back()->with('failed', 'Impossible de trouver ce bureau !');
    }

    ################################################################################################################
    #                                                                                                              #
    #   ELECTION                                                                                                   #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootElection(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Election";
        $elec = "side-menu--active";

        $elections = Election::paginate(10);

        $root = Auth::user();
        $root_id = Auth::user()->id;


        return view('root.rootElection', compact(
            'page_title',
            'app_name',
            'elections',
            'elec'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAddElection(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        $election = new Election();

        // Récupérer les données du formulaire
        $election->code = $request->input('code');
        $election->libelle = $request->input('libelle');
        $election->type_election = $request->input('type_election');
        $election->date_debut = $request->input('date_debut');
        $election->date_fin = $request->input('date_fin');
        $election->code_electoral = $request->input('code_electoral');
        $election->active = $request->input('active');

        if ($election->save()) {

            // Redirection
            return back()->with('success', 'Nouvelle election creee avec succès !');
        }
        return back()->with('failed', 'Impossible de creer cette election !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootEditElection(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get election by id
        $election = Election::find($request->input('election_id'));
        if (!empty($election)) {

            // Récupérer les données du formulaire
            $election->code = $request->input('code');
            $election->libelle = $request->input('libelle');
            $election->type_election = $request->input('type_election');
            $election->date_debut = $request->input('date_debut');
            $election->date_fin = $request->input('date_fin');
            $election->code_electoral = $request->input('code_electoral');
            $election->active = $request->input('active');

            if ($election->save()) {

                // Redirection
                return back()->with('success', 'Election modifié avec succès !');
            }
            return back()->with('failed', 'Impossible de modifier cette election !');
        }
        return back()->with('failed', 'Impossible de trouver cette election !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootCodeElection(Request $request)
    {
        // Récupérer utilisateur connecté
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get election by id
        $election = Election::find($request->input('election_id'));
        if (!empty($election)) {

            // Récupérer le logo
            $image = $request->file('image');

            // Vérifier si le fichier n'est pas vide
            if ($image != null) {

                // Recuperer l'extension du fichier
                $ext = $image->getClientOriginalExtension();

                // Renommer le fichier
                $filename = 'code_electoral_' . rand(10000, 50000) . '.' . $ext;

                // Verifier les extensions
                if ($ext == 'pdf' || $ext == 'PDF') {

                    // Upload le fichier
                    if ($image->move(public_path('elections'), $filename)) {

                        // Attribuer l'url
                        $election->code_electoral_pdf = url('elections') . '/' . $filename;

                        // Sauvegarde
                        if ($election->save()) {

                            // Redirection
                            return back()->with('success', 'Code electoral soumis avec succès !');
                        }
                        return back()->with('failed', 'Impossible de modifier votre code electoral !');
                    }
                    return back()->with('failed', 'Imposible d\'uploader le fichier vers le répertoire défini !');
                }
                return back()->with('failed', 'L\'extension du fichier doit être soit du pdf !');
            }
            return back()->with('failed', 'Aucun fichier téléchargé. Veuillez réessayer svp !');
        }
        return back()->with('failed', 'Impossible de trouver ce pays !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchElection(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Election";
        $elec = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        $q = $request->input('q');

        $elections = Election::where('code', 'LIKE', '%' . $request->input('q') . '%')
            ->orWhere('libelle', 'LIKE', '%' . $request->input('q') . '%')
            ->paginate(10);

        return view('root.rootElection', compact(
            'page_title',
            'app_name',
            'elections',
            'elec'
        ));
    }

    ################################################################################################################
    #                                                                                                              #
    #   ENROLLEMENT CANDIDAT                                                                                       #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootCandidat(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Enrollements Candidature";
        $enrol = "side-menu--active";
        $enrol_sub = "side-menu__sub-open";
        $enrol1 = "side-menu--active";

        $candidatures = Enrollement::where('role', 'Candidat')->paginate(10);
        $elections = Election::all();
        $centres = Centre::where('type_centre', 'Enrollement')->get();
        $bureaux = Bureau::all();


        $root = Auth::user();
        $root_id = Auth::user()->id;


        return view('root.rootCandidat', compact(
            'page_title',
            'app_name',
            'candidatures',
            'elections',
            'centres',
            'bureaux',
            'enrol',
            'enrol_sub',
            'enrol1'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAddCandidat(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        $user = new User();

        // Récupérer les données du formulaire
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->adresse = $request->input('adresse');
        $user->profession = $request->input('profession');
        $user->parti_politique = $request->input('parti_politique');
        $user->programme_parti_politique = $request->input('programme_parti_politique');
        $user->date_naissance = $request->input('date_naissance');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->active = 1;
        $user->sexe = $request->input('sexe');
        $user->photo = url('photos/avatar.png');

        if ($user->save()) {

            // Create new enrollement here !
            $candidat = new Enrollement();

            // Récupérer les données du formulaire
            $candidat->code = Carbon::now()->timestamp;
            $candidat->candidat_id = $user->id;
            $candidat->election_id = $request->input('election_id');
            $candidat->centre_id = $request->input('centre_id');
            $candidat->citoyen_id = $user->id;
            $candidat->role = 'Candidat';
            $candidat->statut = 0;
            $candidat->active = 1;

            if ($candidat->save()) {

                // Redirection
                return back()->with('success', 'Nouveau Candidature soumise avec succès !');

            } else {

                return back()->with('failed', 'Impossible de soumettre cette candidature !');

            }

        } else {

            return back()->with('failed', 'Impossible de soumettre cet enrollement !');

        }
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootPhotoCandidat(Request $request)
    {
        // Récupérer utilisateur connecté
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get user by id
        $user = User::find($request->input('candidat_id'));
        if (!empty($user)) {

            // Récupérer le logo
            $image = $request->file('avatar');

            // Vérifier si le fichier n'est pas vide
            if ($image != null) {

                // Recuperer l'extension du fichier
                $ext = $image->getClientOriginalExtension();

                // Renommer le fichier
                $filename = rand(10000, 50000) . '.' . $ext;

                // Verifier les extensions
                if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'jfif') {

                    // Upload le fichier
                    if ($image->move(public_path('photos'), $filename)) {

                        // Attribuer l'url
                        $user->photo = url('photos') . '/' . $filename;

                        // Sauvegarde
                        if ($user->save()) {

                            // Redirection
                            return back()->with('success', 'Avatar modifiée avec succès !');
                        }
                        return back()->with('failed', 'Impossible de modifier votre avatar !');
                    }
                    return back()->with('failed', 'Imposible d\'uploader le fichier vers le répertoire défini !');
                }
                return back()->with('failed', 'L\'extension du fichier doit être soit du jpg ou du png !');
            }
            return back()->with('failed', 'Aucun fichier téléchargé. Veuillez réessayer svp !');
        }
        return back()->with('failed', 'Impossible de trouver cet enrollement !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootEditCandidat(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get user by id
        $user = User::find($request->input('candidat_id'));
        if (!empty($user)) {

            // Récupérer les données du formulaire
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->adresse = $request->input('adresse');
            $user->profession = $request->input('profession');
            $user->parti_politique = $request->input('parti_politique');
            $user->programme_parti_politique = $request->input('programme_parti_politique');
            $user->date_naissance = $request->input('date_naissance');
            $user->password = Hash::make($request->input('password'));
            $user->role = $request->input('role');
            $user->active = $request->input('active');
            $user->sexe = $request->input('sexe');

            if ($user->save()) {

                // Get user by id
                $candidat = Enrollement::find($request->input('enrollement_id'));
                if (!empty($candidat)) {

                    // Get bureau here
                    $bureau = Bureau::find($request->input('bureau_id'));
        
                    // Récupérer les données du formulaire
                    $candidat->code = Carbon::now()->timestamp;
                    $candidat->candidat_id = $user->id;
                    $candidat->election_id = $request->input('election_id');
                    $candidat->centre_id = $request->input('centre_id');
                    $candidat->citoyen_id = $user->id;
                    $candidat->role = 'Candidat';
                    $candidat->statut = 0;
                    $candidat->active = 1;
        
                    if ($candidat->save()) {
        
                        // Redirection
                        return back()->with('success', 'Nouveau Candidature modifiee avec succès !');
        
                    } else {
        
                        return back()->with('failed', 'Impossible de modifier cette candidature !');
        
                    }

                } else {
        
                    return back()->with('failed', 'Impossible de modifier cette candidature !');

                }
                
            }
            return back()->with('failed', 'Impossible de modifier cet enrollement !');
        }
        return back()->with('failed', 'Impossible de trouver cet enrollement !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchCandidat(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Enrollements Candidature";
        $enrol = "side-menu--active";
        $enrol_sub = "side-menu__sub-open";
        $enrol1 = "side-menu--active";

        $candidatures = Enrollement::where('role', 'Candidat')
        ->where('code', 'LIKE', '%' . $request->input('q') . '%')
        ->paginate(10);
        $elections = Election::all();
        $centres = Centre::where('type_centre', 'Enrollement')->get();
        $bureaux = Bureau::all();


        $root = Auth::user();
        $root_id = Auth::user()->id;


        return view('root.rootCandidat', compact(
            'page_title',
            'app_name',
            'candidatures',
            'elections',
            'centres',
            'bureaux',
            'enrol',
            'enrol_sub',
            'enrol1'
        ));
    }

    ################################################################################################################
    #                                                                                                              #
    #   ENROLLEMENT CITOYEN                                                                                        #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootCitoyen(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Enrollements Electeur";
        $enrol = "side-menu--active";
        $enrol_sub = "side-menu__sub-open";
        $enrol2 = "side-menu--active";

        $candidatures = Enrollement::where('role', 'Electeur')->paginate(10);
        $elections = Election::all();
        $centres = Centre::where('type_centre', 'Enrollement')->get();
        $bureaux = Bureau::all();


        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Mouchard
        $this->mouchard(
            $this->getClientIPaddress(),
            $this->getOS(),
            $this->getBrowser(),
            "Citoyen Dashbord Root - " . Auth::user()->name . " * ",
            "Le root nommé " . Auth::user()->name . " a consulte l'espace citoyen bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
            $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
            depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."

        );


        return view('root.rootCitoyen', compact(
            'page_title',
            'app_name',
            'candidatures',
            'elections',
            'centres',
            'bureaux',
            'enrol',
            'enrol_sub',
            'enrol2'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAddCitoyen(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        $user = new User();

        // Récupérer les données du formulaire
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->adresse = $request->input('adresse');
        $user->profession = $request->input('profession');
        $user->date_naissance = $request->input('date_naissance');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->active = 1;
        $user->sexe = $request->input('sexe');
        $user->photo = url('photos/avatar.png');

        if ($user->save()) {

            // Create new enrollement here !
            $candidat = new Enrollement();

            // Récupérer les données du formulaire
            $candidat->code = Carbon::now()->timestamp;
            $candidat->candidat_id = $user->id;
            $candidat->election_id = $request->input('election_id');
            $candidat->centre_id = $request->input('centre_id');
            $candidat->citoyen_id = $user->id;
            $candidat->role = 'Electeur';
            $candidat->statut = 0;
            $candidat->active = 1;

            if ($candidat->save()) {

                // Redirection
                return back()->with('success', 'Nouveau Electeur soumise avec succès !');

            } else {

                return back()->with('failed', 'Impossible de soumettre cet electeur !');

            }

        } else {

            return back()->with('failed', 'Impossible de soumettre cet enrollement !');

        }
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootPhotoCitoyen(Request $request)
    {
        // Récupérer utilisateur connecté
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get user by id
        $user = User::find($request->input('candidat_id'));
        if (!empty($user)) {

            // Récupérer le logo
            $image = $request->file('avatar');

            // Vérifier si le fichier n'est pas vide
            if ($image != null) {

                // Recuperer l'extension du fichier
                $ext = $image->getClientOriginalExtension();

                // Renommer le fichier
                $filename = rand(10000, 50000) . '.' . $ext;

                // Verifier les extensions
                if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'jfif') {

                    // Upload le fichier
                    if ($image->move(public_path('photos'), $filename)) {

                        // Attribuer l'url
                        $user->photo = url('photos') . '/' . $filename;

                        // Sauvegarde
                        if ($user->save()) {

                            // Redirection
                            return back()->with('success', 'Avatar modifiée avec succès !');
                        }
                        return back()->with('failed', 'Impossible de modifier votre avatar !');
                    }
                    return back()->with('failed', 'Imposible d\'uploader le fichier vers le répertoire défini !');
                }
                return back()->with('failed', 'L\'extension du fichier doit être soit du jpg ou du png !');
            }
            return back()->with('failed', 'Aucun fichier téléchargé. Veuillez réessayer svp !');
        }
        return back()->with('failed', 'Impossible de trouver cet enrollement !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootEditCitoyen(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get user by id
        $user = User::find($request->input('candidat_id'));
        if (!empty($user)) {

            // Récupérer les données du formulaire
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->adresse = $request->input('adresse');
            $user->profession = $request->input('profession');
            $user->date_naissance = $request->input('date_naissance');
            $user->password = Hash::make($request->input('password'));
            $user->role = $request->input('role');
            $user->active = $request->input('active');
            $user->sexe = $request->input('sexe');

            if ($user->save()) {

                // Get user by id
                $candidat = Enrollement::find($request->input('enrollement_id'));
                if (!empty($candidat)) {

                    // Get bureau here
                    $bureau = Bureau::find($request->input('bureau_id'));
        
                    // Récupérer les données du formulaire
                    $candidat->code = Carbon::now()->timestamp;
                    $candidat->candidat_id = $user->id;
                    $candidat->election_id = $request->input('election_id');
                    $candidat->centre_id = $request->input('centre_id');
                    $candidat->citoyen_id = $user->id;
                    $candidat->role = 'Electeur';
                    $candidat->statut = 0;
                    $candidat->active = 1;
        
                    if ($candidat->save()) {
        
                        // Redirection
                        return back()->with('success', 'Nouvel Electeur modifiee avec succès !');
        
                    } else {
        
                        return back()->with('failed', 'Impossible de modifier cet electeur !');
        
                    }

                } else {
        
                    return back()->with('failed', 'Impossible de modifier cet electeur !');

                }
                
            }
            return back()->with('failed', 'Impossible de modifier cet enrollement !');
        }
        return back()->with('failed', 'Impossible de trouver cet enrollement !');
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchCitoyen(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Enrollements Electeur";
        $enrol = "side-menu--active";
        $enrol_sub = "side-menu__sub-open";
        $enrol2 = "side-menu--active";

        $candidatures = Enrollement::where('role', 'Candidat')
        ->where('code', 'LIKE', '%' . $request->input('q') . '%')
        ->paginate(10);
        $elections = Election::all();
        $centres = Centre::where('type_centre', 'Enrollement')->get();
        $bureaux = Bureau::all();


        $root = Auth::user();
        $root_id = Auth::user()->id;


        return view('root.rootCitoyen', compact(
            'page_title',
            'app_name',
            'candidatures',
            'elections',
            'centres',
            'bureaux',
            'enrol',
            'enrol_sub',
            'enrol2'
        ));
    }

    ################################################################################################################
    #                                                                                                              #
    #   VOTES                                                                                                      #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootVote(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Votes";
        $vot = "side-menu--active";

        $elections = Election::all();
        $bureaux = Bureau::all();
        $candidats = Enrollement::where(['role' => 'Candidat', 'active' => 1])->get();

        $votes = Vote::paginate(10);


        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Mouchard
        $this->mouchard(
            $this->getClientIPaddress(),
            $this->getOS(),
            $this->getBrowser(),
            "Vote Dashbord Root - " . Auth::user()->name . " * ",
            "Le root nommé " . Auth::user()->name . " a consulte l'espace de vote de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
            $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
            depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."

        );


        return view('root.rootVote', compact(
            'page_title',
            'app_name',
            'elections',
            'bureaux',
            'candidats',
            'votes',
            'vot'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchVote(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Votes";
        $vot = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        $q = $request->input('q');

        $votes = Vote::where('code', 'LIKE', '%' . $request->input('q') . '%')->paginate(10);

        $elections = Election::all();
        $bureaux = Bureau::all();
        $candidats = Enrollement::where(['role' => 'Candidat', 'active' => 1])->get();

        return view('root.rootVote', compact(
            'page_title',
            'app_name',
            'elections',
            'bureaux',
            'candidats',
            'votes',
            'vot'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootAddVote(Request $request)
    {
        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get enrollement here !
        $enrollement = Enrollement::where('code', $request->input('code_electeur'))->first();
        if(!empty($enrollement)) {

            // Get electeur here !
            $electeur = User::find($enrollement->citoyen_id);
            if(!empty($electeur)) {

                // Check if u have already given ur vote
                $vote_exists = Vote::where('citoyen_id', $electeur->id)->first();
                if(empty($vote_exists)) {
                    $vote = new Vote();

                    // Get bureau's id
                    $bureau = Bureau::find($request->input('bureau_id'));

                    // Get enrollement here !
                    $enrollement = Enrollement::where('code', $request->input('code_electeur'))->first();

                    // Récupérer les données du formulaire
                    $vote->code = Carbon::now()->timestamp;
                    $vote->election_id = $request->input('election_id');
                    $vote->candidat_id = $request->input('candidat_id');
                    $vote->bureau_id = $request->input('bureau_id');
                    $vote->centre_id = !empty($bureau) ? $bureau->centre_id : 0;
                    $vote->citoyen_id = $electeur->id;
                    $vote->enrollement_id = $enrollement->id;
                    $vote->statut = 1;
                    $vote->active = 1;

                    if ($vote->save()) {

                        // Mouchard
                        $this->mouchard(
                            $this->getClientIPaddress(),
                            $this->getOS(),
                            $this->getBrowser(),
                            "Vote Root - " . Auth::user()->name . " * ",
                            "Le root nommé " . Auth::user()->name . " a vote depuis son tableau de bord depuis son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
                            $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
                            depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."
                
                        );

                        // Set resultat
                        $this->rootStatistiques($vote);
            
                        // Redirection
                        return back()->with('success', 'Vote effectuéee avec succès !');
                    }
                    return back()->with('failed', 'Impossible pour vous de voter. Rapprochez-vous du responsable du bureau de vote svp !');
                } else {
                    return back()->with('failed', 'Vous avez deja voter Mr/Mlle ' . $electeur->name . ' !');
                }

            } else {
                return back()->with('failed', 'Impossible de vous identifier cher electeur. Rapprochez-vous du responsable du bureau de vote !');
            }

        } else {
            return back()->with('failed', 'Impossible d\'identifier ce code electeur ' . $request->input('code_electeur') . ' !');
        }
    }

    ################################################################################################################
    #                                                                                                              #
    #   RESULTATS                                                                                                  #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootResultat(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Statistiques";
        $stat = "side-menu--active";

        // Get nombre enrollements
        $enrollements = Enrollement::where(['role' => 'Electeur', 'active' => 1])->get();

        $resultats = DB::table('resultats')
        ->select(
            'users.name as candidat_name',
            'elections.libelle as election_libelle',
            DB::raw('SUM(resultats.nombre_votes) as total_votes')
        )
        ->join('users', 'resultats.candidat_id', '=', 'users.id')
        ->join('elections', 'resultats.election_id', '=', 'elections.id')
        ->groupBy('users.name', 'elections.libelle')
        ->orderBy('total_votes', 'DESC') // Tri par total_votes en ordre décroissant
        ->distinct() // Utilisation de DISTINCT pour éviter les doublons
        ->paginate(10);

        //dd($resultats->toSql());

        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Mouchard
        $this->mouchard(
            $this->getClientIPaddress(),
            $this->getOS(),
            $this->getBrowser(),
            "Resultat Dashbord Root - " . Auth::user()->name . " * ",
            "Le root nommé " . Auth::user()->name . " a consulte l'espace des resultats de bord depuis
            son espace root à la date du " . Carbon::now()->translatedFormat('l jS F Y à H:i:s') . " avec l'adresse IP suivante : " .
            $this->getClientIPaddress() . " le navigateur suivant : " .  $this->getBrowser() . "
            depuis la machine : " .  $this->getDevice() . " ayant pour systeme d'exploitation : " . $this->getOS() . "."

        );


        return view('root.rootResultat', compact(
            'page_title',
            'app_name',
            'resultats',
            'enrollements',
            'stat'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootSearchResultat(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Statistiques";
        $stat = "side-menu--active";

        $root = Auth::user();
        $root_id = Auth::user()->id;

        // Get nombre enrollements
        $enrollements = Enrollement::where(['role' => 'Electeur', 'active' => 1])->get();

        $q = $request->input('q');

        $resultats = DB::table('resultats')
        ->select(
            'users.name as candidat_name',
            'elections.libelle as election_libelle',
            DB::raw('SUM(resultats.nombre_votes) as total_votes')
        )
        ->where('users.name', 'LIKE', '%' . $request->input('q') . '%')
        ->join('users', 'resultats.candidat_id', '=', 'users.id')
        ->join('elections', 'resultats.election_id', '=', 'elections.id')
        ->groupBy('users.name', 'elections.libelle')
        ->orderBy('total_votes', 'DESC') // Tri par total_votes en ordre décroissant
        ->distinct() // Utilisation de DISTINCT pour éviter les doublons
        ->paginate(10);

        return view('root.rootResultat', compact(
            'page_title',
            'app_name',
            'resultats',
            'enrollements',
            'stat'
        ));
    }










    ################################################################################################################
    #                                                                                                              #
    #   FONCTIONS UTILES                                                                                           #
    #                                                                                                              #
    ################################################################################################################

    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function rootStatistiques(Vote $vote)
    {
        // Recuperation des enrollements
        $enrollements = Enrollement::where(['role' => 'Electeur', 'active' => 1])->get();

        // Recuperation des votes d'un candidat
        $votes = Vote::where('candidat_id', $vote->candidat_id)->get();

        // Calcul du pourcentage
        $pourcentage_candidat = (count($votes) * 100 / count($enrollements));

        $resultat = new Resultat();

        // Récupérer les données du formulaire
        $resultat->election_id = $vote->election_id;
        $resultat->candidat_id = $vote->candidat_id;
        $resultat->centre_id = $vote->centre_id;
        $resultat->bureau_id = $vote->bureau_id;
        $resultat->nombre_votes += 1;
        $resultat->pourcentage_vote = (intval($resultat->nombre_votes) * 100 / count($enrollements));

        $resultat->save();



    }


    /**
     * Display a listing of the resource.
     *
     * 
     */
    static function mouchard($ip_adresse, $os_system, $os_navigator, $action_title, $action_system)
    {
        // Get user's
        $author = Auth::user();

        // Instancier mouchard
        $mouchard = new Mouchard();

        // Préparer la requete
        $mouchard->ip_address = $ip_adresse;
        $mouchard->os_system = $os_system;
        $mouchard->navigator = $os_navigator;
        $mouchard->title = $action_title;
        $mouchard->author_id = $author->id;
        $mouchard->author_action = $action_system;
        $mouchard->status = 1;

        // Sauvegarder
        $mouchard->save();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    static function getClientIPaddress()
    {

        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $clientIp = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $clientIp = $forward;
        } else {
            $clientIp = $remote;
        }

        return $clientIp;
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    static function getDevice()
    {

        $device = Agent::device();

        return $device;
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    static function getBrowser()
    {

        $browser = Agent::browser();
        $version = Agent::version($browser);

        $navigator = $browser . ' (' . $version . ') ';

        return $navigator;
    }

    /**
     * Display a listing of the resource.
     *
     * 
     */
    static function getOS()
    {

        $platform = Agent::platform();
        $version = Agent::version($platform);

        $os_system = $platform . ' (' . $version . ') ';

        return $os_system;
    }



























    
    
    
}
