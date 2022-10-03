<?php 
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <title>Admin Token</title>
  </head>
  <body>
<?php 

if(!isset($_SESSION['logged_in'])){

$hash = "$2y$12$5Sla0kX4NSQHwJKdWhhC1.bGRcK55pcZ2CI8nS3waNvdV/.V3oBTK";

if (password_verify($_POST['password'], $hash)) {   
  $_SESSION['logged_in'] = true;
  header('Location: /');
}

?>
      <div class="vh-100 row justify-content-center align-items-center">
        <div class="col-auto">
          <h2>Ingresa la contraseña</h2>
          <form name="form" method="post" action="">
          <input type="password" name="password" class="form-control" id="password"><input type="checkbox" onclick="showPass()">Mostrar Password<br><br>
          <input type="submit" value="Ingresar" class="btn btn-primary"></form>
        </div>
      </div>
      <script>
      function showPass () {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
      </script>
<?php 
}else{  
?>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">Administrador</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#Usu">Usuarios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#habTok">Habilitar Token</a>
              </li>
              <!-- <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li> -->
            </ul>
            <form class="d-flex" action='exit.php'>
              <!-- <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              /> -->
              <button class="btn btn-outline-success" type="submit">
                Salir
              </button>
            </form>
          </div>
        </div>
      </nav>

      <div class="container mt-5">
        <h1>Solicitudes</h1>
        <table id="theTable" class="display" style="width: 100%">
          <thead>
              <tr>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Registro KYC</th>
                  <th>Wallet</th>
                  <th style="display: none">Id</th>
                  <th style="display: none">Financiero</th>
                  <th style="display: none">Personal</th>
                  <th style="display: none">Url Imagen</th>
              </tr>
          </thead>
          <tbody id="contenido">      
          </tbody>
        </table>
        <br>
        <br>
        <h1 id="Usu">Usuarios</h1>
        <table id="theTableUsers" class="display" style="width: 100%">
          <thead>
              <tr>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Wallet</th>
                  <th style="display: none">Id</th>
                  <th style="display: none">Financiero</th>
                  <th style="display: none">Personal</th>
                  <th style="display: none">Url Imagen</th>
              </tr>
          </thead>
          <tbody id="contenidoUsers">      
          </tbody>
        </table>
        <br>
        <br>
        <br>
        <h1 id="habTok">Habilitar Token</h1>
        <form>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Direccion del Token</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Nombre del Token</label>
            <input type="text" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Valor en Euros</label>
            <input type="text" class="form-control" id="exampleInputPassword2">
          </div>
          <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div> -->
          <button type="submit" class="btn btn-primary">Habilitar</button>
        </form>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
      </div>
      <!-- Footer -->
      <footer class="text-center text-lg-start bg-light text-muted">
        <!-- Section: Social media -->
        <section
          class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
        >
          <!-- Left -->
          <div class="me-5 d-none d-lg-block">
            <span>Espacio para agregar lo que quieras en el Footer</span>
          </div>
          <!-- Left -->

          <!-- Right -->
          <!-- <div>
            <a href="" class="me-4 text-reset">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="me-4 text-reset">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="me-4 text-reset">
              <i class="fab fa-google"></i>
            </a>
            <a href="" class="me-4 text-reset">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="me-4 text-reset">
              <i class="fab fa-linkedin"></i>
            </a>
            <a href="" class="me-4 text-reset">
              <i class="fab fa-github"></i>
            </a>
          </div> -->
          <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
          © 2021 Copyright:
          <a class="text-reset fw-bold" href="#">Creditos Cardona</a><br>
          Design by: BRYAN GONZALEZ OROSTEGUI
        </div>
        <!-- Copyright -->
      </footer>
      <!-- Footer -->

      <!-- Modal -->
      <div class="modal fade" id="modalData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Datos Solicitante</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label fw-bold">Nombres:</label>
                <label class="form-label" id="name"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Apellidos:</label>
                <label class="form-label" id="lastname"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Fecha de nacimiento:</label>
                <label class="form-label" id="birthday"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Dirección:</label>
                <label class="form-label" id="address"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Indicativo:</label>
                <label class="form-label" id="ind"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Celular:</label>
                <label class="form-label" id="phone"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Ciudad</label>
                <label class="form-label" id="city"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Region:</label>
                <label class="form-label" id="region"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Codigo postal:</label>
                <label class="form-label" id="zip"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Nacionalidad:</label>
                <label class="form-label" id="cityzenship"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">1. ¿Has invertido en empresas no cotizadas gestionadas por tí o por
                otros?</label>
                <label class="form-label" id="primera"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">2. ¿Conoces lo que es un security token y los riesgos que en la
                invesión en los mismos conlleva?</label>
                <label class="form-label" id="segunda"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">3. ¿Sabes que invirtiendo en empresas no cotizadas puedes perder hasta
                el 100% de tu inversión?</label>
                <label class="form-label" id="tercera"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">4. ¿Qué porcentaje de tu patrimonio quieres invertir en este tipo de
                productos?</label>
                <label class="form-label" id="cuarta"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">5. ¿Cuál es el origen de la mayor parte de tus ingresos períodicos?</label>
                <label class="form-label" id="quinta"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">6. ¿Cuál es el origen del capital que quieres invertir o reinvertir en
                este tipo de productos?</label>
                <label class="form-label" id="sexta"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">7. ¿Cuál es el horizonte temporal de tu inversión?</label>
                <label class="form-label" id="septima"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">8. ¿Qué fluctuaciones de tu inversion estas dispuesto a asumir?</label>
                <label class="form-label" id="octava"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">9. ¿Qué objetos persigues al realizar la inversión?</label>
                <label class="form-label" id="novena"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">10. Nivel de estudios:</label>
                <label class="form-label" id="decima"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Profesión:</label>
                <label class="form-label" id="once"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Ingresos anuales:</label>
                <label class="form-label" id="doce"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">DNI Anverso:</label><br>
                <img src="" id="imgCedula" alt="Anverso DNI" width="250" />
                <!-- <label class="form-label" id="doce"></label> -->
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">DNI Reverso:</label><br>
                <img src="" id="imgCedulaR" alt="Reverso DNI" width="250" />
                <!-- <label class="form-label" id="doce"></label> -->
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Selfie:</label><br>
                <img src="" id="imgSelfie" alt="Selfie" width="250" />
                <!-- <label class="form-label" id="doce"></label> -->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="trueWallet">Aprobar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Users -->
      <div class="modal fade" id="modalDataUsers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Datos Solicitante</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label fw-bold">Nombres:</label>
                <label class="form-label" id="nameUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Apellidos:</label>
                <label class="form-label" id="lastnameUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Fecha de nacimiento:</label>
                <label class="form-label" id="birthdayUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Dirección:</label>
                <label class="form-label" id="addressUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Indicativo:</label>
                <label class="form-label" id="indUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Celular:</label>
                <label class="form-label" id="phoneUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Ciudad</label>
                <label class="form-label" id="cityUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Region:</label>
                <label class="form-label" id="regionUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Codigo postal:</label>
                <label class="form-label" id="zipUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Nacionalidad:</label>
                <label class="form-label" id="cityzenshipUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">1. ¿Has invertido en empresas no cotizadas gestionadas por tí o por
                otros?</label>
                <label class="form-label" id="primeraUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">2. ¿Conoces lo que es un security token y los riesgos que en la
                invesión en los mismos conlleva?</label>
                <label class="form-label" id="segundaUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">3. ¿Sabes que invirtiendo en empresas no cotizadas puedes perder hasta
                el 100% de tu inversión?</label>
                <label class="form-label" id="terceraUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">4. ¿Qué porcentaje de tu patrimonio quieres invertir en este tipo de
                productos?</label>
                <label class="form-label" id="cuartaUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">5. ¿Cuál es el origen de la mayor parte de tus ingresos períodicos?</label>
                <label class="form-label" id="quintaUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">6. ¿Cuál es el origen del capital que quieres invertir o reinvertir en
                este tipo de productos?</label>
                <label class="form-label" id="sextaUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">7. ¿Cuál es el horizonte temporal de tu inversión?</label>
                <label class="form-label" id="septimaUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">8. ¿Qué fluctuaciones de tu inversion estas dispuesto a asumir?</label>
                <label class="form-label" id="octavaUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">9. ¿Qué objetos persigues al realizar la inversión?</label>
                <label class="form-label" id="novenaUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">10. Nivel de estudios:</label>
                <label class="form-label" id="decimaUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Profesión:</label>
                <label class="form-label" id="onceUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Ingresos anuales:</label>
                <label class="form-label" id="doceUsers"></label>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">DNI Anverso:</label><br>
                <img src="" id="imgCedulaUsers" alt="Anverso DNI" width="250" />
                <!-- <label class="form-label" id="doce"></label> -->
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">DNI Reverso:</label><br>
                <img src="" id="imgCedulaRUsers" alt="Reverso DNI" width="250" />
                <!-- <label class="form-label" id="doce"></label> -->
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Selfie:</label><br>
                <img src="" id="imgSelfieUsers" alt="Selfie" width="250" />
                <!-- <label class="form-label" id="doce"></label> -->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
      <script src="./main.js"></script>

      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"
      ></script>

      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      -->
  </body>
</html>
<?php 
} 
?>