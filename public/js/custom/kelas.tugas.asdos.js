onload();

async function onload() {
    let path = "/penprak/kelas/tugas/"
    let currentURL = window.location.pathname;
    let params = currentURL.replace(path, "");
    params = params.split("/");

    await fetch(base_url + "/api/tugasAsdos/" + params.join("/"))
        .then(res => res.json())
        .then( (result) => {
            let elm = document.querySelector(".nilai-custom");
            let elmBuild = ``;
            let index = 0;
            if( result["status"] != "err"){
                result.forEach(data => {
                    let temp = ``;
                    let status = ``;
                    if(data["file"] != null) {
                        temp = `
                        <input type="hidden" name="npm[${index}]" value="${data['npm']}">
                        <a href="${base_url + "/public/pdf/" + data['file']}" class="text-decoration-none text-secondary"><i class="fa-solid fa-circle-check text-success"></i> Lihat Tugas~</a>`;
                    } else {
                        temp = `
                        <input type="hidden" name="npm[${index}]" value="${data['npm']}">
                        <p class="card-text text-secondary"><i class="fa-solid fa-circle-xmark text-danger"></i> Belum Mengumpulkan</p>
                        `;
                        status = `disabled`;
                    }

                    elmBuild += `
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">${data['npm']}</h5>
                                    ${temp}
                                    <div class="input-group mt-3">
                                        <input type="number" min="0" max="100" class="form-control" name="nilai[${index}]" value="${(data['nilai'] == null) ? "" : data['nilai']}" ${status}><span class="input-group-text">/100</span>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    index++;
                });
            }
            elm.innerHTML = elmBuild;
        })

    document.querySelectorAll(".hidden-elm").forEach( elm => {
        elm.style.display = "block";
    })
    document.querySelector(".loading").style.display = "none";
}