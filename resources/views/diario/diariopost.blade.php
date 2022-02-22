<div class="card col-md-8" style="color: none;">
    <div class="row no-gutters">
        <div class="col-md-4">
            <?php

                echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode($i->foto).'"/>';
            ?>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text" style="font-size:20px;">{{ ($i->testo)}}</p>

                <p class="card-text">{{$i->updated_at}}<small class="text-muted"></small></p>
            </div>
        </div>
        <div class="col-md-2">
            <div style="display: flex; align-items: center;">
                <a href="{{ URL::action('DiarioController@edit', $i->codice_diario) }}"> <img src="{{ asset('immagini/modifica.png') }}"  class="icone"> </a>
                <form id="delete-form-{{$i->codice_diario}}" action="{{ URL::action('DiarioController@destroy', $i->codice_diario) }}" method="POST">
                    {{ csrf_field() }}
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none;"><img src="{{ asset('immagini/delete.png') }}"  class="icone"></button>
                </form>
            </div>
        </div>
    </div>
</div>
