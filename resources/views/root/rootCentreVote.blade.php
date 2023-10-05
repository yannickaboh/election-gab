@extends('layouts.root')

@section('page-content')

    <div class="col-span-12 2xl:col-span-12">
        <h2 class="intro-y text-lg font-medium mt-10">
            Centres de vote
        </h2>
        <div class="grid grid-cols-12 gap-12 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">

                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview"
                    class="btn btn-primary shadow-md mr-2">Nouveau Centre</a>

                <!-- BEGIN: Large Modal Content -->
                <!-- BEGIN: Modal Content -->
                <div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('rootAddCentre') }}">
                                @csrf
                                <!-- BEGIN: Modal Header -->
                                <div class="modal-header">
                                    <h2 class="font-medium text-base mr-auto">Formulaire d'ajout</h2>
                                </div> <!-- END: Modal Header -->
                                <!-- BEGIN: Modal Body -->
                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                                    

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-6" class="form-label">Ville</label>
                                        <select id="modal-form-6" class="form-select" name="ville_id">
                                            @foreach ($villes as $ville)
                                                <option value="{{ $ville->id }}">{{ $ville->libelle }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-1" class="form-label">Type de centre</label>
                                        <input type="text" class="form-control" readonly name="type_centre" value="Vote">
                                    </div>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-1" class="form-label">Code</label>
                                        <input type="text" class="form-control" placeholder="LBV" name="code">
                                    </div>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-2" class="form-label">Libelle</label>
                                        <input type="text" class="form-control" placeholder="Libreville" name="libelle">
                                    </div>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-2" class="form-label">Telephone</label>
                                        <input type="text" class="form-control" placeholder="(+241) 74 83 56 31" name="phone">
                                    </div>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-2" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" placeholder="Quartier IAI, Au sein de l'institut" name="adresse">
                                    </div>


                                    <div class="col-span-12 sm:col-span-12">
                                        <label for="modal-form-6" class="form-label">Statut</label>
                                        <select id="modal-form-6" class="form-select" name="active">
                                            <option value="1">active</option>
                                            <option value="0">inactif</option>
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
                </div> <!-- END: Modal Content -->
                <!-- END: Large Modal Content -->

                <div class="hidden md:block mx-auto text-slate-500">
                    Affiche de 1 a 10 sur {{ $centres->count() }} centres
                </div>

                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <form id="search-ville" action="{{ route('rootSearchCentreEnroll') }}" method="GET" class="d-none">
                            @csrf
                            <input type="text" name="q" class="form-control w-56 box pr-10"
                                placeholder="Recherche...">
                            <a href=""
                                onclick="event.preventDefault(); document.getElementById('search-ville').submit();">
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                            </a>
                        </form>
                    </div>

                </div>


            </div>


            <br><br>


            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto ">
                @if ($centres->count() > 0)
                    <table class="table table-report -mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">VILLE</th>
                                <th class="whitespace-nowrap text-center">RESPONSABLE</th>
                                <th class="whitespace-nowrap text-center">CODE</th>
                                <th class="text-center whitespace-nowrap">LIBELLE</th>
                                <th class="text-center whitespace-nowrap">ADRESSE</th>
                                <th class="text-center whitespace-nowrap">TELEPHONE</th>
                                <th class="text-center whitespace-nowrap">STATUT</th>
                                <th class="text-center whitespace-nowrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>

                            
                                @foreach ($centres as $centre)
                                    <tr class="intro-x">
                                        <td class="w-40">
                                            {{ $centre->ville_id ? $centre->ville->libelle : 'Non defini' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $centre->responsable_id ? $centre->responsable->name : 'Non defini' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $centre->code }}
                                        </td>
                                        <td class="text-center">
                                            {{ $centre->libelle }}
                                        </td>
                                        <td class="text-center">
                                            {{ $centre->adresse }}
                                        </td>
                                        <td class="text-center">
                                            {{ $centre->phone }}
                                        </td>
                                        <td class="w-40">
                                            @if ($centre->active == 1)
                                                <div class="flex items-center justify-center text-success"> <i
                                                        data-lucide="check-square" class="w-4 h-4 mr-2"></i> Active </div>
                                            @else
                                                <div class="flex items-center justify-center text-warning"> <i
                                                        data-lucide="check-square" class="w-4 h-4 mr-2"></i> Inactive </div>
                                            @endif
                                        </td>
                                        <td class="table-report__action w-56">
                                            <div class="flex justify-center items-center">
                                                <a class="flex items-center mr-3" href="javascript:;" data-tw-toggle="modal"
                                                    data-tw-target="#update-{{ $centre->id }}"> <i data-lucide="edit"
                                                        class="w-4 h-4 mr-1"></i> </a>
                                                        <a class="flex items-center mr-3" href="javascript:;" data-tw-toggle="modal"
                                                            data-tw-target="#affect-{{ $centre->id }}"> <i data-lucide="user"
                                                                class="w-4 h-4 mr-1"></i> </a>
                                            </div>
                                        </td>
                                    </tr>


                                    <!-- BEGIN: Delete Confirmation Modal -->
                                    <div id="update-{{ $centre->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('rootEditCentre') }}">
                                                    @csrf
                                                    <!-- BEGIN: Modal Header -->
                                                    <div class="modal-header">
                                                        <h2 class="font-medium text-base mr-auto">Formulaire de Modification
                                                        </h2>
                                                    </div> <!-- END: Modal Header -->
                                                    <!-- BEGIN: Modal Body -->
                                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-6" class="form-label">Villes</label>
                                                            <select id="modal-form-6" class="form-select" name="ville_id">
                                                                @foreach ($villes as $ville)
                                                                    @if ($ville->id == $centre->ville_id)
                                                                        <option value="{{ $ville->id }}" selected>
                                                                            {{ $ville->libelle }}</option>
                                                                    @else
                                                                        <option value="{{ $ville->id }}">
                                                                            {{ $ville->libelle }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-1" class="form-label">Type de centre</label>
                                                            <input type="text" class="form-control" readonly name="type_centre" value="Vote">
                                                        </div>

                                                        <div class="col-span-12 sm:col-span-6">
                                                            <input type="hidden" name="centre_id"
                                                                value="{{ $centre->id }}">
                                                            <label for="modal-form-1" class="form-label">Code</label>
                                                            <input type="text" class="form-control" placeholder="GA"
                                                                name="code" value="{{ $centre->code }}">
                                                        </div>

                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-2" class="form-label">Libelle</label>
                                                            <input type="text" class="form-control" placeholder="GABON"
                                                                name="libelle" value="{{ $centre->libelle }}">
                                                        </div>

                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-2" class="form-label">Telephone</label>
                                                            <input type="text" class="form-control" placeholder="(+241) 74 83 56 31" 
                                                            name="phone" value="{{ $centre->phone }}">
                                                        </div>
                    
                                                        <div class="col-span-12 sm:col-span-6">
                                                            <label for="modal-form-2" class="form-label">Adresse</label>
                                                            <input type="text" class="form-control" 
                                                            placeholder="Quartier IAI, Au sein de l'institut" name="adresse" value="{{ $centre->adresse }}">
                                                        </div>


                                                        <div class="col-span-12 sm:col-span-12">
                                                            <label for="modal-form-6" class="form-label">Statut</label>
                                                            <select id="modal-form-6" class="form-select" name="active">
                                                                <option value="1">active</option>
                                                                <option value="0">inactif</option>
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
                                    <!-- END: Delete Confirmation Modal -->

                                    <!-- BEGIN: Delete Confirmation Modal -->
                                    <div id="affect-{{ $centre->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('rootAffectCentre') }}">
                                                    @csrf
                                                    <!-- BEGIN: Modal Header -->
                                                    <div class="modal-header">
                                                        <h2 class="font-medium text-base mr-auto">Affectation de Responsable
                                                        </h2>
                                                    </div> <!-- END: Modal Header -->
                                                    <!-- BEGIN: Modal Body -->
                                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                                                        <div class="col-span-12 sm:col-span-12">
                                                            <label for="modal-form-6" class="form-label">Responsable</label>
                                                            <select id="modal-form-6" class="form-select" name="responsable_id">
                                                                @foreach ($users as $user)
                                                                    @if ($user->id == $centre->responsable_id)
                                                                        <option value="{{ $user->id }}" selected>
                                                                            {{ $user->name }}</option>
                                                                    @else
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <input type="hidden" name="centre_id"
                                                                value="{{ $centre->id }}">

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
                                    <!-- END: Delete Confirmation Modal -->

                                @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="col-span-12 2xl:col-span-12">
                        <div class="alert alert-pending alert-dismissible show flex items-center mb-2" role="alert"> <i
                                data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> Aucun élément pour le
                            moment
                            ! </div>
                    </div>
                @endif
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    {{ $centres->links() }}
                </nav>
            </div>
            <!-- END: Pagination -->
        </div>

    </div>




@endsection
