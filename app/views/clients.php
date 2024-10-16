<div class="container" style="margin-top: 50px; display: grid; place-content:center;">
    <div class="columns">
        <div class="column">
            <a href="app/views/add-edit-customer.php" class="button is-primary add-button">
                Agregar Cliente
            </a>
        </div>
        <div class="field has-addons column">
            <div class="control">
                <input class="input" id="filterInfo" type="text" placeholder="Buscar una reserva">
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
                    <td>Nombre</td>
                    <td>Teléfono</td>
                    <td colspan="2"></td>
                </tr>
            </thead>
            <tbody id="customersTableBody">
            </tbody>
        </table>
    </div>
</div>
<script>
    document.getElementById("searchButton").addEventListener("click", function(event) {
        const filterInfo = document.getElementById('filterInfo').value;
        fetch(
                `app/controllers/listCustomers.php?filter_info=${encodeURIComponent(
      filterInfo
    )}`
            )
            .then((response) => response.text())
            .then((data) => {
                document.getElementById("customersTableBody").innerHTML = data;
            })
            .catch((error) => console.error("Error:", error));
    });


    window.onload = function() {
        document.getElementById("searchButton").dispatchEvent(new Event("click"));
    };

    function deleteCustomer(customerId) {
        if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
            fetch("app/controllers/deleteCustomer.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `id=${customerId}`,
                })
                .then((response) => response.text())
                .then((result) => {
                    if (result === "success") {
                        document.getElementById(`row-${customerId}`).remove();
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
</script>