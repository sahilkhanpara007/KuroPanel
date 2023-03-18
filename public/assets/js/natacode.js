$(".after-card").hide();
$(document).ready(function () {
  $(".after-card").fadeIn("slow");
  $("input").change(function (e) {
    e.preventDefault();
    $(".form-text, .alert-danger, .form-group .text-danger").hide();
  });
});

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  },
});
