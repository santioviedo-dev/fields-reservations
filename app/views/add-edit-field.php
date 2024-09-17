
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

    $field = getField($id);
    ?>

    <main class="container is-max-tablet" style="margin-top: 50px;">
        <form id="field_form" style="max-width: 400px; margin: auto;">
            <h2 class="title is-4">Ingrese los datos de la cancha</h2>
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="columns">
                <div class="field column">
                    <div class="control">
                        <div class="select">
                            <select name="field_type" required>
                                <option value="" <?= $field['FieldType_id'] == '' ? 'selected' : '' ?> disabled> Seleccionar tipo de cancha</option>
                                <?php
                                require_once __DIR__ . '/../controllers/listFieldsType.php';
                                foreach ($fieldsTypeList as $fieldType) {
                                    $isSelected = $field['FieldType_id'] == $fieldType['FieldType_id'] ? 'selected' : '';
                                    echo '<option value="' . $fieldType['FieldType_id'] . '"' . $isSelected . '>' . $fieldType['FieldType_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <a class="button is-primary add-button js-modal-trigger" data-target="modal-js-example">
                        Agregar tipo de cancha
                    </a>
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
                    <a href="../../index.php?view=fields" class="button is-link is-danger is-fullwidth">Cancelar</a>
                </div>
            </div>
        </form>
        <div id="modal-js-example" class="modal">
            <div class="modal-background"></div>

            <div class="modal-content">
                <div class="box">
                    <form id="fieldType_form">
                        <div class="field">
                            <label class="label">Ingrese el tipo de cancha</label>
                            <div class="control">
                                <input type="text" class="input" name="FieldType_name">
                            </div>
                        </div>
                        <div class="field is-flex" style="width: 300px; max-width: 100%; margin: auto; gap: 1rem">
                            <div class="control is-flex-grow-2">
                                <input type="submit" value="Guardar" class="button is-link is-fullwidth">
                            </div>
                            <div class="control is-flex-grow-1">
                                <a class="cancel button is-link is-danger is-fullwidth">Cancelar</a>
                            </div>
                        </div>
                        <article class="message-2 is-danger" style="display: none;">
                            <div class="message-body-2">
                            </div>
                        </article>
                    </form>
                    <table class="table container">
                        <thead>
                            <tr>
                                <td>Id - Número</td>
                                <td>Nombre del tipo</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody id="fieldsTypeTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <button class="modal-close is-large" aria-label="close"></button>
        </div>
    </main>
    <script src="../../public/js/add-edit-field.js">
    </script>
</body>

</html>