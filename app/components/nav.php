<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item has-background-primary" href="/reserva-de-turnos/index.php">
            <h1 class="title is-4 has-text-black">Sistema de Reservas</h1>

        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            
            <div class="navbar-item has-dropdown is-hoverable">
                <a href="/reserva-de-turnos/index.php" class="navbar-link">
                    Reservas
                </a>

                <div class="navbar-dropdown">
                    <a href="/reserva-de-turnos/app/views/add-edit-reservation.php" class="navbar-item">
                        Nueva
                    </a>
                </div>
            </div>
            <a href="/reserva-de-turnos/index.php?view=clients" class="navbar-item">
                Clientes
            </a>

            <a href="/reserva-de-turnos/index.php?view=fields" class="navbar-item">
                Canchas
            </a>

                
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a href="/reserva-de-turnos/app/controllers/logout.php" class="button is-secundary">
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>