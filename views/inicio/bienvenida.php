<div class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content text-center">
        <h1 class="hero-title">Bienvenidos a Las Águilas</h1>
        <p class="hero-subtitle">Soluciones Integrales de Seguridad y Vigilancia</p>
        <a href="/contacto" class="btn btn-primary hero-button">Contáctanos</a>
    </div>
</div>

<div class="about-section container mt-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h3 class="about-title">Seguridad Profesional</h3>
            <p class="about-text">Somos una empresa líder en el sector de seguridad privada con más de 10 años de experiencia, brindando protección personalizada para empresas y hogares.</p>
            <ul class="about-list">
                <li>Guardias certificados y entrenados</li>
                <li>Monitoreo constante las 24 horas</li>
                <li>Sistemas avanzados de videovigilancia</li>
            </ul>
            <a href="/sobre-nosotros" class="btn btn-secondary mt-3">Saber más</a>
        </div>
        <div class="col-md-6">
            <img src="./images/seguridad_privada.png" alt="Equipo de seguridad" class="img-fluid rounded shadow-lg">
        </div>
    </div>
</div>

<div class="services-section container mt-5">
    <div class="text-center mb-4">
        <h2 class="section-title">Nuestros Servicios</h2>
        <p class="section-subtitle">Descubre nuestras soluciones de seguridad adaptadas a tus necesidades.</p>
    </div>
    <div class="row text-center">
        <div class="col-md-4">
            <div class="service-card">
                <img src="./images/Escolta.png" alt="Seguridad Personal" class="service-image">
                <h4 class="service-title mt-3">Seguridad Personal</h4>
                <p class="service-description">Protección integral para individuos y familias, 24/7.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <img src="./images/seguridad_empresarial.jpg" alt="Vigilancia" class="service-image">
                <h4 class="service-title mt-3">Vigilancia Empresarial</h4>
                <p class="service-description">Monitoreo y protección para instalaciones empresariales.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <img src="./images/video_vigilancia.jpg" alt="Sistemas de Vigilancia" class="service-image">
                <h4 class="service-title mt-3">Sistemas de Vigilancia</h4>
                <p class="service-description">Instalación de cámaras y sistemas de monitoreo avanzados.</p>
            </div>
        </div>
    </div>
</div>


<script src="<?= asset('/build/js/inicio.js') ?>"></script>

<style>
    .hero-section {
        background-image: url('./images/seguridad.webp');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        /* Fija la imagen al fondo */
        min-height: 100vh;
        /* Asegura que cubra al menos la altura de la ventana */
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        /* Superposición semitransparente para resaltar el texto */
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        /* Para asegurarse de que el contenido esté sobre la superposición */
    }

    .hero-title {
        font-size: 4rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #fff;
        /* Asegura que el texto sea visible sobre el fondo */
    }

    .hero-subtitle {
        font-size: 1.5rem;
        margin-bottom: 30px;
        color: #fff;
    }

    .hero-button {
        font-size: 1.2rem;
        padding: 12px 35px;
        border-radius: 30px;
        background-color: #007bff;
        /* Color del botón */
        color: white;
        /* Color del texto del botón */
        text-decoration: none;
        border: none;
        transition: background-color 0.3s ease;
    }

    .hero-button:hover {
        background-color: #0056b3;
        /* Efecto hover para el botón */
    }


    /* About Section */
    .about-title {
        font-size: 2.5rem;
        font-weight: 600;
        color: #333;
    }

    .about-text {
        font-size: 1.2rem;
        color: #555;
        margin-bottom: 20px;
    }

    .about-list {
        list-style-type: none;
        padding-left: 0;
    }

    .about-list li {
        font-size: 1.1rem;
        margin-bottom: 10px;
        padding-left: 20px;
        position: relative;
    }

    .about-list li::before {
        content: "\f058";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        color: #007bff;
        position: absolute;
        left: 0;
    }

    /* Services Section */
    .services-section .section-title {
        font-size: 2.5rem;
        font-weight: bold;
    }

    .services-section .section-subtitle {
        font-size: 1.2rem;
        color: #555;
    }

    .service-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .service-image {
        width: 100%;
        border-radius: 10px;
        height: 200px;
        object-fit: cover;
    }

    .service-title {
        font-size: 1.5rem;
        margin-top: 15px;
        color: #333;
    }

    .service-description {
        font-size: 1rem;
        color: #555;
    }

    /* Footer */
    .footer-section {
        background-color: #343a40;
        color: white;
    }

    body {
        font-family: 'Roboto', sans-serif;
        color: #333;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Cinzel', serif;
    }
</style>