<div class="col mb-4">
    <div class="card">
        <a href="{{ $pub->url}}" >
            <div class="plant">
                <?php
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($pub->foto).'" class="card-img-top" />';
                ?>
            </div>
        </a>
        <div class="card-body">
            <p>{{$pub->produttore}}</p>
            <div class="row">
                <div class="col-10 text-truncate">
                    <a href="{{ $pub->url}}" class="btn btn-primary">scopri di piu</a>
                </div>
            </div>
        </div>
    </div>
</div>
