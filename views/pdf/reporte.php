<div class="encabezado">
    <div style="float: left;">
        <img src="./images/AguilaLogo.png" alt="Logo Las Águilas" class="logo">
    </div>
    <div class="empresa-info">
        <h1>Las Águilas S.A</h1>
        <p>Seguridad y Vigilancia Privada</p>
        <p>Dirección: 32 Calle 27-1 zona 5, Guatemala</p>
        <p>Teléfono: +502 1234 5678 | Email: aguilas@lasaguilas.com</p>
    </div>
</div>

<table class="tabla-detalles">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nombre del Empleado</th>
            <th>Puesto Asignado</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultado as $key => $turnos): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $turnos['emp_nombre'] ?></td>
                <td><?= $turnos['puesto_nombre'] ?></td>
                <td><?= $turnos['turno_fecha_inicio'] ?></td>
                <td><?= $turnos['turno_fecha_fin'] ?></td>
            </tr>
        <?php endforeach ?>    
    </tbody>
</table>

<script>
    console.log(turnos)
</script>

<div class="pie">
    <p>Gracias por confiar en nuestros servicios.</p>
    <p>Las Águilas S.A - Seguridad y Vigilancia Privada</p>
</div>
