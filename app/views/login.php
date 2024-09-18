<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Reserva</title>
    <link rel="stylesheet" href="../../node_modules\bulma\css\versions\bulma-no-dark-mode.css">
</head>

<body style="display: grid; place-content:center; height: 100vh;">
    <div class="block">

        <form method="POST" id="login_form">
            <h1 class="title is-4">Ingrese los datos de usuario</h1>
            <div class="field">
                <p class="control">
                    <input class="input" name="username" type="text" placeholder="Usuario">
                </p>
            </div>
            <div class="field">
                <p class="control ">
                    <input class="input" name="password" type="password" placeholder="Contraseña">
                </p>
            </div>
            <article class="message is-danger" style="display: none;">
                <div class="message-body">
                </div>
            </article>
            <div class="field">
                <div class="control is-flex-grow-2">
                    <input type="submit" value="Iniciar Sesión" class="button is-link is-fullwidth">
                </div>
            </div>
        </form>
    </div>
    <script>
        const form = document.getElementById("login_form");

        form.addEventListener("submit", function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch("../controllers/validateUser.php", {
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
    </script>
</body>

</html>