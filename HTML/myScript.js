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