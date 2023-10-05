@extends('layouts.site')

@section('page-content')

<!-- BEGIN: Content -->
<div class="grid grid-cols-12 gap-6">

    <!-- BEGIN: Slide -->
    <div class="col-span-12 2xl:col-span-12">
        <br><br>
        <div class="mx-6 pb-8"> 
            <div class="fade-mode"> 
                <div class=""> 
                    <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
                        <img alt="" class="rounded-md" src="{{ URL::to('slides/slide1.jpg') }}">
                        <div class="absolute bottom-0 text-white px-5 pb-6 z-10"> 
                            <a href="" class="block font-medium text-base">
                                Coopération électorale
                            </a> 
                            <span class="text-white/90 text-xs mt-3">Le Président du Conseil Electoral reçoit le nouveau Haut-Commissaire du Royaume-Uni au siège du CGE</span> 
                        </div>
                    </div>
                </div> 
                <div class="h-64 px-2"> 
                    <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
                        <img alt="" class="rounded-md" src="{{ URL::to('slides/slide3.jpg') }}">
                        <div class="absolute bottom-0 text-white px-5 pb-6 z-10"> 
                            <a href="" class="block font-medium text-base">
                                Listes électorales 2023
                                </a> 
                            <span class="text-white/90 text-xs mt-3">Le CGE s’attelle actuellement au toilettage du fichier électoral au niveau du Centre National de Biométrie Électorale.</span> 
                        </div>
                    </div>
                </div> 
                <div class="h-64 px-2"> 
                    <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
                        <img alt="" class="rounded-md" src="{{ URL::to('slides/slide2.jpg') }}">
                        <div class="absolute bottom-0 text-white px-5 pb-6 z-10"> 
                            <a href="" class="block font-medium text-base">
                                Digital et élection 
                                </a> 
                            <span class="text-white/90 text-xs mt-3">Le CGE apporte sa contribution lors de l’atelier de validation des lignes directrices et
                                principes pour l’utilisation des médias numériques et sociaux dans les élections en Afrique.</span> 
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
    </div>
    <!-- END: Slide -->

    <div class="col-span-12 2xl:col-span-6">
        <div class="intro-y box p-5 bg-default text-primary mt-5">
            <div class="flex items-center">
                <div class="font-medium text-lg">MISSIONS DU CONSEIL ELECTORAL</div>
            </div>
            <div class="mt-4 text-primary">
                Le Conseil Electoral veille au respect de la Loi Electorale par tous 
                les intervenants de manière à assurer la régularité, l’impartialité , 
                l’objectivité, la transparence et la sincérité des scrutins.
            </div>
            
        </div>
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <div class="intro-y box p-5 bg-default text-primary mt-5">
            <div class="flex items-center">
                <div class="font-medium text-lg">MISSIONS DE LA DGE</div>
            </div>
            <div class="mt-4 text-primary">
                La Direction Générale des Élections est chargée de la préparation et de
                 l’organisation matérielle des opérations électorales et référendaire, sous 
                 l’autorité du Conseil Electoral.
            </div>
            
        </div>
    </div>

    <!-- BEGIN: Ads 1 -->
    <div class="col-span-12 lg:col-span-12 mt-6">
        <div class="box p-8 relative overflow-hidden bg-primary intro-y">
            <div class="leading-[2.15rem] w-full sm:w-72 text-white text-xl -mt-3">La Commission Gabonaise des Elections (CGE)</div>
            <div class="w-full sm:w-72 leading-relaxed text-white/70 dark:text-slate-500 mt-3">Voter est un devoir citoyen !</div>
            <button class="btn w-32 bg-white dark:bg-darkmode-800 dark:text-white mt-6 sm:mt-10">A propos !</button>
            <img class="hidden sm:block absolute top-0 right-0 w-2/5 -mt-3 mr-2" alt="CGE" 
            src="{{ URL::to('assets/logos/logo.png') }}">
        </div>
    </div>
    <!-- END: Ads 1 -->

    
    <!-- BEGIN: Most Viewed Pages -->
    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Textes et Lois
            </h2>
        </div>
        <div class="intro-y box p-5 mt-12 sm:mt-5">
            <div class="flex text-slate-500 border-b border-slate-200 dark:border-darkmode-300 border-dashed pb-3 mb-3">
                <div>Textes et Lois</div>
                <div class="ml-auto">Derniers textes et lois du CGE.</div>
            </div>
            <div class="flex items-center mb-5">
                <div class="text-primary">/code_electoral_2023.pdf/2663</div>
                <div class="ml-auto"><i data-lucide="download" class="w-4 h-4"></i></div>
            </div>
            <div class="flex items-center mb-5">
                <div class="text-primary">/code_electoral_2018.pdf/2653</div>
                <div class="ml-auto"><i data-lucide="download" class="w-4 h-4"></i></div>
            </div>
            <div class="flex items-center mb-5">
                <div class="text-primary">/code_electoral_2016.pdf/2643</div>
                <div class="ml-auto"><i data-lucide="download" class="w-4 h-4"></i></div>
            </div>
            <div class="flex items-center mb-5">
                <div class="text-primary">/rapport_ag_2016.pdf/2643</div>
                <div class="ml-auto"><i data-lucide="download" class="w-4 h-4"></i></div>
            </div>
            
        </div>
    </div>
    <!-- END: Most Viewed Pages -->
    <!-- BEGIN: Top Search Items -->
    <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-6">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
                Actualites
            </h2>
        </div>
        <div class="intro-y box p-5 mt-12 sm:mt-5">
            <div class="flex text-slate-500 border-b border-slate-200 dark:border-darkmode-300 border-dashed pb-3 mb-3">
                <div>Actualites du CGE</div>
                <div class="ml-auto">Consulter les dernieres actualites du CGE.</div>
            </div>
            <div class="flex items-center mb-5">
                <div>CGE : les Membres tiennent la 3ème session ordinaire de.....</div>
                <div class="ml-auto">Il y'a 3 jours</div>
            </div>
            <div class="flex items-center mb-5">
                <div>Coopération électorale : Le Président du Conseil Electoral..</div>
                <div class="ml-auto">Il y'a 2 semaines</div>
            </div>
            <div class="flex items-center mb-5">
                <div>Listes électorales 2023 : Elections Gabonaises s’attelle...</div>
                <div class="ml-auto">Il y'a 1 mois</div>
            </div>
            <div class="flex items-center mb-5">
                <div>Digital et élection : Elections Gabonaises apporte ........</div>
                <div class="ml-auto">Il y'a 2 mois</div>
            </div>
        </div>
    </div>
    <!-- END: Top Search Items -->

    
    <!-- BEGIN: Ads 2 -->
    <div class="col-span-12 lg:col-span-12 mt-6">
        <div class="box p-8 relative overflow-hidden intro-y">
            <div class="leading-[2.15rem] w-full sm:w-52 text-primary dark:text-white text-xl -mt-3">Enrollements en ligne ! </div>
            <div class="w-full sm:w-60 leading-relaxed text-slate-500 mt-2">
                Faites vous enroller depuis notre plateforme en cliquant sur le lien ci-dessous !</div>
            <div class="w-48 relative mt-6 cursor-pointer tooltip" title="Copy referral link">
                <input type="text" class="form-control" value="{{ route('accueil') }}">
                <i data-lucide="play" class="absolute right-0 top-0 bottom-0 my-auto mr-4 w-4 h-4"></i> 
            </div>
            <img class="hidden sm:block absolute top-0 right-0 w-1/2 mt-1 -mr-12" alt="" 
            src="{{ URL::to('assets/logos/logo2.png') }}">
        </div>
    </div>
    <!-- END: Ads 2 -->


</div>
<!-- END: Content -->



@endsection