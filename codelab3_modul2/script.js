function validateForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (name === "" || email === "" || password === "") {
        alert("Semua data harus diisi.");
    } else {
        alert("Data berhasil dikirim!");
        // Lakukan tindakan lain seperti submit form
        // document.getElementById("registrationForm").submit();
    }
}
