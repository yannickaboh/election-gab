<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

    @php
        $user = Auth::user();
    @endphp

    <!-- BEGIN: Head -->
    <head>
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Election est une plateforme destinée au CGE ou Commission Gabonaise 
        Electorale et qui a pour but de faciliter le processus électoral au Gabon en passant par la 
        phase d'enrôlement, la soumission des candidatures, le vote des électeurs et la publication temps 
        réel des résultats.">
        <meta name="keywords" content="Election, CGE, processus électoral, Gabon, enrôlement, 
        candidatures, vote, résultats, web app">
        
        <!-- A propos du Dev 1 -->
        <meta name="auteur" content="Yannick ABOH">
        <meta name="status" content="Ingénieur Logiciel, Freelance">
        <meta name="email" content="yannickabohthierry@gmail.com">
        <meta name="whatsapp" content="(+241) 074 83 56 31 | 066 68 23 53 | (+237) 697 57 30 41">

        <title>{{ 'CGE' }} | {{ $page_title ? $page_title : '' }}</title>

        <!-- BEGIN: ICON Assets-->
        <link href="{{ URL::to('assets/logos/logo.png') }}" rel="shortcut icon">
        <!-- END: ICON Assets-->

        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ URL::to('assets/dist/css/app.css') }}" />
        <!-- END: CSS Assets-->

        @stack('styles')
        {{-- jaune #ffc928 --}}
        <!-- END: CSS Assets-->

    </head>
    <!-- END: Head -->

    <body class="py-5">

        <div class="flex mt-[4.7rem] md:mt-0">

            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <a href="{{ route('rootHome') }}" class="intro-x flex items-center pl-5 pt-4">
                    <img alt="CGE" class="w-6" src="{{ URL::to('assets/logos/logo.png') }}">
                    <span class="hidden xl:block text-white text-lg ml-3 font-extrabold"> {{ 'CGE' }} </span>
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>

                    <li>
                        <a href="{{ route('rootHome') }}" class="side-menu side-menu {{ $dash ?? '' }}">
                            <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="side-menu__title">
                                Tableau de bord
                            </div>
                        </a>
                    </li>

                    <li class="side-nav__devider my-6"></li>

                    <li>
                        <a href="javascript:;" class="side-menu {{ $account ?? '' }}">
                            <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="side-menu__title">
                                Comptes
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="{{ $account_sub ?? '' }}">
                            <li>
                                <a href="{{ route('rootCompte') }}" class="side-menu {{ $account2 ?? '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                                    <div class="side-menu__title"> Utilisateurs </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="side-nav__devider my-6"></li>

                    <li>
                        <a href="javascript:;" class="side-menu side-menu {{ $centr ?? '' }}">
                            <div class="side-menu__icon"> <i data-lucide="bookmark"></i> </div>
                            <div class="side-menu__title">
                                Centres
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="{{ $centr_sub ?? '' }}">
                            <li>
                                <a href="{{ route('rootCentreEnroll') }}" class="side-menu {{ $centr1 ?? '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                                    <div class="side-menu__title"> Enrôllement </div>
                                </a>
                                <a href="{{ route('rootCentreVote') }}" class="side-menu {{ $centr2 ?? '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                                    <div class="side-menu__title"> Vote </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('rootBureau') }}" class="side-menu side-menu {{ $buro ?? '' }}">
                            <div class="side-menu__icon"> <i data-lucide="codepen"></i> </div>
                            <div class="side-menu__title">
                                Bureaux
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:;" class="side-menu side-menu {{ $enrol ?? '' }}">
                            <div class="side-menu__icon"> <i data-lucide="clipboard"></i> </div>
                            <div class="side-menu__title">
                                Enrôllements
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="{{ $enrol_sub ?? '' }}">
                            <li>
                                <a href="{{ route('rootCandidat') }}" class="side-menu {{ $enrol1 ?? '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                                    <div class="side-menu__title"> Candidatures </div>
                                </a>
                                <a href="{{ route('rootCitoyen') }}" class="side-menu {{ $enrol2 ?? '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                                    <div class="side-menu__title"> Electeurs </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="side-nav__devider my-6"></li>

                    <li>
                        <a href="{{ route('rootVote') }}" class="side-menu side-menu {{ $vot ?? '' }}">
                            <div class="side-menu__icon"> <i data-lucide="eye"></i> </div>
                            <div class="side-menu__title">
                                Votes
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('rootElection') }}" class="side-menu side-menu {{ $elec ?? '' }}">
                            <div class="side-menu__icon"> <i data-lucide="target"></i> </div>
                            <div class="side-menu__title">
                                Elections
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('rootResultat') }}" class="side-menu side-menu {{ $stat ?? '' }}">
                            <div class="side-menu__icon"> <i data-lucide="bar-chart-2"></i> </div>
                            <div class="side-menu__title">
                                Statistiques
                            </div>
                        </a>
                    </li>

                    <li class="side-nav__devider my-6"></li>

                    <li>
                        <a href="javascript:;" class="side-menu side-menu {{ $place ?? '' }}">
                            <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                            <div class="side-menu__title">
                                Modules
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="{{ $place_sub ?? '' }}">
                            <li>
                                <a href="{{ route('rootPays') }}" class="side-menu {{ $place1 ?? '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                                    <div class="side-menu__title"> Pays </div>
                                </a>
                                <a href="{{ route('rootProvince') }}" class="side-menu {{ $place2 ?? '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                                    <div class="side-menu__title"> Provinces </div>
                                </a>
                                <a href="{{ route('rootVille') }}" class="side-menu {{ $place3 ?? '' }}">
                                    <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                                    <div class="side-menu__title"> Villes </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="side-nav__devider my-6"></li>

                    <li>
                        <a href="" class="side-menu side-menu {{ $stat ?? '' }}">
                            <div class="side-menu__icon"> <i data-lucide="play"></i> </div>
                            <div class="side-menu__title">
                                <strong>Version 1.0.2</strong>
                            </div>
                        </a>
                    </li>

                

                    


                </ul>
            </nav>
            <!-- END: Side Menu -->

            <!-- BEGIN: Content -->
            <div class="content">

                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $page_title ? $page_title : 'Tableau de bord' }}
                            </li>
                        </ol>
                    </nav>
                    <!-- END: Breadcrumb -->


                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in"
                            role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <img alt="{{ Auth::user()->name }}" src="{{ Auth::user()->photo }}">
                        </div>
                        <div class="dropdown-menu w-56">
                            <ul class="dropdown-content bg-primary text-white">
                                <li class="p-2">
                                    <div class="font-medium">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">
                                        {{ Auth::user()->role }}
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider border-white/[0.08]">
                                </li>
                                <li>
                                    <a href="{{ route('rootProfil') }}" class="dropdown-item hover:bg-white/5"> <i
                                            data-lucide="user" class="w-4 h-4 mr-2"></i> Mon Compte </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider border-white/[0.08]">
                                </li>
                                <li>
                                    <a href="" class="dropdown-item hover:bg-white/5"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Déconnexion </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>
                <!-- END: Top Bar -->

                <div class="col-span-12 2xl:col-span-12">
                    @if (Session::get('success'))
                        <div class="alert alert-success alert-dismissible show flex items-center mb-2" role="alert"
                            id="alert"> <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i>
                            <strong>Succès !</strong> {{ ' ' . Session::get('success') }}. <button type="button"
                                class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> <i
                                    data-lucide="x" class="w-4 h-4"></i> </button>
                        </div>
                        <br>
                    @endif

                    @if (Session::get('failed'))
                        <div class="alert alert-danger alert-dismissible show flex items-center mb-2" role="alert"
                            id="alert"> <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> <strong>Attention !
                            </strong> {{ ' ' . Session::get('failed') }}. <button type="button"
                                class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> <i
                                    data-lucide="x" class="w-4 h-4"></i>
                            </button> </div>
                        <br>
                    @endif

                    
                    @yield('page-content')
                </div>
                
            </div>
            <!-- END: Content -->

        </div>

        <!-- BEGIN: JS Assets-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
        <!--script>
            // Configure Webcam.js
            Webcam.set({
                width: 320, // Largeur de la zone de la caméra
                height: 320, // Hauteur de la zone de la caméra
                dest_width: 640, // Largeur de l'image capturée
                dest_height: 480, // Hauteur de l'image capturée
                image_format: 'jpeg', // Format d'image (jpeg, png)
                jpeg_quality: 90 // Qualité de l'image (0-100)
            });
        
            // Affiche la caméra dans la div avec l'id "camera"
            Webcam.attach('#camera');
        
            // Gère la prise de photo
            document.getElementById('take-photo').addEventListener('click', function () {
                Webcam.snap(function (data_uri) {
                    // Envoie la photo capturée au serveur
                    axios.post('/upload-photo', { photo: data_uri })
                        .then(function (response) {
                            // Traitement réussi
                            console.log(response.data);
                            alert('Photo téléchargée avec succès !');
                        })
                        .catch(function (error) {
                            // Erreur lors du téléchargement
                            console.error(error);
                            alert('Une erreur s\'est produite lors du téléchargement de la photo.');
                        });
                });
            });
        </script-->

        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>

        <script src="{{ URL::to('assets/dist/js/app.js') }}"></script>
        <script src="{{ URL::to('assets/dist/js/ckeditor-classic.js') }}"></script>
        

        <!--end::Custom Javascript-->
        @stack('scripts')
        <!--end::Javascript-->

    </body>

</html>
