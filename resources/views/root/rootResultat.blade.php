@extends('layouts.root')

@section('page-content')

    <div class="col-span-12 2xl:col-span-12">
        <h2 class="intro-y text-lg font-medium mt-10">
            Gestion des Votes
        </h2>
        <div class="grid grid-cols-12 gap-12 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">

                <a href="javascript:;"
                    class="btn btn-primary shadow-md mr-2">Gestion des resultats</a>

                <div class="hidden md:block mx-auto text-slate-500">
                    Affiche de 1 a 10 sur {{ $resultats->count() }} statistiques
                </div>

                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <form id="search-ville" action="{{ route('rootSearchResultat') }}" method="GET" class="d-none">
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
                @if ($resultats->count() > 0)
                    <table class="table table-report -mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap text-center">ELECTION</th>
                                <th class="whitespace-nowrap text-center">CANDIDAT</th>
                                <!--th class="whitespace-nowrap text-center">CENTRE</th>
                                <th class="whitespace-nowrap text-center">BUREAU</th-->
                                <th class="text-center whitespace-nowrap">VOTES</th>
                                <th class="text-center whitespace-nowrap">POURCENTAGE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resultats as $resultat)
                                <tr class="intro-x">
                                    <td class="text-center">
                                        {{ $resultat->election_libelle }}
                                    </td>
                                    <td class="text-center">
                                        {{ $resultat->candidat_name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $resultat->total_votes  }}
                                    </td>
                                    <td class="text-center">
                                        {{ number_format((intval($resultat->total_votes) * 100) / intval(count($enrollements)), 2) }} %
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="col-span-12 2xl:col-span-12">
                        <div class="alert alert-pending alert-dismissible show flex items-center mb-2" role="alert"> <i
                                data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> Aucune statistique pour le
                            moment
                            ! </div>
                    </div>
                @endif
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    {{ $resultats->links() }}
                </nav>
            </div>
            <!-- END: Pagination -->
        </div>

    </div>




@endsection
