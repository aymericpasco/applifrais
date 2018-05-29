<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="{{ url('/home') }}">
        <img src="{{ url('/img/logo-gsb.png') }}" height="40" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @auth
                @if(Auth::user()->hasRole('visiteur'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('fiches.liste', ['userId' => Auth::user()->id]) }}">
                            Consulter mes fiches de frais
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ajout.frais', ['userId' => Auth::user()->id]) }}">
                            Ajouter un nouveau frais
                        </a>
                    </li>
                @elseif(Auth::user()->hasRole('comptable'))
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                           data-toggle="modal" data-target="#closeAll">
                            Cloturer fiches
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('visiteurs.liste', ['accountantId' => Auth::user()->id]) }}">
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
        <ul class="navbar-nav ">

            @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a></li>
            @else
                <li><a class="nav-link disabled" href="#">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</a></li>
                <li><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Déconnexion') }}
                    </a></li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </ul>
        {{--<form class="form-inline my-2 my-lg-0">--}}
            {{--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">--}}
            {{--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
        {{--</form>--}}
    </div>
    </div>
</nav>