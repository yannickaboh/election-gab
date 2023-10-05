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

class SiteController extends Controller
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
    public function accueil(Request $request)
    {

        $app_name = "CGE";
        $page_title = "Accueil";
        $home = "top-menu--active";

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

        

        return view('site.accueil', compact(
            'app_name', 'page_title', 'home',
            'agents', 'admins', 'candidats', 'electeurs', 
            'centres_enrollement', 'centres_vote', 'bureaux', 
            'enrollements', 'election', 'mouchards'
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
