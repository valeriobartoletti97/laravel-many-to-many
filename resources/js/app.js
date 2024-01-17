import "./bootstrap";
import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import.meta.glob(["../img/**", "../fonts/**"]);


const previewImage = document.getElementById('image');
previewImage.addEventListener('change', (event) => {
    let ofReader = new FileReader();

    ofReader.readAsDataURL(previewImage.files[0]);
    ofReader.onload = function (ofRevent){
        document.getElementById('uploadPreview').src=ofRevent.target.result;
    }
})