onload();

async function onload(){
	let path = "/penprak/admin/matkul/"
    let currentURL = window.location.pathname;
    let params = currentURL.replace(path, "");
    params = params.split("/");

	await fetch(base_url + "/api/getallmhs/" + params.join("/"))
		.then( res => res.json())
		.then( (result) => {
			let elm = document.querySelector(".tbody-custom");
			let elmBuild = ``;
			for(let i = 0; i < result.length; i++){
                let select = 1;
                if (result[i]["mhs"] == "true"){
                    select = 2;
                } else if (result[i]["asdos"] == "true"){
                    select = 3;
                }
				elmBuild += `
                <tr>
                    <td>${result[i]["npm"]}</td>
                    <td>${result[i]["namaMhs"]}</td>
                    <td>
                        <input type="hidden" name="npm[]" value="${result[i]["npm"]}">
                        <select name="status[]" class="form-select">
                            <option value="" ${(select == 1) ? "selected" : ""}>---</option>
                            <option value="Mahasiswa" ${(select == 2) ? "selected" : ""}>Mahasiswa</option>
                            <option value="Asisten Dosen" ${(select == 3) ? "selected" : ""}>Asisten Dosen</option>
                        </select>
                    </td>
                </tr>`
                
			}

			document.querySelector("#container-hidden").style.visibility = "visible";
			document.querySelector(".loader").style.display = "none";
			elm.innerHTML = elmBuild;
		})
}



function searchMhs() {
	var input, filter, table, tr, td, i, txtValue;
	input = document.getElementById("search-mhs");
	filter = input.value.toUpperCase();
	table = document.querySelector(".table-mhs");
	tr = table.getElementsByTagName("tr");

	for (i = 0; i < tr.length; i++) {

		td = tr[i].getElementsByTagName("td")[0];
		if (td) {
			txtValue = td.textContent || td.innerText;

			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}
	}
}