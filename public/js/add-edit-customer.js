



//Receive the reservation data and send it to the server for validation

const form = document.getElementById("customer_form");

form.addEventListener("submit", function (event) {
  event.preventDefault();

  const formData = new FormData(this);

  fetch("../controllers/processCustomerForm.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "success") {
        window.location.href = "../../index.php?view=clients";
      } else {
        document.querySelector(".message").style.display = "block";
        document.querySelector(".message-body").innerHTML = data;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      document.querySelector(".message").style.display = "block";
      document.querySelector(".message-body").innerHTML =
        "Error en la solicitud.";
    });
});
