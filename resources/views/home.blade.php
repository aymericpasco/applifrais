@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <ul class="list-group list-group-flush">
            @auth
                @if(Auth::user()->hasRole('visiteur'))
                        <li class="list-group-item">
                        <a href="{{ route('fiches.liste', ['userId' => Auth::user()->id]) }}">
                            Consulter mes fiches de frais
                        </a>
                        </li>
                        <li class="list-group-item">
                        <a  href="{{ route('ajout.frais', ['userId' => Auth::user()->id]) }}">
                            Ajouter un nouveau frais
                        </a>
                        </li>
                @elseif(Auth::user()->hasRole('comptable'))
                    <li class="list-group-item">
                        <a href="#"
                           data-toggle="modal" data-target="#closeAll">
                            Cloturer fiches
                        </a>
                    </li>
                        <li class="list-group-item">
                        <a href="{{ route('visiteurs.liste', ['accountantId' => Auth::user()->id]) }}">
                            Liste des visiteurs
                        </a>
                    </li>

                    <div class="modal fade" id="closeAll" tabindex="-1" role="dialog" aria-labelledby="closeAll" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Veuillez confirmer la cloture de l'ensemble des fiches de frais encore en cours du mois précédent.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <a type="button" class="btn btn-primary"
                                       href="{{ route('cloturer.fiches', ['accountantId' => Auth::user()->id]) }}">
                                        Confirmer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
            </ul>
        </div>
    </div>
@endsection
