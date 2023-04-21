onload();

async function onload(){
    let path = "/penprak/kelas/index/"
    let currentURL = window.location.pathname;
    let params = currentURL.replace(path, "");
    params = params.split("/");

    await fetch(base_url + "/api/nilai/" + params.join('/'))
        .then( res => res.json())
        .then( (result) => {
            let nilai = parseFloat((result['nilai'] == null) ? "0" : result['nilai'] );
            let huruf = nilaiHuruf(nilai);
            let elm = document.querySelector(".modal-nilai");
            elm.innerHTML = `<h1>${nilai}(${huruf})</h1>`;
        })

    await fetch(base_url + "/api/matkul/" + params[0])
        .then( res => res.json())
        .then( (result) => {
            let elm = document.querySelector(".banner-kelas-big");
            elm.innerHTML = `
            <div class="col mt-3 p-2 rounded mb-3 banner-background-${Math.floor(Math.random() * 5) + 1}">
                <h2 class="card-title m-5 text-white">
                    ${result['matkul']}
                </h2>
            </div>`;
        })

    //bobot
    await fetch(base_url + "/api/bobot/" + params.join("/"))
        .then( res => res.json())
        .then( (result) => {
            let elm = document.querySelector(".bobot-custom");
            let elmBuild = `
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Deskripsi Kelas</h4>
                    <h5 class="card-subtitle mb-2 text-body-secondary">Bobot Nilai</h5>`;
            result.forEach(data => {
                elmBuild += `<p class="card-text">${(data["jenis"])} : ${data["bobot"]}</p>`
            });
            elmBuild += `
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNilai">Lihat Nilai Kamu!</a>
                </div>
            </div>`
            elm.innerHTML = elmBuild;
        })
    
    //tugas
    await fetch(base_url + "/api/tugas/" + params.join("/"))
        .then( res => res.json())
        .then( (result) => {
            let elm = document.querySelector(".tugas-custom");
            let elmBuild = ``;
            result.forEach(data => {
                elmBuild += `
                <div class="card mb-3">
                <form action="${base_url + "/kelas/upload/" + params.join("/")}" method="post" enctype="multipart/form-data">
                    <div class="card-header">${data['jenis']}</div>
                    <div class="card-body">
                        <h5 class="card-title">Tugas ke-${data['nomorTugas']}</h5>
                        <p class="card-text mb-2" style="white-space: pre-line;">${data['deskripsi']}</p>`
                    if (data['file'] == null){
                        elmBuild += `
                        <label for="inputTugas" class="form-label">Upload tugas kamu</label>
                        <input class="form-control" type="file" id="inputTugas" name="fileTugas">
                        <button type="submit" class="btn btn-primary mt-3" name="submit-tugas">Submit Tugas</button>`;
                    } else {
                        if(data['nilai'] == null){
                            elmBuild += `
                            <blockquote class="blockquote mb-0"> kamu sudah kumpul tugas!!
                                <footer class="blockquote-footer mt-1">tunggu ajaa... nanti dinilai</footer>
                            </blockquote>`;
                        } else {
                            elmBuild += `
                            <blockquote class="blockquote mb-0"> Nilai kamu ${data['nilai']}</blockquote>`;
                        }
                    }
                    elmBuild += `
                        <input type="hidden" value="${data['nomorTugas']}" name="nomorTugas">
                    </div>
                </form>
                </div>`;
            })
            elm.innerHTML = elmBuild;
        })
    document.querySelector(".loading").style.display = "none";
    
}

function nilaiHuruf(nilai){
    let huruf = ``;
    if (nilai >= 85) {
        huruf = "A"
    } else if(nilai >= 80) {
        huruf = "A-"
    } else if(nilai >= 75) {
        huruf = "B+"
    } else if(nilai >= 70) {
        huruf = "B"
    } else if(nilai >= 65) {
        huruf = "B-"
    } else if(nilai >= 60) {
        huruf = "C+"
    } else if(nilai >= 55) {
        huruf = "C"
    } else if(nilai >= 45) {
        huruf = "D"
    } else {
        huruf = "E"
    }
    return huruf;
}

function generateRandomString(length) {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    for (let i = 0; i < length; i++) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
  }