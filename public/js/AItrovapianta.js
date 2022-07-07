//document.getElementById("mostraSimile").style.display="none";
function isEmpty(str) {
    return (!str || str.length === 0 );
}

document.querySelector('#cerca').onclick = function sendIdentification() {
    const files = [...document.querySelector('input[type=file]').files];
    const promises = files.map((file) => {
      return new Promise((resolve, reject) => {
          const reader = new FileReader();
          reader.onload = (event) => {
            const res = event.target.result;
            console.log(res);
            resolve(res);
          }
          reader.readAsDataURL(file)
      })
    })

    Promise.all(promises).then((base64files) => {
      console.log(base64files)

      const data = {
        api_key: "[your_apiKey]",
        images: base64files,
        // modifiers docs: https://github.com/flowerchecker/Plant-id-API/wiki/Modifiers
        modifiers: ["crops_fast", "similar_images"],
        plant_language: "it",
        // plant details docs: https://github.com/flowerchecker/Plant-id-API/wiki/Plant-details
        plant_details: ["common_names",
                          "url",
                          "name_authority",
                          "wiki_description",
                          "taxonomy",
                          "synonyms"],
        // disease details docs: https://github.com/flowerchecker/Plant-id-API/wiki/Disease-details
        disease_details: ["common_names", "url", "description"]
      };

      fetch('https://api.plant.id/v2/identify', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        console.log('Success:', data); //stampa tutti i dati possibili e immaginabili abilitare solo per poi estrarre quello che serve

        if(data.suggestions != null){
            document.getElementById("mostraSimile").style.display="block";
            var nome, descrizione, linkFoto;
            if(data.suggestions[0].plant_details.common_names == null){
                var nome = data.suggestions[0].plant_details.name_authority;
                console.log('Nome comune della pianta: ', nome);
            }else{
                var nome = data.suggestions[0].plant_details.common_names[0];
                console.log('Nome comune della pianta: ', nome);
            }

            if(data.suggestions[0].plant_details.wiki_description == null){
                var descrizione = "Nessuna descrizione trovata";
                console.log('Descrizione della pianta: ', descrizione);
            }else{
                var descrizione = data.suggestions[0].plant_details.wiki_description.value;
                console.log('Descrizione della pianta: ', descrizione);
            }

            if(data.suggestions[0].similar_images != null){
                var linkFoto = data.suggestions[0].similar_images[0].url;
                console.log('Foto simile: ', linkFoto);
                document.getElementById("similarIm").src = linkFoto;
            }

            document.getElementById("namePlant").value = nome;
            document.getElementById("description").innerHTML = descrizione;
            document.getElementById("titlePrew").innerHTML = nome;


        }else{
            document.getElementById("description").innerHTML = "Nessun risultato trovato! Prova a fare una foto migliore!";
        }





      })
      .catch((error) => {
        console.error('Error:', error);
      });
    })

};
