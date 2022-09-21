/* ==================== NOTE ==================== */
/*
* File ini merupakan Konfigurasi untuk upload files
* Files akan disimpan ke dalam direktori tertera
*/
/* ==================== NOTE ==================== */

// Mengambil elemen yang dibutuhkan
const form = document.getElementById("form-upload"),
fileInput = document.getElementById("input-file"),
progressArea = document.querySelector(".progress-area"),
uploadedArea = document.querySelector(".uploaded-area");

// Double click event untuk upload files
form.addEventListener("dblclick", () =>{
  fileInput.click();
});

// Mendefinisikan file yang diupload
fileInput.onchange = ({target})=>{
  // Apabila uplaod lebih dari 1 file, hanya akan membaca file pertama saja
  let file = target.files[0];
  if(file){
    // Mendapatkan nama file
    let fileName = file.name;
    // Mengatasi nama file jika terlalu panjang (max 25 huruf)
    if(fileName.length >= 50) { 
      let splitName = fileName.split('.');
      fileName = splitName[0].substring(0, 51) + "... ." + splitName[1];
    }
    uploadFile(fileName);
  }
}

// Konfigurasi file upload
function uploadFile(name){
  // Konfigurasi Ajax
  let xhr = new XMLHttpRequest(); 
  xhr.open("POST", "../php/functions.php"); 
  // File upload progress
  xhr.upload.addEventListener("progress", ({loaded, total}) =>{ 
    let fileLoaded = Math.floor((loaded / total) * 100); 
    let fileTotal = Math.floor(total / 1000); 
    let fileSize;
    // Apabila file lebih dari 1024 KB maka definisikan sebagai MB dan sebaliknya
    (fileTotal < 1024) ? fileSize = fileTotal + " KB" : fileSize = (loaded / (1024*1024)).toFixed(2) + " MB";
    let progressHTML = `<li class="row">
                          <i class="fas fa-file-alt"></i>
                          <div class="content">
                            <div class="details">
                              <span class="name">${name} • Uploading</span>
                              <span class="percent">${fileLoaded}%</span>
                            </div>
                            <div class="progress-bar">
                              <div class="progress" style="width: ${fileLoaded}%"></div>
                            </div>
                          </div>
                        </li>`;
    uploadedArea.classList.add("onprogress");
    progressArea.innerHTML = progressHTML;
    if(loaded == total){
      progressArea.innerHTML = "";
      let uploadedHTML = `<li class="row">
                            <div class="content upload">
                              <i class="fas fa-file-alt"></i>
                              <div class="details">
                                <span class="name">${name} • Uploaded</span>
                                <span class="size">${fileSize}</span>
                              </div>
                            </div>
                            <i class="fas fa-check"></i>
                          </li>`;
      uploadedArea.classList.remove("onprogress");
      uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML); 
    }
  });

  // Mengirimkan form upload file
  let data = new FormData(form);
  xhr.send(data);
}