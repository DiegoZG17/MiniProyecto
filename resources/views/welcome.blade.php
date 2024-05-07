<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
        <form action="{{route('alta2')}}" method="POST" enctype="application/x-www-form-urlencoded">
  @csrf
    
    <h1>Crear cuenta</h1>
    <div class="social-icons">
        <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
        <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
        <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
    </div>
    <span>or use your email for registeration</span>
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="apellido_paterno" placeholder="Apellido Paterno" required>
    <input type="text" name="apellido_materno" placeholder="Apellido Materno" required>
    <select name="genero" required>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
    </select>
    <input type="email" name="correo" placeholder="Email" required>
    <input type="password" name="clave" placeholder="Password" required>
    <button type="submit">Sign Up</button>
</form>

        </div>
        <div class="form-container sign-in">
         <form action="validar" method="post">
         @csrf
            <form>
                <h1>Iniciar Sesion</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" placeholder="Email" name="nombre">
                <input type="password" placeholder="Password" name="clave">
                <a href="#">Forget Your Password?</a>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenido de nuevo</h1>
                    <p>Ingrese sus datos personales para utilizar todas las funciones del sitio</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hola, Bienvenido!</h1>
                    <p>Regístrese con sus datos personales para utilizar todas las funciones del sitio</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/script.js')}}"></script>
</body>

</html>