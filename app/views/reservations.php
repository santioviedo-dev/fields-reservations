
<div class="container" style="margin-top: 50px; display: grid; place-content:center;">
    <div class="columns">
        <div class="column">
            <a href="app/views/add-edit-reservation.php" class="button is-primary add-button">
                Agregar Reserva
            </a>
        </div>
        <div class="field column">
            <div class="control">
                <input type="date" id="filterDate" class="input" style="max-width: fit-content;">
            </div>
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

    <table class="table">
        <thead>
            <tr>
                <td>Fecha</td>
                <td>Cliente</td>
                <td>Hora</td>
                <td>Duración</td>
                <td>Cancha</td>
                <td>Pagado</td>
                <td colspan="2"></td>
            </tr>
        </thead>
        <tbody id="reservationsTableBody">
        </tbody>
    </table>
</div>
<script>
    document.getElementById("filterDate").addEventListener("change", function(event) {
        const filterDate = event.target.value;
        const filterInfo = document.getElementById('filterInfo').value;
        fetch(
                `app/controllers/listReservations.php?filter_date=${encodeURIComponent(
      filterDate
    )}${filterInfo != '' ? '&filter_info=' + encodeURIComponent(filterInfo) : ''}`
            )
            .then((response) => response.text())
            .then((data) => {
                document.getElementById("reservationsTableBody").innerHTML = data;
            })
            .catch((error) => console.error("Error:", error));
    });

    document.getElementById("searchButton").addEventListener("click", function(event) {
        const filterInfo = document.getElementById('filterInfo').value;
        const filterDate = document.getElementById('filterDate').value;
        fetch(
                `app/controllers/listReservations.php?filter_info=${encodeURIComponent(
      filterInfo
    )}${filterDate != '' ? '&filter_date=' + encodeURIComponent(filterDate) : ''}`
            )
            .then((response) => response.text())
            .then((data) => {
                document.getElementById("reservationsTableBody").innerHTML = data;
            })
            .catch((error) => console.error("Error:", error));
    });


    window.onload = function() {
        document.getElementById("filterDate").dispatchEvent(new Event("change"));
    };
</script>