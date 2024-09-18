
const today = new Date();

const year = today.getFullYear();
const month = (today.getMonth() + 1).toString().padStart(2, "0");
const day = today.getDate().toString().padStart(2, "0");

const fechaInput = document.getElementById("reservation_date");
fechaInput.setAttribute("min", `${year}-${month}-${day}`);


fechaInput.addEventListener("change", function (e) {
  const filterDate = e.target.value;
  fetch(
    `../controllers/filterAvailableReservations.php?filter_date=${encodeURIComponent(
      filterDate
    )}`
  )
    .then((response) => response.text())
    .then((data) => {
      console.log(data);
      document.getElementById("availableSlotsTableBody").innerHTML = data;
    })
    .catch((error) => console.error("Error:", error));
});

//Receive the reservation data and send it to the server for validation

const form = document.getElementById("reservation_form");

form.addEventListener("submit", function (event) {
  event.preventDefault();

  const formData = new FormData(this);

  fetch("../controllers/processReservationForm.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "success") {
        window.location.href = "../../index.php";
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
