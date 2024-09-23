<div class="row login-container text-center">
    <h1 class="login-heading">Iniciar sesión</h1>
    <p class="welcome-message">Bienvenido a Las Águilas, por favor ingresa tus credenciales</p>
    
    <img src="<?= asset('./images/AguilaLogo.png') ?>"  alt="Logo" class="img-fluid rounded-circle logo-image">
    
    <form>
        <div class="mb-3">
            <label for="usu_catalogo" class="form-label">Catálogo del usuario</label>
            <input type="number" name="usu_catalogo" id="usu_catalogo" class="form-control" placeholder="Ingresa tu catálogo">
        </div>
        <div class="mb-4">
            <label for="usu_password" class="form-label">Contraseña</label>
            <input type="password" name="usu_password" id="usu_password" class="form-control" placeholder="Ingresa tu contraseña" autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary w-100 btn-lg">Iniciar sesión</button>
    </form>
</div>
<script src="<?= asset('./build/js/login/login.js') ?>"></script>

