@extends('layouts.root')

@section('page-content')

<!-- BEGIN: Content -->
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Tableau de bord
                    </h2>
                    <a href="{{ route('rootHome') }}" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Recharger la page </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="user" class="report-box__icon text-primary"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ count($agents) }}</div>
                                <div class="text-base text-slate-500 mt-1">Agents</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="user" class="report-box__icon text-pending"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ count($candidats) }}</div>
                                <div class="text-base text-slate-500 mt-1">Candidats</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="user" class="report-box__icon text-warning"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ count($electeurs) }}</div>
                                <div class="text-base text-slate-500 mt-1">Electeurs</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="user-plus" class="report-box__icon text-success"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ count($admins) }}</div>
                                <div class="text-base text-slate-500 mt-1">Admins</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="slack" class="report-box__icon text-primary"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ count($centres_enrollement) }}</div>
                                <div class="text-base text-slate-500 mt-1">Centres d'enrollement</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="star" class="report-box__icon text-pending"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ count($centres_vote) }}</div>
                                <div class="text-base text-slate-500 mt-1">Centres de vote</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="home" class="report-box__icon text-warning"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ count($bureaux) }}</div>
                                <div class="text-base text-slate-500 mt-1">Bureaux de vote</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="thumbs-up" class="report-box__icon text-success"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ count($enrollements) }}</div>
                                <div class="text-base text-slate-500 mt-1">Enrollements</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->

            <!-- BEGIN: Ads 1 -->
            <div class="col-span-12 xl:col-span-12 mt-6">
                <div class="box p-8 relative overflow-hidden bg-primary intro-y">
                    <div class="leading-[2.15rem] w-full sm:w-72 text-white text-xl -mt-3">Bienvenue sur la plateforme du (CGE)</div>
                    <div class="w-full sm:w-72 leading-relaxed text-white/70 dark:text-slate-500 mt-3">Administrer, planifier et superviser vos elections en toute tranquilite.</div>
                    <a href="{{ route('accueil') }}" target="_blank" class="btn w-32 bg-white dark:bg-darkmode-800 dark:text-white mt-6 sm:mt-10">Aller vers le site</a>
                    <img class="hidden sm:block absolute top-0 right-0 w-2/5 -mt-3 mr-2" alt="" 
                    src="{{ URL::to('assets/logos/logo.png') }}">
                </div>
            </div>
            <!-- END: Ads 1 -->
            
            <!-- BEGIN: Weekly Best Sellers -->
            <div class="col-span-12 xl:col-span-4 mt-6">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Election ({{ $election->type_election }})
                    </h2>
                </div>
                <div class="mt-5">
                    <div class="intro-y">
                        <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Date debut</div>
                                <div class="text-slate-500 text-xs mt-0.5">{{ \Carbon\Carbon::parse($election->date_debut)->translatedFormat('l jS F Y') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y">
                        <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">Date fin</div>
                                <div class="text-slate-500 text-xs mt-0.5">{{ \Carbon\Carbon::parse($election->date_fin)->translatedFormat('l jS F Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Weekly Best Sellers -->

            <!-- BEGIN: Recent Activities -->
            <div class="col-span-12 xl:col-span-8 mt-6">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Activites recentes
                    </h2> 
                </div>
                <div class="mt-5 relative before:block before:absolute before:w-px before:h-[85%] before:bg-slate-200 before:dark:bg-darkmode-400 before:ml-5 before:mt-5">
                    
                    @foreach($mouchards as $mouchard)
                    <div class="intro-x relative flex items-center mb-3">
                        <div class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                <img src="{{ URL::to('assets/logos/logo.png') }}">
                            </div>
                        </div>
                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                            <div class="flex items-center">
                                <div class="font-medium">{{ $mouchard->title }}</div>
                                <div class="text-xs text-slate-500 ml-auto">
                                    {{ \Carbon\Carbon::parse($mouchard->created_at)->translatedFormat('l jS F Y | H:m:s') }}
                                </div>
                            </div>
                            <div class="text-slate-500 mt-1">{{ $mouchard->author_action }}</div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <!-- END: Recent Activities -->
            
            
        </div>
    </div>
    <div class="col-span-12 2xl:col-span-3">
        <div class="2xl:border-l -mb-10 pb-10">
            <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                <!-- BEGIN: Transactions -->
                <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Candidatures
                        </h2>
                    </div>
                    <div class="mt-5">

                        @foreach ($candidats as $candidat)

                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="{{ $candidat->name }}" src="{{ $candidat->photo }}">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">{{ $candidat->name }}</div>
                                    <div class="text-slate-500 text-xs mt-0.5">{{ $candidat->parti_politique }}</div>
                                </div>
                                <div class="text-success">
                                    @if($candidat->active == 1)
                                        <i data-lucide="thumbs-up" class="report-box__icon text-success"></i>
                                    @else 
                                        <i data-lucide="thumbs-down" class="report-box__icon text-danger"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        
                    </div>
                </div>
                <!-- END: Transactions -->
                
            </div>
        </div>
    </div>
</div>
<!-- END: Content -->

@endsection