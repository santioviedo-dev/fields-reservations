//Receive the reservation data and send it to the server for validation

const fieldForm = document.getElementById("field_form");
const fieldTypeForm = document.getElementById("fieldType_form");

fieldForm.addEventListener("submit", function (event) {
  event.preventDefault();

  const formData = new FormData(this);

  fetch("../controllers/processFieldForm.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "success") {
        window.location.href = "../../index.php?view=fields";
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

//MODAL

document.addEventListener("DOMContentLoaded", () => {
  function openModal($el) {
    $el.classList.add("is-active");
  }

  function closeModal($el) {
    $el.classList.remove("is-active");
  }

  function closeAllModals() {
    (document.querySelectorAll(".modal") || []).forEach(($modal) => {
      closeModal($modal);
    });
  }

  (document.querySelectorAll(".js-modal-trigger") || []).forEach(($trigger) => {
    const modal = $trigger.dataset.target;
    const $target = document.getElementById(modal);

    $trigger.addEventListener("click", () => {
      openModal($target);
    });
  });

  (
    document.querySelectorAll(
      ".modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button, .cancel"
    ) || []
  ).forEach(($close) => {
    const $target = $close.closest(".modal");

    $close.addEventListener("click", () => {
      closeModal($target);
    });
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeAllModals();
    }
  });
});

fieldTypeForm.addEventListener("submit", function (event) {
  event.preventDefault();

  const formData = new FormData(this);

  fetch("../controllers/processFieldTypeForm.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "success") {
        window.location.href = "add-edit-field.php";
      } else {
        document.querySelector(".message-2").style.display = "block";
        document.querySelector(".message-body-2").innerHTML = data;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      document.querySelector(".message").style.display = "block";
      document.querySelector(".message-body").innerHTML =
        "Error en la solicitud.";
    });
});

document
  .querySelector(".js-modal-trigger")
  .addEventListener("click", function (event) {
    fetch(
      `../controllers/listFieldsTypeTable.php?`
    )
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("fieldsTypeTableBody").innerHTML ?
        document.getElementById("fieldsTypeTableBody").innerHTML = data :
        document.getElementById("fieldsTypeTableBody").innerHTML = '' ;
      })
      .catch((error) => console.error("Error:", error));
  });



  function deleteFieldType(fieldTypeId) {
    if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
        fetch("../controllers/deleteFieldType.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `id=${fieldTypeId}`,
            })
            .then((response) => response.text())
            .then((result) => {
                if (result === "success") {
                    document.getElementById(`type-row-${fieldTypeId}`).remove();
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
