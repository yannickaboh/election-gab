@extends('layouts.root')

@section('page-content')

    <div class="col-span-12 2xl:col-span-12">
        <h2 class="intro-y text-lg font-medium mt-10">
            Liste des elections
        </h2>
        <div class="grid grid-cols-12 gap-12 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">

                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview"
                    class="btn btn-primary shadow-md mr-2">Nouvelle Election</a>

                <!-- BEGIN: Large Modal Content -->
                <!-- BEGIN: Modal Content -->
                <div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('rootAddElection') }}">
                                @csrf
                                <!-- BEGIN: Modal Header -->
                                <div class="modal-header">
                                    <h2 class="font-medium text-base mr-auto">Formulaire d'ajout</h2>
                                </div> <!-- END: Modal Header -->
                                <!-- BEGIN: Modal Body -->
                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                                    <div class="col-span-12 sm:col-span-12">
                                        <label for="modal-form-6" class="form-label">Type d'election</label>
                                        <select id="modal-form-6" class="form-select" name="type_election">
                                            <option value="Presidentielle">Presidentielle</option>
                                            <option value="Legislative">Legislative</option>
                                            <option value="Senatoriale">Senatoriale</option>
                                        </select>
                                    </div>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-1" class="form-label">Code</label>
                                        <input type="text" class="form-control" placeholder="GA" name="code">
                                    </div>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-2" class="form-label">Libelle</label>
                                        <input type="text" class="form-control" placeholder="GABON" name="libelle">
                                    </div>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-2" class="form-label">Date debut</label>
                                        <input type="text" class="datepicker form-control"  name="date_debut" data-single-mode="true">
                                    </div>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-2" class="form-label">Date fin</label>
                                        <input type="text" class="datepicker form-control"  name="date_fin" data-single-mode="true">
                                    </div>

                                    <div class="col-span-12 sm:col-span-12">
                                        <label for="modal-form-1" class="form-label">Code electoral</label>
                                        <textarea class=" editor form-control" name="code_electoral" rows="5"></textarea>
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
                    Affiche de 1 a 10 sur {{ $elections->count() }} elections
                </div>

                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <form id="search-pays" action="{{ route('rootSearchElection') }}" method="GET" class="d-none">
                            @csrf
                            <input type="text" name="q" class="form-control w-56 box pr-10"
                                placeholder="Recherche...">
                            <a href=""
                                onclick="event.preventDefault(); document.getElementById('search-pays').submit();">
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                            </a>
                        </form>
                    </div>

                </div>


            </div>


            <br><br>


            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto ">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap text-center">TYPE</th>
                            <th class="whitespace-nowrap text-center">CODE</th>
                            <th class="text-center whitespace-nowrap">LIBELLE</th>
                            <th class="text-center whitespace-nowrap">DEBUT</th>
                            <th class="text-center whitespace-nowrap">FIN</th>
                            <th class="text-center whitespace-nowrap">STATUT</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($elections->count() > 0)
                            @foreach ($elections as $election)
                                <tr class="intro-x">
                                    <td class="text-center">
                                        {{ $election->type_election }}
                                    </td>
                                    <td class="text-center">
                                        {{ $election->code }}
                                    </td>
                                    <td class="text-center">
                                        {{ $election->libelle }}
                                    </td>
                                    <td class="text-center">
                                        {{ $election->date_debut }}
                                    </td>
                                    <td class="text-center">
                                        {{ $election->date_fin }}
                                    </td>
                                    <td class="w-40">
                                        @if ($election->active == 1)
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
                                                data-tw-target="#update-{{ $election->id }}"> <i data-lucide="edit"
                                                    class="w-4 h-4 mr-1"></i> </a>
                                            <a class="flex items-center mr-3" href="javascript:;" data-tw-toggle="modal"
                                                data-tw-target="#flag-{{ $election->id }}"> <i data-lucide="camera"
                                                    class="w-4 h-4 mr-1"></i> </a>
                                            
                                            @if(!empty($election->code_electoral_pdf))
                                            <a class="flex items-center mr-3" href="{{ $election->code_electoral_pdf }}" 
                                                target="_blank"> <i data-lucide="download"
                                                    class="w-4 h-4 mr-1"></i> </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>


                                <!-- BEGIN: Delete Confirmation Modal -->
                                <div id="update-{{ $election->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('rootEditElection') }}">
                                                @csrf
                                                <!-- BEGIN: Modal Header -->
                                                <div class="modal-header">
                                                    <h2 class="font-medium text-base mr-auto">Formulaire de Modification
                                                    </h2>
                                                </div> <!-- END: Modal Header -->
                                                <!-- BEGIN: Modal Body -->

                                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                                                    <div class="col-span-12 sm:col-span-12">
                                                        <label for="modal-form-6" class="form-label">Type d'election</label>
                                                        <select id="modal-form-6" class="form-select" name="type_election">
                                                            <option value="Presidentielle">Presidentielle</option>
                                                            <option value="Legislative">Legislative</option>
                                                            <option value="Senatoriale">Senatoriale</option>
                                                        </select>
                                                    </div>


                                                    <div class="col-span-12 sm:col-span-6">
                                                        <input type="hidden" name="election_id"
                                                            value="{{ $election->id }}">
                                                        <label for="modal-form-1" class="form-label">Code</label>
                                                        <input type="text" class="form-control" placeholder="GA"
                                                            name="code" value="{{ $election->code }}">
                                                    </div>

                                                    <div class="col-span-12 sm:col-span-6">
                                                        <label for="modal-form-2" class="form-label">Libelle</label>
                                                        <input type="text" class="form-control" placeholder="GABON"
                                                            name="libelle" value="{{ $election->libelle }}">
                                                    </div>

                                                    <div class="col-span-12 sm:col-span-6">
                                                        <label for="modal-form-2" class="form-label">Date debut</label>
                                                        <input type="text" class="datepicker form-control"  name="date_debut" 
                                                        value="{{ $election->date_debut }}" data-single-mode="true">
                                                    </div>

                                                    <div class="col-span-12 sm:col-span-6">
                                                        <label for="modal-form-2" class="form-label">Date fin</label>
                                                        <input type="text" class="datepicker form-control"  name="date_fin" 
                                                        value="{{ $election->date_fin }}" data-single-mode="true">
                                                    </div>

                                                    <div class="col-span-12 sm:col-span-12">
                                                        <label for="modal-form-1" class="form-label">Code electoral</label>
                                                        <textarea class=" editor form-control" name="code_electoral" rows="5">
                                                            {{ $election->code_electoral }}
                                                        </textarea>
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
                                <div id="flag-{{ $election->id }}" class="modal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('rootCodeElection') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <!-- BEGIN: Modal Header -->
                                                <div class="modal-header">
                                                    <h2 class="font-medium text-base mr-auto">Formulaire de Modification
                                                    </h2>
                                                </div> <!-- END: Modal Header -->
                                                <!-- BEGIN: Modal Body -->
                                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                    <div class="col-span-12 sm:col-span-6">
                                                        <input type="hidden" name="election_id"
                                                            value="{{ $election->id }}">
                                                        <label for="modal-form-1" class="form-label">Code electoral (pdf)</label>
                                                        <input type="file" class="form-control" name="image">
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
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @if ($elections->count() == 0)
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
                    {{ $elections->links() }}
                </nav>
            </div>
            <!-- END: Pagination -->
        </div>
    </div>
@endsection
