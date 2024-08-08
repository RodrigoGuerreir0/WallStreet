<?php
session_start();
if (!isset($_SESSION['Usuario'])) {
?>

    <!-- Caso a pessoa nao tiver loogado em nenhum usuario, so ira aparecer o qie estiver dentro desse if acima -->


    <h2>Você ainda não esta logado faça seu login</h2>
    <a href="./login.php">Login</a>
<?php
    //    header("Location: ./login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/home.css">
    <title>Bem-vindo</title>
    <script src="../javascript/mobilehome.js"></script>
</head>


<header>
      <nav>
       <!-- <img src="../img/logo.png" alt="" width="7%"   >  -->
        <a class="logo" href="/">Bem vindo a WallStreet <font class="color"><?php  echo $_SESSION['Usuario']; ?></font>!</a>

        <div class="mobile-menu">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
        
        <ul class="nav-list">
          <li><a class="li_A" href="#"><b>Início</b></a></li>
          <li><a class="li_A" href="#"><b>Sobre</b></a></li>
          <li><a class="li_A" href="#"><b>Projetos</b></a></li>
          <li><a class="li_A" href="#"><b>Contato</b></a></li>
        </ul>

      </nav>
    </header>
    <main>
        <center>
        
          
        

        </center>


        

        

        </main>
        <div id="map"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSr8SFxD03BRdriVAXeemLLaB1iop7Tmk&callback=initMap" async defer></script>
<script>
    function initMap() {

        const sensors = [
            { lat: -22.7570025, lng: -47.3839586 },
            { lat: -22.7580828, lng: -47.3831891 },
            { lat: -22.7578661, lng: -47.3844843 }
        ];

        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: sensors[0],
            mapTypeId: 'roadmap',
        });

        sensors.forEach((sensor, index) => {
            addSensor(map, sensor);
        });
    }

    function addSensor(map, location) {
        const marker = new google.maps.Marker({
            position: location,
            map: map,
            title: 'Vaga',
            icon: {
                url: 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%23ff0000" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E',
                scaledSize: new google.maps.Size(20, 20),
            },
        });

        setInterval(() => {
            const isMoving = Math.random() > 0.5;
            const iconUrl = isMoving 
                ? 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%23ff0000" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E'
                : 'data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"%3E%3Ccircle cx="12" cy="12" r="10" fill="%2300ff00" stroke="%23ffffff" stroke-width="2" /%3E%3C/svg%3E';
            marker.setIcon({
                url: iconUrl,
                scaledSize: new google.maps.Size(20, 20),
            });
        }, 1000); 
    }
</script>





        <footer>




        
        <div class="container-footer">
            <div class="row-footer">
                <!-- footer col-->
                <div class="footer-col">
                    <h4>WallStreet</h4>
                    <ul>
                        <li><a href="#"> Quem somos </a></li>
                        <li><a href=""> nossos serviços </a></li>
                        <li><a href=""> política de privacidade </a></li>
                        
                    </ul>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Contato</h4>
                    <ul>
                        <li><a href="#">(19) 99256-1004</a></li>
                        <li><a href="#">(19) 97138-8368</a></li>
                        <li><a href="#">(19) 99272-9339</a></li>
                       
                       
                    </ul>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                    <h4>Loja online</h4>
                    <ul>
                        <li><a href="#">Relógio</a></li>
                        <li><a href="#">Saco</a></li>
                        <li><a href="#">Calçado</a></li>
                        <li><a href="#">Endereço</a></li>
                    </ul>
                </div>
                <!--end footer col-->
                <!-- footer col-->
                <div class="footer-col">
                 
                   

                    <div class="medias-socias">
                        <a href="#"> <i class="fa fa-facebook"></i> </a>
                        <a href="#"> <i class="fa fa-instagram"></i> </a>
                        <a href="#"> <i class="fa fa-twitter"></i> </a>
                        <a href="#"> <i class="fa fa-linkedin"></i> </a>
                    </div>

                </div>
                <!--end footer col-->
            </div>
        </div>
    </footer>


</html>