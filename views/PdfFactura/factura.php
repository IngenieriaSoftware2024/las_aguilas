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

<div class="factura-info">
    <p><strong>Factura No.:</strong> <?php echo $data['factura_correlativo'] ?></p>
    <p><strong>Fecha de emisión:</strong> <?php echo date('d/m/Y') ?></p>
</div>

<div class="detalles-cliente">
    <table>
        <tr>
            <td><strong>Cliente:</strong></td>
            <td><?php echo $data['cliente_nombre'] ?></td>
        </tr>
        <tr>
            <td><strong>NIT:</strong></td>
            <td><?php echo $data['cliente_nit'] ?></td>
        </tr>
    </table>
</div>

<div class="contenido">
    <table class="tabla-detalles">
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $data['detalle_cantidad_empleados'] ?></td>
                <td><?php echo $data['detalle_empleados'] ?></td>
                <td>Q<?php echo number_format($data['detalle_total'] / $data['detalle_cantidad_empleados'], 2) ?></td>
                <td>Q<?php echo number_format($data['detalle_total'], 2) ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="totales">
    <p><strong>Total a Pagar:</strong> Q<?php echo number_format($data['detalle_total'], 2) ?></p>
</div>

<div class="pie">
    <p>Gracias por confiar en nuestros servicios.</p>
    <p>Las Águilas S.A - Seguridad y Vigilancia Privada</p>
</div>
