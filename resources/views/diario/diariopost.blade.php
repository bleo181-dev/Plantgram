<div class="card">
    <div class="row no-gutters">
        <div class="col-md-4">
            <?php

                echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode($i->foto).'"/>';

            ?>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">{{ ($i->testo)}}</p>

                <p class="card-text">{{$i->updated_at}}<small class="text-muted"></small></p>

                <a href = "{{ URL::action('DiarioController@edit', $i->codice_diario)}}"><button class="btn btn-primary">Modifica</button></a>

                <form action = "{{ URL::action('DiarioController@destroy', $i->codice_diario)}}" method = "POST">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type = "submit" class = "btn btn-danger">Elimina</button>
                </form>

            </div>
        </div>
    </div>
</div>
