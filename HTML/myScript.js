function patient_forms(key) {
    if (key == 1) {
        document.getElementById("pat_details").style.display = "block";
        document.getElementById("info_form").style.display = "none";
        document.getElementById("pass_form").style.display = "none";
    }
    else if (key == 2) {
        document.getElementById("pat_details").style.display = "none";
        document.getElementById("info_form").style.display = "block";
        document.getElementById("pass_form").style.display = "none";
    }
    else if (key == 3) {
        document.getElementById("pat_details").style.display = "none";
        document.getElementById("info_form").style.display = "none";
        document.getElementById("pass_form").style.display = "block";
    }
}
function doctor_forms(key) {
    if (key == 1) {
        document.getElementById("doc_details").style.display = "block";
        document.getElementById("info_form").style.display = "none";
        document.getElementById("pass_form").style.display = "none";
    }
    else if (key == 2) {
        document.getElementById("doc_details").style.display = "none";
        document.getElementById("info_form").style.display = "block";
        document.getElementById("pass_form").style.display = "none";
    }
    else if (key == 3) {
        document.getElementById("doc_details").style.display = "none";
        document.getElementById("info_form").style.display = "none";
        document.getElementById("pass_form").style.display = "block";
    }
}

function nurse_forms(key) {
    if (key == 1) {
        document.getElementById("nurse_details").style.display = "block";
        document.getElementById("info_form").style.display = "none";
        document.getElementById("pass_form").style.display = "none";
    }
    else if (key == 2) {
        document.getElementById("nurse_details").style.display = "none";
        document.getElementById("info_form").style.display = "block";
        document.getElementById("pass_form").style.display = "none";
    }
    else if (key == 3) {
        document.getElementById("nurse_details").style.display = "none";
        document.getElementById("info_form").style.display = "none";
        document.getElementById("pass_form").style.display = "block";
    }
}