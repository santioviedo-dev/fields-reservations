<div class="container" style="margin-top: 50px; display: grid; place-content:center;">
    <div class="columns">
        <div class="column">
            <a href="app/views/add-edit-field.php" class="button is-primary add-button">
                Agregar Cancha
            </a>
        </div>
        <div class="field has-addons column">
            <div class="control">
                <input class="input" id="filterInfo" type="text" placeholder="Buscar por tipo">
            </div>
            <div class="control">
                <button class="button is-info" id="searchButton">Buscar</button>
            </div>
        </div>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <td>Id - Número</td>
                    <td>Tipo</td>
                    <td colspan="2"></td>
                </tr>
            </thead>
            <tbody id="fieldsTableBody">
            </tbody>
        </table>
    </div>
</div>
<script>
    document.getElementById("searchButton").addEventListener("click", function(event) {
        const filterInfo = document.getElementById('filterInfo').value;
        fetch(
                `app/controllers/listFields.php?filter_info=${encodeURIComponent(
      filterInfo
    )}`
            )
            .then((response) => response.text())
            .then((data) => {
                document.getElementById("fieldsTableBody").innerHTML = data;
            })
            .catch((error) => console.error("Error:", error));
    });


    window.onload = function() {
        document.getElementById("searchButton").dispatchEvent(new Event("click"));
    };

    document.getElementById('filterInfo').addEventListener("keydown", function() {

    });

    function deleteField(fieldId) {
        if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
            fetch("app/controllers/deleteField.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `id=${fieldId}`,
                })
                .then((response) => response.text())
                .then((result) => {
                    if (result === "success") {
                        document.getElementById(`row-${fieldId}`).remove();
                    } else {
                        alert("Error al eliminar el registro. Probablemente esté relacionado con algún registro de reservas.");
                    }
                })
                .catch((error) => {
                    alert("Error en la solicitud Fetch");
                    console.error("Error:", error);
                });
        }
    }
</script>