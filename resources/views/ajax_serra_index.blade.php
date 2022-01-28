
<script>

var oldLength_collab = -1; //serve per non refreshare sempre il contenutto, evitando sfarfallii

            function fetch_data_collab(){

                $.ajax({
                    url:"/collabora/fetch_data",
                    dataType:"json",
                    success:function(data){
                        var html = '';
                        var modal = '';

                        for(var count=0; count < data.length; count++){
                                html += '<p class="dropdown-item" style="pointer-events: none;">'+data[count].nickname;
                                html += '<button id="'+count+'" name="btn_a"type = "submit" style="float: right; pointer-events: fill; background: none; border: none; width: 10px;" data-toggle="modal" data-target="#staticBackdrop'+data[count].codice_collaborazione+'"><img src="'+'{{ asset("immagini/delete.png") }}'+'"  class="icone"></button>';

                                modal += '<div class="modal fade" id="staticBackdrop'+data[count].codice_collaborazione+'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';
                                modal += '<div class="modal-dialog">';
                                modal += '<div class="modal-content">';
                                modal += '<div class="modal-header">';
                                modal += '<h5 class="modal-title" id="staticBackdropLabel"></h5>';
                                modal += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                modal += '<span aria-hidden="true">&times;</span></button>';
                                modal += '</div>';
                                modal += '<div class="modal-body">';
                                modal += 'Sei sicuro di voler eliminare il collaboratore '+data[count].nickname+'?</div>';
                                modal += '<div class="modal-footer">';
                                modal += '<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>';
                                modal += '<form action="" method="POST" class="col-md-2">';
                                modal += '<input type="hidden" name="nome" value="">';
                                modal += '<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="destroy_collaboratore_a_serra('+data[count].codice_collaborazione+')">Si</button></form></div></div></div></div>';

                        }
                        if(oldLength_collab != data.length){ //serve per non refreshare sempre il contenutto, evitando sfarfallii
                            document.getElementById("collab").innerHTML = html;
                            document.getElementById("num_collab").innerHTML = data.length;
                            document.getElementById("modal2").innerHTML = modal;
                            console.log('Aggiorno: Elementi variati collaboratori');
                            oldLength_collab = data.length;

                        }

                    },
                        error: function(response, stato){
                            console.log(stato);
                        }
                });
            }

            var oldLength_serre = -1;
            function fetch_data_serre(){

                $.ajax({
                    url:"/serra/fetch_data_serre",
                    dataType:"json",
                    success:function(data){

                        var html_serre = '';
                        var modal = '';

                        for(var count=0; count < data.length; count++){
                                html_serre += '<div class="btn-group w-100">';
                                html_serre += '<a class="btn btn-primary btn-lg btn-block" type="button" href="{{ asset("serra/share/") }}/'+data[count].codice_serra+'">'+data[count].nome+'</a>';
                                html_serre += '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#staticBackdrop'+data[count].codice_collaborazione+'">';
                                html_serre += '<img src="{{ asset("immagini/delete.png") }}" class="iconeSerraCestino"></button></div><br><br>';

                                modal += '<div class="modal fade" id="staticBackdrop'+data[count].codice_collaborazione+'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';
                                modal += '<div class="modal-dialog">';
                                modal += '<div class="modal-content">';
                                modal += '<div class="modal-header">';
                                modal += '<h5 class="modal-title" id="staticBackdropLabel"></h5>';
                                modal += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                modal += '<span aria-hidden="true">&times;</span></button>';
                                modal += '</div>';
                                modal += '<div class="modal-body">';
                                modal += 'Sei sicuro di non voler più collaborare con la serra '+data[count].nome+'?</div>';
                                modal += '<div class="modal-footer">';
                                modal += '<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>';
                                modal += '<form action="" method="POST" class="col-md-2">';
                                modal += '<input type="hidden" name="nome" value="">';
                                modal += '<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="destroy_collaborazioneSerra('+data[count].codice_collaborazione+')">Si</button></form></div></div></div></div>';
                        }

                        if(oldLength_serre != data.length){ //serve per non refreshare sempre il contenutto, evitando sfarfallii
                            document.getElementById("pills-profile").innerHTML = html_serre;
                            document.getElementById("modal").innerHTML = modal;
                            console.log('Aggiorno: Elementi variati serre');
                            oldLength_serre = data.length;

                        }

                    },
                        error: function(response, stato){
                            console.log(stato);
                        }
                });
            }

            function destroy_collaborazioneSerra(id){
                console.log('Elimino: Codice_collab-'+id);
                var _token = $('#_token').val();
                console.log('token: '+_token);
                if(id != null){
                    $.ajax({
                        url: "/collabora/eliminaCollaborazione",
                        type: "POST",
                        dataType: "json",
                        data: {'id' : id, '_token' : _token},
                        success: function(data){
                            console.log(data);
                            if(data.success === 'OK'){
                                fetch_data_collab();
                                fetch_data_serre();
                                console.log("aggiorno dopo elimina");
                            }else{
                                console.log("Errore eliminazione collaborazione: "+id+" non sei il proprietario!");
                            }


                        },
                        error: function(response, stato){
                            console.log(stato);
                        }
                    });
                }

            }


            function destroy_collaboratore_a_serra(id){
                console.log('Elimino: Codice_collab-'+id);
                var _token = $('#_token').val();
                console.log('token: '+_token);
                if(id != null){
                    $.ajax({
                        url: "/collabora/eliminaCollaboratore",
                        type: "POST",
                        dataType: "json",
                        data: {'id' : id, '_token' : _token},
                        success: function(data){
                            console.log(data);
                            if(data.success === 'OK'){
                                fetch_data_collab();
                                fetch_data_serre();
                                console.log("aggiorno dopo elimina");
                            }else{
                                console.log("Errore eliminazione collaborazione: "+id+" non sei il proprietario!");
                            }


                        },
                        error: function(response, stato){
                            console.log(stato);
                        }
                    });
                }

            }

        $(document).ready(function(){

            fetch_data_collab();
            fetch_data_serre();
            setInterval(fetch_data_collab, (4 * 1000)); //setta un timer che effettua la chiamata ajax ogni 4 secondi
            setInterval(fetch_data_serre, (4 * 1000)); //setta un timer che effettua la chiamata ajax ogni 4 secondi
            console.log('Intervallo di aggiornamento settato!');

        });

</script>
