<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

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

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen dark">
                <div class="my-auto">
                    <img alt="{{ 'CGE' }}" class="-intro-x w-1/2 -mt-16"
                        src="{{ URL::to('assets/logos/logo.png') }}">
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Espace réservé au
                        personnel administratif !</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">



                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div
                        class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <br><br><br><br><br><br><br><br>

                        <div class="row">
                            <div class="col-xl-12">
                                @if (Session::get('success'))
                                    <div class="alert alert-success alert-dismissible show flex items-center mb-2"
                                        role="alert" id="alert"> <i data-lucide="alert-octagon"
                                            class="w-6 h-6 mr-2"></i> <strong>Succès!</strong>
                                        {{ Session::get('success') }}. <button type="button"
                                            class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> <i
                                                data-lucide="x" class="w-4 h-4"></i> </button> </div>
                                    <br>
                                @endif

                                @if (Session::get('failed'))
                                    <div class="alert alert-danger alert-dismissible show flex items-center mb-2"
                                        role="alert" id="alert"> <i data-lucide="alert-octagon"
                                            class="w-6 h-6 mr-2"></i> <strong>Attention ! </strong>
                                        {{ Session::get('failed') }}. <button type="button"
                                            class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> <i
                                                data-lucide="x" class="w-4 h-4"></i> </button> </div>
                                    <br>
                                @endif
                            </div>
                        </div>

                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Espace Administratif
                        </h2>
                        <div class="intro-x mt-2 text-slate-400  text-center xl:text-left">
                            Connectez-vous à votre tableau de bord personnel !
                        </div>
                        <div class="intro-x mt-8">

                            <input type="email" id="email"
                                class="intro-x login__input form-control py-3 px-4 block" placeholder="Email"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>



                            <input type="password" id="password"
                                class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="Mot de passe" name="password" required>



                        </div>
                        <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                            <a href="">Mot de passe oublié ?</a>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">
                                Connexion</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>





    <!-- BEGIN: JS Assets-->
    <script src="{{ URL::to('assets/dist/js/app.js') }}"></script>
    <!-- END: JS Assets-->


    <!-- BEGIN: JS Scripts-->

    <!-- END: JS Scripts-->

</body>

</html>
