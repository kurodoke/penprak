var elm = document.querySelector(".profile-a");

var imgInput = document.querySelector("#imgProfile").addEventListener("change", function() {
	if(this.files && this.files[0]){
		var reader = new FileReader();

		reader.onload = function(e) {

		document.querySelector("#img-profile").attributes.src.value = e.target.result;
		}

		reader.readAsDataURL(this.files[0]);
	}
});

var event = elm.addEventListener('click', async function () {
	await fetch(base_url + "/api/profile")
		.then( res => res.json())
		.then( (result) => {
			updateModal(result);
		})
		.catch( err => console.error(err));
})

async function updateModal(res) {
	document.querySelector("#profileModal").innerHTML = `
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-5 m-auto w-0 text-center">
								<button type="button" class="invis-button"  data-bs-target="#profileModal2" data-bs-toggle="modal">
									<img src="${ base_url }/public/img/profile/${(res["profileStatus"] == 1) ? res["npm"] : "default"}.jpg" class="img-thumbnail img-fluid mx-auto d-block" id="img-profile" alt="">
								</button>
							</div>
							<div class="col-7">
								<div class="row">
									<div class="col mb-1">
										<label for="profile-npm" class="col-form-label">NPM</label>
										<input type="text" class="form-control" id="profile-npm" placeholder="${res['npm']}" readonly>
									</div>
									<div class="col mb-1">
										<label for="profile-name" class="col-form-label">Nama</label>
										<input type="text" class="form-control" id="profile-name" placeholder="${res['namaMhs']}" readonly>
									</div>
								</div>
								<div class="row">
									<div class="col mb-1">
										<label for="profile-fakultas" class="col-form-label">Fakultas</label>
										<input type="text" class="form-control" id="profile-fakultas" placeholder="${res['fakultas']}" readonly>
									</div>
									<div class="col mb-1">
										<label for="profile-prodi" class="col-form-label">Program Studi</label>
										<input type="text" class="form-control" id="profile-prodi" placeholder="${res['prodi']}" readonly>
									</div>
								</div>
								<div class="row">
									<div class="mb-1">
										<label for="profile-tgllahir" class="col-form-label">Tanggal Lahir</label>
										<input type="date" class="form-control" id="profile-tgllahir" value="${(res['tglLahir'] == null) ? "" : res['tglLahir']}" name="tglLahir">
									</div>
								</div>
								<div class="row">
									<div class="mb-1">
										<label for="profile-email" class="col-form-label">Email</label>
										<input type="email" class="form-control" id="profile-email" placeholder="${(res['email'] == null) ? "" : res['email']}" value="${(res['email'] == null) ? "" : res['email']}" name="email">
									</div>
								</div>
								<div class="row">
									<div class="mb-1">
										<label for="profile-alamat" class="col-form-label">Alamat</label>
										<textarea class="form-control" id="profile-alamat" placeholder="${(res['alamat'] == null) ? "" : res['alamat']}" name="alamat">${(res['alamat'] == null) ? "" : res['alamat']}</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>
			</div>
		</div>`;
}

function updateModalAdmin() {
let modal = document.querySelector("#profileModal").innerHTML = `
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Profile</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body m-auto">
				<h1 class=""> Login sebagai Admin</h1>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>`;
}

