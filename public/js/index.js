function deleteReservation(reservationId) {
  if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
    fetch("app/controllers/deleteReservation.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `id=${reservationId}`,
    })
      .then((response) => response.text())
      .then((result) => {
        if (result === "success") {
          document.getElementById(`row-${reservationId}`).remove();
        } else {
          alert("Error al eliminar el registro");
        }
      })
      .catch((error) => {
        alert("Error en la solicitud Fetch");
        console.error("Error:", error);
      });
  }
}

//SUGGESTIONS FUNCTIONS

function showSuggestions(value) {
  if (value.length === 0) {
    document.getElementById("suggestions").innerHTML = "";
    return;
  }

  fetch("../controllers/customerSuggestions.php?query=" + value)
    .then((response) => response.json())
    .then((data) => {
      let suggestions = "";
      data.forEach((item) => {
        suggestions += `<option value="${item.id}" onclick="selectSuggestion('${item.id}')">${item.text}</option>`;
      });
      document.getElementById("suggestions").innerHTML = suggestions;
    })
    .catch((error) => console.error("Error:", error));
}

function selectSuggestion(value) {
  // document.getElementById('customer-input').value = value;
  document.getElementById("suggestions").innerHTML = "";
}

// responsive navbar
document.addEventListener("DOMContentLoaded", () => {
  const $navbarBurger = document.querySelector(".navbar-burger");

  $navbarBurger.addEventListener("click", () => {
    const target = $navbarBurger.dataset.target;
    const $target = document.getElementById(target);

    $navbarBurger.classList.toggle("is-active");
    $target.classList.toggle("is-active");
  });
});
