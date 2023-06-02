$(document).ready(function() {
  updateLoginContent();
    var panelOne = $('.form-panel.two').height(),
      panelTwo = $('.form-panel.two')[0].scrollHeight;
  
    $('.form-panel.two').not('.form-panel.two.active').on('click', function(e) {
      e.preventDefault();
      $('.form-toggle').addClass('visible');
      $('.form-panel.one').addClass('hidden');
      $('.form-panel.two').addClass('active');
      $('.form').animate({
        'height': panelTwo
      }, 200);
    });
  
    $('.form-toggle').on('click', function(e) {
      e.preventDefault();
      $(this).removeClass('visible');
      $('.form-panel.one').removeClass('hidden');
      $('.form-panel.two').removeClass('active');
      $('.form').animate({
        'height': panelOne
      }, 200);
      // Remueve la clase o cambia el estado del botón
      $('.form-panel.two .btn').removeClass('active');
    });
  
    
    

    // Función para procesar el registro
  function register() {
    var username = $('#username2').val();
    var password = $('#password2').val();
    var cpassword = $('#cpassword').val();
    var email = $('#email').val();

    // Realizar la solicitud AJAX para registrar
    $.ajax({
      url: 'register.php',
      method: 'POST',
      data: {
        username: username,
        password: password,
        cpassword: cpassword,
        email: email
      },
      success: function(response) {
        // Manejar la respuesta del servidor
        alert(response); // Mostrar la respuesta del servidor en un alert
        // Vaciar los valores de los campos del formulario
        $('#username2').val("");
        $('#password2').val("");
        $('#cpassword').val("");
        $('#email').val("");
        location.reload();
        
        
      },
      error: function() {
        alert('Error en la solicitud AJAX');
      }
    });
  }

  // Función para procesar el inicio de sesión
  function login() {
    var username = $('#username').val();
    var password = $('#password').val();

    // Realizar la solicitud AJAX para iniciar sesión
    $.ajax({
      url: 'loginUser.php',
      method: 'POST',
      data: {
        username: username,
        password: password
      },
      success: function(response) {
        // Manejar la respuesta del servidor
        alert(response); // Mostrar la respuesta del servidor en un alert
        // Almacenar el estado de inicio de sesión en la sesión de usuario
        sessionStorage.setItem('loggedIn', 'true');

        // Actualizar el contenido del div generalLogin
        updateLoginContent();
      },
      error: function() {
        alert('Error en la solicitud AJAX');
      }
    });
  }

  // Agregar el evento de clic al botón de registro
  $('#seg').on('click', function(e) {
    e.preventDefault();
    register(); // Llamar a la función de registro al hacer clic en el botón
  });

  // Agregar el evento de clic al botón de inicio de sesión
  $('[type=submit]').not('#seg').on('click', function(e) {
    e.preventDefault();
    login(); // Llamar a la función de inicio de sesión al hacer clic en el botón
  });
    
  // Función para cerrar la sesión
function logout() {
  // Realizar la solicitud AJAX para cerrar sesión
  $.ajax({
    url: 'logout.php',
    method: 'POST',
    success: function() {
      // Eliminar el estado de inicio de sesión de la sesión de usuario
      sessionStorage.removeItem('loggedIn');

      // Actualizar el contenido del div generalLogin
      updateLoginContent();
      location.reload();
    },
    error: function() {
      alert('Error en la solicitud AJAX para cerrar sesión');
    }
  });
}

// Función para actualizar el contenido del div generalLogin
function updateLoginContent() {
  var isLoggedIn = sessionStorage.getItem('loggedIn');

  if (isLoggedIn === 'true') {
    // Usuario logueado
    $("#generalLogin")
      .empty()
      .append('<button id="misReservasBtn" class="btn botonS mx-2">Mis reservas</button>' +
        '<button id="cerrarSesionBtn" class="btn botonS mx-2">Cerrar sesión</button>');

    // Asignar eventos a los botones
    $("#misReservasBtn").click(function() {
      console.log("Se hizo clic en el botón Mis reservas");
    });

    $("#cerrarSesionBtn").click(function() {
      logout();
    });
  } else {
    // Usuario no logueado
    var loginContent = `
      
        <div class="form" id="log">
          <div class="form-toggle"></div>
          <div class="form-panel one">
            <div class="form-header">
              <h1 class="text-center">Inicia Sesión</h1>
            </div>
            <div class="form-content">
              <form>
                <div class="form-group">
                  <label for="username">Nombre de Usuario</label>
                  <input type="text" id="username" name="username" required="required" />
                </div>
                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input type="password" id="password" name="password" required="required" />
                </div>
                <div class="form-group">
                  <label class="form-remember" for="checkbox">Recuérdame <input type="checkbox" class="checkbox" id="checkbox" /></label>
                  <a class="form-recovery" href="#">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn">Iniciar sesión</button>
                </div>
              </form>
            </div>
          </div>
          <div class="form-panel two">
            <div class="form-header">
              <h1 class="text-center">Registrarse</h1>
            </div>
            <div class="form-content">
              <form>
                <div class="form-group">
                  <label for="username2">Nombre de usuario</label>
                  <input type="text" id="username2" name="username" required="required" />
                </div>
                <div class="form-group">
                  <label for="password2">Contraseña</label>
                  <input type="password" id="password2" name="password" required="required" />
                </div>
                <div class="form-group">
                  <label for="cpassword">Confirmar contraseña</label>
                  <input type="password" id="cpassword" name="cpassword" required="required" />
                </div>
                <div class="form-group">
                  <label for="email">Correo electrónico</label>
                  <input type="email" id="email" name="email" required="required" />
                </div>
                <div class="form-group">
                  <button type="submit" id="seg" class="btn">Registrarse</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      
    `;
    $("#generalLogin").html(loginContent);
  }
}

});
