<div class="col mb-4">
    <div class="card" style="height: 100%;">
        <a href="{{ $pub->url}}" >
            <div class="plant">
                <?php
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($pub->foto).'" class="card-img-top" />';
                ?>
            </div>
        </a>
        <div class="card-body">
            <p style="font-size: 20px">PRODUTTORE: </p>
            <p style="font-size: 15px">{{$pub->produttore}}</p>
            <p style="font-size: 20px">PRODOTTO: </p>
            <p style="font-size: 15px">{{$pub->prodotto}}</p>
            <div class="row">
                <div class="col-10 text-truncate">
                    <a href="{{ $pub->url}}" class="btn btn-primary">scopri di piu</a>
                </div>
            </div>
        </div>
    </div>
</div>
