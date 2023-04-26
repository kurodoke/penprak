onload();

async function onload(){
	await fetch(base_url + "/api/getsimpleallmhs" )
		.then( res => res.json())
		.then( (result) => {
			let elm = document.querySelector(".tbody-custom");
			let elmBuild = ``;
			for(let i = 0; i < result.length; i++){
				elmBuild += `
                <tr>
                    <td>${result[i]["npm"]}</td>
                    <td>${result[i]["namaMhs"]}</td>
                    <td>
                        <a href="${base_url + "/admin/delmhs/" + result[i]["npm"]}" class="btn btn-danger btn-sm">Hapus</a>
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