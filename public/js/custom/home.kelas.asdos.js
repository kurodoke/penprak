onload();

async function onload(){
    await fetch(base_url + "/api/kelasAsdos")
        .then(res => res.json())
        .then(async function(result) {
            let elm = document.querySelector(".row-custom");
            let elmBuild = ``;
            if( result["status"] != "err"){
              for(let i = 0; i < result.length; i++){
                  elmBuild += updateCard(result[i].matkul, result[i].idMatkul, result[i].semester);
              }
            }
            document.querySelector(".loading").style.display = "none";
            elm.innerHTML = elmBuild;
        });
}

function updateCard(matkul, idmatkul, semester){
    let index = Math.floor(Math.random() * 5) + 1;
    return `
<div class="col-md-4 card-kelas">
    <div class="card mb-4 kelas-custom">
      <div class="banner-kelas banner-background-${index}"></div>
      <div class="card-body">
        <h4 class="card-title">${matkul}</h4>
        <p class="card-subtitle mb-2 text-body-secondary">Aku</p>
        <a href="${base_url + "/kelas/index/" +idmatkul + "/" + semester}" class="btn btn-primary mt-4 ">Masuk kelas</a>
      </div>
    </div>
  </div>`
}