onload();

async function onload(){
    await fetch(base_url + "/api/kelasMhs")
        .then(res => res.json())
        .then(async function(result) {
            let elm = document.querySelector(".row-custom");
            let elmBuild = ``;
            for(let i = 0; i < result.length; i++){
				let namaAsdos = [];
				if (result[i].asdos[1]){
					namaAsdos.push(await dataAsdos(result[i].asdos[1]));
				}
                namaAsdos.push(await dataAsdos(result[i].asdos[0]));
                elmBuild += updateCard(result[i].matkul, namaAsdos, result[i].idMatkul, result[i].semester);
            }
            document.querySelector(".loading").style.display = "none";
            elm.innerHTML = elmBuild;
        });
}

async function dataAsdos(target) {
    let res = await fetch(base_url + "/api/profile/" + target)
    let asdos = await res.json();
    return asdos.namaMhs;
}

function updateCard(matkul, asdos, idmatkul, semester){
    let index = Math.floor(Math.random() * 5) + 1;
    return `
<div class="col-md-4 card-kelas">
    <div class="card mb-4 kelas-custom">
      <div class="banner-kelas banner-background-${index}"></div>
      <div class="card-body">
        <h4 class="card-title">${matkul}</h4>
        <p class="card-subtitle mb-2 text-body-secondary">${asdos[0]} ${(asdos[1]) ? "dan " + asdos[1] : ""}</p>
        <a href="${base_url + "/kelas/index/" +idmatkul + "/" + semester}" class="btn btn-primary mt-4 ">Masuk kelas</a>
      </div>
    </div>
  </div>`
}