
<?php
use Model\Cliente;
$cliente = new Cliente($_GET);
$clientes = $cliente->buscar();
?>

<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-hover w-100" id="tablaPuestos">
        </table>
    </div>
</div>
<script src="<?= asset('./build/js/puesto/lista.js') ?>"></script>