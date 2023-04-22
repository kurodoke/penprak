onload();

async function onload(){
    let path = "/penprak/kelas/mahasiswa/"
    let currentURL = window.location.pathname;
    let params = currentURL.replace(path, "");
    params = params.split("/");

    await fetch(base_url + "/api/mahasiswa/" + params.join("/"))
        .then( res => res.json())
        .then( (result) => {
            let elm = document.querySelector(".data-mhs")
            let elmBuild = ``;
            result.forEach( data => {
                elmBuild += `
                    <div class="col-sm-2 mb-3 d-flex align-items-stretch">
                        <div class="card">
                            <img src="${ base_url }/public/img/profile/${(data["profileStatus"] == 1) ? data["npm"] : "default"}.jpg" alt="" class="card-img-top img-same-size">
                            <div class="card-body text-center">
                                <h4 class="card-title">${data['namaMhs']}</h4>
                                <h6 class="card-subtitle mb-2 text-muted">${data['npm']}</h6>
                                <p class="card-text"><strong>${(data['email'] == null) ? "" : data['email']}</strong></p>
                            </div>
                        </div>
                    </div>`;
            })
            elm.innerHTML = elmBuild;

        });
}