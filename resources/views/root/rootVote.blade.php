@extends('layouts.root')

@section('page-content')

    <div class="col-span-12 2xl:col-span-12">
        <h2 class="intro-y text-lg font-medium mt-10">
            Gestion des Votes
        </h2>
        <div class="grid grid-cols-12 gap-12 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">

                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#large-modal-size-preview"
                    class="btn btn-primary shadow-md mr-2">Nouveau Vote</a>

                <!-- BEGIN: Large Modal Content -->
                <!-- BEGIN: Modal Content -->
                <div id="large-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('rootAddVote') }}">
                                @csrf
                                <!-- BEGIN: Modal Header -->
                                <div class="modal-header">
                                    <h2 class="font-medium text-base mr-auto">Formulaire de vote</h2>
                                </div> <!-- END: Modal Header -->
                                <!-- BEGIN: Modal Body -->
                                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-1" class="form-label">Code Electeur</label>
                                        <input type="text" class="form-control" placeholder="123455656" name="code_electeur" required>
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
                                        <label for="modal-form-6" class="form-label">Bureau</label>
                                        <select id="modal-form-6" class="form-select" name="bureau_id">
                                            @foreach ($bureaux as $bureau)
                                                <option value="{{ $bureau->id }}">{{ $bureau->libelle }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-12 sm:col-span-6">
                                        <label for="modal-form-6" class="form-label">Candidat</label>
                                        <select id="modal-form-6" class="form-select" name="candidat_id">
                                            @foreach ($candidats as $candidat)
                                                <option value="{{ $candidat->citoyen->id }}">{{ $candidat->citoyen->name }}</option>
                                            @endforeach
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
                    Affiche de 1 a 10 sur {{ $bureaux->count() }} votes
                </div>

                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <form id="search-ville" action="{{ route('rootSearchVote') }}" method="GET" class="d-none">
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
                @if ($votes->count() > 0)
                    <table class="table table-report -mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap text-center">ELECTION</th>
                                <th class="whitespace-nowrap text-center">CENTRE</th>
                                <th class="whitespace-nowrap text-center">BUREAU</th>
                                <th class="text-center whitespace-nowrap">CANDIDAT</th>
                                <th class="text-center whitespace-nowrap">ELECTEUR</th>
                            </tr>
                        </thead>
                        <tbody>

                            
                                @foreach ($votes as $vote)
                                    <tr class="intro-x">
                                        <td class="w-40">
                                            {{ $vote->election_id ? $vote->election->code : 'Non defini' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $vote->centre_id ? $vote->centre->code : 'Non defini' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $vote->bureau_id ? $vote->bureau->code : 'Non defini' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $vote->candidat_id ? $vote->candidat->name : 'Non defini' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $vote->enrollement ? $vote->enrollement->code : 'Non defini'  }}
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="col-span-12 2xl:col-span-12">
                        <div class="alert alert-pending alert-dismissible show flex items-center mb-2" role="alert"> <i
                                data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> Aucun vote pour le
                            moment
                            ! </div>
                    </div>
                @endif
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    {{ $votes->links() }}
                </nav>
            </div>
            <!-- END: Pagination -->
        </div>

    </div>




@endsection
