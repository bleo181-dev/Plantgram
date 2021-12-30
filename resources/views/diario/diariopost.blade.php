<div class="card">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="/app/immagini/pianta.jpg" alt="" class="card-img" >
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">{{ ($i->testo)}}</p>

                <a href = "{{ URL::action('DiarioController@edit', $i->codice_diario)}}"><button class="btn btn-primary">Modifica</button></a>
                                            
                <form action = "{{ URL::action('DiarioController@destroy', $i->codice_diario)}}" method = "POST">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type = "submit" class = "btn btn-danger">Elimina</button>
                </form>
                <p class="card-text"><small class="text-muted"></small></p>
            </div>
        </div>
    </div>
</div>