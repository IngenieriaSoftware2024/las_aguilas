<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="build/js/app.js"></script>
    <link rel="shortcut icon" href="<?= asset('images/AguilaLogo.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('build/styles.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>- Las Aguilas S.A. -</title>
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --background-gradient: linear-gradient(135deg, #6e7f80 0%, #a8c0ff 100%);
            --form-bg-color: #ffffff;
            --input-bg-color: #f8f9fa;
            --border-radius: 10px;
            --box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            --button-radius: 8px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-gradient);
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Centrar contenido */
        .container-fluid {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: var(--form-bg-color);
            border-radius: var(--border-radius);
            padding: 40px;
            box-shadow: var(--box-shadow);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-container img {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        .form-control {
            background-color: var(--input-bg-color);
            border-radius: var(--button-radius);
            border: 1px solid var(--secondary-color);
            padding: 12px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: var(--button-radius);
            padding: 12px;
            font-weight: 600;
        }

        .login-heading {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .welcome-message {
            color: var(--secondary-color);
            margin-bottom: 10px;
            font-size: 16px;
        }

        /* Footer fijo */
        footer {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        .logo-image {
            display: block;
            margin: 0 auto 20px;
            width: 120px;
            /* Ajusta según sea necesario */
            height: 120px;
            /* Ajusta según sea necesario */
            object-fit: cover;
            /* Asegura que la imagen mantenga su proporción */
            border-radius: 50%;
            /* Mantiene el efecto de círculo */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="progress fixed-bottom" style="height: 6px;">
        <div class="progress-bar progress-bar-animated bg-danger" id="bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <!-- Contenido -->
    <div class="container-fluid">
        <?php echo $contenido; ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; Las Águilas. Todos los derechos reservados. <?= date('Y') ?> </p>
    </footer>
</body>

</html>