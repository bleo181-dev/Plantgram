nascondi();
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
      mostra();
    }
  }

  function mostra(comp) {
    document.getElementById("blah").style.display="block";
    }

    function nascondi() {
    document.getElementById("blah").style.display="none";
    }
