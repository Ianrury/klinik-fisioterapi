// public/js/app.js
// import Swal from "sweetalert2";

// Anda dapat menggunakan swal di sini
function showAlert(message) {
  Swal.fire({
    title: "Success!",
    text: message,
    icon: "success",
    confirmButtonText: "OK",
  });
}

// document.addEventListener("DOMContentLoaded", () => {
//   // Memunculkan SweetAlert ketika DOM sudah selesai dimuat
//   Swal.fire({
//     title: "Hello!",
//     text: "Ini adalah pesan SweetAlert2.",
//     icon: "info",
//     confirmButtonText: "OK",
//   });
// });

// Optional: If you want to use it elsewhere in your script
document.addEventListener("DOMContentLoaded", () => {
  // Any initialization if needed
});
