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
        
        <!-- BEGIN: Top Bar -->
        <div class="border-b border-white/[0.08] mt-[2.2rem] md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
            <div class="top-bar-boxed flex items-center">
                <!-- BEGIN: Logo -->
                <a href="" class="-intro-x hidden md:flex">
                    <img alt="CGE" class="w-6" src="{{ URL::to('assets/logos/logo.png') }}">
                    <span class="text-white text-lg ml-3"> CGE </span> 
                </a>
                <!-- END: Logo -->
                <!-- BEGIN: Breadcrumb -->
                <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
                    <ol class="breadcrumb breadcrumb-light">
                        <li class="breadcrumb-item"><a href="#">Commission Gabonaise des Elections</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $page_title ?? '' }}</li>
                    </ol>
                </nav>
                <!-- END: Breadcrumb -->

                <!-- BEGIN: Search -->
                <div class="intro-x relative mr-3 sm:mr-6">
                    <div class="search hidden sm:block">
                        <input type="text" class="search__input form-control border-transparent" placeholder="Recherche...">
                        <i data-lucide="search" class="search__icon dark:text-slate-500"></i> 
                    </div>
                    <a class="notification notification--light sm:hidden" href=""> 
                        <i data-lucide="search" class="notification__icon dark:text-slate-500"></i> 
                    </a>
                </div>
                <!-- END: Search -->

                @if(Auth::user())
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
                @else 
                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                        <img alt="" src="{{ URL::to('assets/dist/images/profile-8.jpg') }}">
                    </div>
                    <div class="dropdown-menu w-56">
                        <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                            <li class="p-2">
                                <div class="font-medium">Espace Administratif</div>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-white/[0.08]">
                            </li>
                            <li>
                                <a href="{{ route('login') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Se connecter </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END: Account Menu -->
                @endif

            </div>
        </div>
        <!-- END: Top Bar -->

        <!-- BEGIN: Top Menu -->
        <nav class="top-nav">
            <ul>
                <li>
                    <a href="" class="top-menu {{ $home ?? '' }}">
                        <div class="top-menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="top-menu__title"> Accueil </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="top-menu {{ $org ?? '' }}">
                        <div class="top-menu__icon"> <i data-lucide="clipboard"></i> </div>
                        <div class="top-menu__title"> Organisation <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="" class="top-menu">
                                <div class="top-menu__icon"> <i data-lucide="minus"></i> </div>
                                <div class="top-menu__title"> Le Conseil Electoral </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="top-menu">
                                <div class="top-menu__icon"> <i data-lucide="minus"></i> </div>
                                <div class="top-menu__title"> La Direction Generale </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="top-menu">
                                <div class="top-menu__icon"> <i data-lucide="minus"></i> </div>
                                <div class="top-menu__title"> Activites </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="top-menu">
                                <div class="top-menu__icon"> <i data-lucide="minus"></i> </div>
                                <div class="top-menu__title"> Actualites </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="top-menu {{ $doc ?? '' }}">
                        <div class="top-menu__icon"> <i data-lucide="folder"></i> </div>
                        <div class="top-menu__title"> Documentation <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="javascript:;" class="top-menu">
                                <div class="top-menu__icon"> <i data-lucide="minus"></i> </div>
                                <div class="top-menu__title"> Rapports </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="top-menu">
                                <div class="top-menu__icon"> <i data-lucide="minus"></i> </div>
                                <div class="top-menu__title"> Textes et Lois </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="top-menu {{ $media ?? '' }}">
                        <div class="top-menu__icon"> <i data-lucide="camera"></i> </div>
                        <div class="top-menu__title"> Medias <i data-lucide="chevron-down" class="top-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="javascript:;" class="top-menu">
                                <div class="top-menu__icon"> <i data-lucide="minus"></i> </div>
                                <div class="top-menu__title"> Galerie </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="top-menu">
                                <div class="top-menu__icon"> <i data-lucide="minus"></i> </div>
                                <div class="top-menu__title"> Videos </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="top-menu {{ $blog ?? '' }}">
                        <div class="top-menu__icon"> <i data-lucide="slack"></i> </div>
                        <div class="top-menu__title"> Blog  </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon"> <i data-lucide="phone"></i> </div>
                        <div class="top-menu__title"> Contacts </div>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- END: Top Menu -->

        <!-- BEGIN: Content -->
        <div class="content">
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