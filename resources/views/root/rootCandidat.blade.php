@extends('layouts.root')

@section('page-content')

<h2 class="intro-y text-lg font-medium mt-10">
    Gestion des Candidatures
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">

        <button class="btn btn-primary shadow-md mr-2" data-tw-toggle="modal" data-tw-target="#new-user">
            Nouveau Candidat
        </button>
        <!-- BEGIN: New User Modal -->
        <div id="new-user" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="{{ route('rootAddCandidat') }}">
                        @csrf
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">Nouveau Candidat
                            </h2>
                        </div> <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Nom Complet*</label>
                                <input type="text" class="form-control" placeholder="Ex. NDONG"
                                    name="name" required>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Sexe*</label>
                                <select id="modal-form-6" class="form-select" name="sexe">
                                    <option value="Masculin">Masculin</option>
                                    <option value="Feminin">Feminin</option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Email*</label>
                                <input type="text" class="form-control"
                                    placeholder="Ex. paul.ndong@gmail.com" name="email" required>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Mot de Passe*</label>
                                <input type="text" readonly class="form-control"
                                    name="password" value="Candidat@cge">
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Date de naissance*</label>
                                <input type="text" class="form-control datepicker"
                                data-single-mode="true" name="date_naissance" required>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Profession*</label>
                                <input type="text" class="form-control"
                                    placeholder="Ex. Professeur Chercheur" name="profession" required>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Telephone*</label>
                                <input type="text" class="form-control"
                                    placeholder="Ex. +241 74 00 00 01" name="phone" required>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Adresse*</label>
                                <input type="text" class="form-control"
                                    placeholder="Ex. Face CKDO Oloumi" name="adresse" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-1" class="form-label">Parti politique*</label>
                                <input type="text" class="form-control"
                                    placeholder="Ex. Alternance" name="parti_politique" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-1" class="form-label">Programme politique*</label>
                                <textarea class="form-control" id="classic-editor"
                                     name="programme_parti_politique" rows="7" required></textarea>
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-6" class="form-label">Election</label>
                                <select id="modal-form-6" class="form-select" name="election_id">
                                    @foreach ($elections as $election)
                                        <option value="{{ $election->id }}">{{ $election->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-6" class="form-label">Centre</label>
                                <select id="modal-form-6" class="form-select" name="centre_id">
                                    @foreach ($centres as $centre)
                                        <option value="{{ $centre->id }}">{{ $centre->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Role*</label>
                                <select id="modal-form-6" class="form-select" name="role">
                                    <option value="Candidat">Candidat</option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Statut*</label>
                                <select id="modal-form-6" class="form-select" name="active">
                                    <option value="1">Active</option>
                                    <option value="0">Desactive</option>
                                </select>
                            </div>


                        </div> <!-- END: Modal Body -->
                        <!-- BEGIN: Modal Footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-20">Soumettre</button>
                        </div>
                        <!-- END: Modal Footer -->
                    </form>
                </div>
            </div>
        </div>
        <!-- END: New User Modal -->

        <div class="hidden md:block mx-auto text-slate-500">Liste des Candidats</div>

        <form method="GET" action="{{ route('rootSearchCandidat') }}">
            @csrf
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" name="q" placeholder="Recherche code candidat...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i> 
                </div>
            </div>
        </form>

    </div>

    <!-- BEGIN: Users Layout -->
    @if ($candidatures)

        @foreach ($candidatures as $candidat)

            <div class="intro-y col-span-12 md:col-span-4">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                            <img alt="{{ $candidat->citoyen->name }}" class="rounded-full" src="{{ $candidat->citoyen->photo }}">
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium">{{ $candidat->citoyen->name }}</a> 
                            <div class="text-slate-500 text-xs mt-0.5">
                                {{ $candidat->citoyen->parti_politique }}  
                                
                                ({{ $candidat->role }} )
                                
                            </div>
                        </div>
                        <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                            <div class="dropdown">
                                <a data-tw-toggle="dropdown" class="dropdown-toggle w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in"> 
                                    <i class="w-3 h-3 fill-current" data-lucide="menu"></i> 
                                </a>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content">
                                        <li>
                                            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#update-{{ $candidat->citoyen->id }}" class="dropdown-item"> 
                                                <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                                Editer
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#avatar-{{ $candidat->citoyen->id }}" class="dropdown-item"> 
                                                <i data-lucide="instagram" class="w-4 h-4 mr-2"></i> 
                                                Avatar 
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                        <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                            <div class="flex text-slate-500 text-xs">
                                <div class="mr-auto">Candidature valide ?</div>
                            </div>
                            <div class="progress h-1 mt-2">
                                @if($candidat->active == 1)
                                    <div class="progress-bar w-4/4 bg-success" role="progressbar" aria-valuenow="0"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                                @else
                                    <div class="progress-bar w-4/4 bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BEGIN: Update Confirmation Modal -->
            <div id="update-{{ $candidat->citoyen->id }}" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('rootEditCandidat') }}">
                            @csrf
                            <!-- BEGIN: Modal Header -->
                            <div class="modal-header">
                                <h2 class="font-medium text-base mr-auto">Formulaire de Modification
                                </h2>
                            </div> <!-- END: Modal Header -->
                            <!-- BEGIN: Modal Body -->
                            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                                <div class="col-span-12 sm:col-span-6">
                                    <input type="hidden" name="candidat_id" value="{{ $candidat->citoyen->id }}">
                                    <input type="hidden" name="enrollement_id" value="{{ $candidat->id }}">
                                    <label for="modal-form-1" class="form-label">Nom Complet*</label>
                                    <input type="text" class="form-control" placeholder="Ex. NDONG"
                                        name="name" required value="{{ $candidat->citoyen->name }}">
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-1" class="form-label">Sexe*</label>
                                    <select id="modal-form-6" class="form-select" name="sexe">
                                        <option value="Masculin">Masculin</option>
                                        <option value="Feminin">Feminin</option>
                                    </select>
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-1" class="form-label">Email*</label>
                                    <input type="text" class="form-control"
                                        placeholder="Ex. paul.ndong@gmail.com" name="email"
                                        value="{{ $candidat->citoyen->email }}">
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-1" class="form-label">Mot de Passe*</label>
                                    <input type="text" readonly class="form-control"
                                        name="password" value="Candidat@cge">
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-1" class="form-label">Date de naissance*</label>
                                    <input type="text" class="form-control datepicker"
                                         name="date_naissance" required  data-single-mode="true"
                                        value="{{ $candidat->citoyen->date_naissance }}">
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-1" class="form-label">Profession*</label>
                                    <input type="text" class="form-control"
                                        placeholder="Ex. Professeur Chercheur" name="profession" required 
                                        value="{{ $candidat->citoyen->profession }}">
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-1" class="form-label">Telephone*</label>
                                    <input type="text" class="form-control"
                                        placeholder="Ex. +241 74 00 00 01" name="phone" required
                                        value="{{ $candidat->citoyen->phone }}">
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-1" class="form-label">Adresse*</label>
                                    <input type="text" class="form-control"
                                        placeholder="Ex. Face CKDO Oloumi" name="adresse" required
                                        value="{{ $candidat->citoyen->adresse }}">
                                </div>
                                <div class="col-span-12 sm:col-span-12">
                                    <label for="modal-form-1" class="form-label">Parti politique*</label>
                                    <input type="text" class="form-control"
                                        placeholder="Ex. Alternance" name="parti_politique" required 
                                        value="{{ $candidat->citoyen->parti_politique }}">
                                </div>
                                <div class="col-span-12 sm:col-span-12">
                                    <label for="modal-form-1" class="form-label">Programme politique*</label>
                                    <textarea class="form-control editor"
                                         name="programme_parti_politique" rows="7" required>
                                         {{ $candidat->citoyen->programme_parti_politique }}</textarea>
                                </div>
    
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-6" class="form-label">Election</label>
                                    <select id="modal-form-6" class="form-select" name="election_id">
                                        @foreach ($elections as $election)
                                            <option value="{{ $election->id }}">{{ $election->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-6" class="form-label">Centre</label>
                                    <select id="modal-form-6" class="form-select" name="centre_id">
                                        @foreach ($centres as $centre)
                                            <option value="{{ $centre->id }}">{{ $centre->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-1" class="form-label">Role*</label>
                                    <select id="modal-form-6" class="form-select" name="role">
                                        <option value="Candidat">Candidat</option>
                                    </select>
                                </div>
                                <div class="col-span-12 sm:col-span-6">
                                    <label for="modal-form-1" class="form-label">Statut*</label>
                                    <select id="modal-form-6" class="form-select" name="active">
                                        <option value="1">Active</option>
                                        <option value="0">Desactive</option>
                                    </select>
                                </div>


                            </div> <!-- END: Modal Body -->
                            <!-- BEGIN: Modal Footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary w-20">Soumettre</button>
                            </div>
                            <!-- END: Modal Footer -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- END: Update Confirmation Modal -->

            <!-- BEGIN: Avatar Confirmation Modal -->
            <div id="avatar-{{ $candidat->citoyen->id }}" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('rootPhotoCandidat') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- BEGIN: Modal Header -->
                            <div class="modal-header">
                                <h2 class="font-medium text-base mr-auto">Formulaire de Modification de
                                    l'avatar</h2>
                            </div> <!-- END: Modal Header -->
                            <!-- BEGIN: Modal Body -->
                            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                                <div class="col-span-12 sm:col-span-6">
                                    <input type="hidden" name="candidat_id" value="{{ $candidat->citoyen->id }}">
                                    <input type="hidden" name="enrollement_id" value="{{ $candidat->id }}">
                                    <label for="modal-form-1" class="form-label">Avatar*</label>
                                    <input type="file" class="form-control" name="avatar"
                                        required>
                                </div>


                            </div> <!-- END: Modal Body -->
                            <!-- BEGIN: Modal Footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary w-20">Soumettre</button>
                            </div>
                            <!-- END: Modal Footer -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- END: Avatar Confirmation Modal -->

        @endforeach
    

    @else

        <!-- BEGIN: Notification -->
        <div class="col-span-12 mt-6 -mb-6 intro-y">
            <div class="alert alert-dismissible show box bg-primary text-white flex items-center mb-6" role="alert">
                <span>Aucun candidat pour le moment !</span>
                <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button>
            </div>
        </div>
        <!-- BEGIN: Notification -->

    @endif

    <!-- END: Users Layout -->

    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <nav class="w-full sm:w-auto sm:mr-auto">
            {{ $candidatures->links() }}
        </nav>
    </div>
    <!-- END: Pagination -->
</div>


@endsection