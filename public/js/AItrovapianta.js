
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
        api_key: "XNSt2KUrKzgoo38cwCI4dDGxVoY5PDg4HDm6YcapVInXdjhyTg",
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
        console.log('Nome comune della pianta: ', data.suggestions[0].plant_details.common_names[0]);
        console.log('Descrizione della pianta: ', data.suggestions[0].plant_details.wiki_description.value);
        console.log('Foto simile: ', data.suggestions[0].similar_images[0].url);
        var nome = data.suggestions[0].plant_details.common_names[0];
        var descrizione = data.suggestions[0].plant_details.common_names[0];
        var linkFoto = data.suggestions[0].similar_images[0].url;


        document.getElementById("namePlant").value = nome;
        //document.getElementById("description").innerHTML = "Potrebbe somigliare a: ";
        document.getElementById("similar").src = linkFoto;


      })
      .catch((error) => {
        console.error('Error:', error);
      });
    })

};
