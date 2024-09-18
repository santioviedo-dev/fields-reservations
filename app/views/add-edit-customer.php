<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: index.php?view=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Reserva</title>
    <link rel="stylesheet" href="../../node_modules\bulma\css\versions\bulma-no-dark-mode.css">
</head>

<body>
    <?php include __DIR__ . '/../components/nav.php'; ?>

    <?php
    if (isset($_GET['id'])) $id = $_GET['id'];
    else $id = '';

    require_once __DIR__ . '/../helpers/getters.php';

    $customer = getCustomer($id);
    ?>

    <main class="container is-max-tablet" style="margin-top: 50px;">
        <form id="customer_form" style="max-width: 400px; margin: auto;">
            <h2 class="title is-4">Ingrese los datos del Cliente</h2>
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="field">
                <label class="label">Nombre</label>
                <div class="control">
                    <input type="text" class="input" name="customer_name" value="<?= $customer['customer_name'] ?>">
                </div>
            </div>
            <div class="field">
                <label class="label">Teléfono</label>
                <div class="control">
                    <input type="text" class="input" name="customer_tel" value="<?= $customer['customer_tel'] ?>">
                </div>
            </div>

            <article class="message is-danger" style="display: none;">
                <div class="message-body">
                </div>
            </article>

            <div class="field is-flex" style="width: 300px; max-width: 100%; margin: auto; gap: 1rem">
                <div class="control is-flex-grow-2">
                    <input type="submit" value="Guardar" class="button is-link is-fullwidth">
                </div>
                <div class="control is-flex-grow-1">
                    <a href="../../index.php?view=clients" class="button is-link is-danger is-fullwidth">Cancelar</a>
                </div>
            </div>
        </form>
    </main>
    <script src="../../public/js/add-edit-customer.js">
    </script>
</body>

</html>