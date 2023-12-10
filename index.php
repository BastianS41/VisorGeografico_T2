<?php
    define("PG_DB", "t2sw");
    define("PG_HOST", "localhost");
    define("PG_USER", "postgres");
    define("PG_PSWD", "p");
    define("PG_PORT", "5432");

	$conexion = pg_connect("dbname=".PG_DB." host=".PG_HOST." user=".PG_USER ." password=".PG_PSWD." port=".PG_PORT."");
  if (!$conexion) {
    echo "Error de conexión con la base de datos.";
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script> 
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.6.0/leaflet.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.EasyButton/2.4.0/easy-button.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.EasyButton/2.4.0/easy-button.css" />

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src="Locate/L.Control.Locate.js"></script>
    <link rel="stylesheet" href="Locate/L.Control.Locate.css" />


    <link rel="stylesheet" href="SlideMenu/src/L.Control.SlideMenu.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>  
    <script src="SlideMenu/src/L.Control.SlideMenu.js"></script>
    
    <title>Equipamientos Comuna 16</title>
    
        
    <style>
      *{	
      padding: 0% ;
      margin: 0% 0%;		
      }
      html, body{
      height:100% ;
      width:100% vw;
      font-family: "Noto Sans", sans-serif;
      background-image: url('img/img.jpg'); /* Reemplaza 'ruta/de/tu/imagen.jpg' con la ruta correcta de tu imagen */
      background-size: cover; /* Ajusta el tamaño de la imagen para cubrir todo el fondo */
      background-position: center; /* Centra la imagen en el fondo */
      background-repeat: no-repeat;
      
      }
      #map{
      width:90%;
      height:90%;
      border: 2px solid black;
      margin-left: auto;
      margin-right:auto;
      margin-top:8px;
      border-radius: 15px;
      position: relative;
      }

      .content {
        margin: 0.25rem;
        border-top: 1px solid #000;
        padding-top: 0.5rem;
      }
      .header {
        font-size: 1.8rem;
        color: #7f7f7f;
      }
      .title {
        font-size: 1.1rem;
        color: #7f7f7f;
        font-weight: bold;
      }
      #form {  /* Estilo formulario eliminar */
      position: fixed;
      top: 50%;
      left: 20%;
      transform: translate(-50%, -50%);
      background-color: #f8f8f8;
      padding: 20px;
      border: 2px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      z-index: 9999;
      }
      #form2 {    /* Estilo formulario editar */
        position: fixed;
        top: 50%;
        left: 25%;
        transform: translate(-50%, -50%);
        background-color: #f8f8f8;
        padding: 20px;
        border: 2px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 9999;
      }
      #form3 {    /* Estilo formulario agregar */
        position: fixed;
        top: 50%;
        left: 20%;
        transform: translate(-50%, -50%);
        background-color: #f8f8f8;
        padding: 20px;
        border: 2px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 9999;
      }
      #form input {
        margin-top: 10px;
      }
      #form button {
        margin-top: 10px;
      }
      table {
        font-family: "Noto Sans", sans-serif;
        border-collapse: collapse;
        width: 100%;
      }
      td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }
      .table thead tr {
        background-color: #343a40;
        color: white;
      }
      .table tbody tr:nth-child(even) {
        background-color: #343a40;
        color: white;
      }
      .table tbody tr:nth-child(odd) {
        background-color: #6c757d;
        color: white;
      }

      .custom-table-container {
      background-color: #f0f0f0; /*Estilo de la tabla*/
      padding: 10px; 
      }

      .table {
        width: 100%;
        border-collapse: collapse;
      }

      .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
      }

      .table th {
        background-color: #325CCC;
        color: white;
      }

      .centered-title {
      text-align: center;
      color: black;
      font-family: "Noto Sans", sans-serif;
      }
      p {
      font-size: 130%;
      text-align: center;
      color: black;
      font-weight: bold;
      margin: 0;
      padding-left: 20px; 
      padding-right: 20px; 
      padding-top: 5px;
      padding-bottom:5px;
      width: fit-content;
      max-width: 90%; 
      margin-left: auto;
      margin-right: auto;
      background-size: cover;
      border: 2px solid black;
      margin-top: 4px;
      border-radius: 10px;
      background-color:white;
    }
    button, input, select, textarea, optgroup {
    font: 12px Noto Sans, sans-serif; /* Define la fuente que desees o utiliza "initial" o "unset" según tus necesidades */
    /* Otras propiedades de estilo que desees mantener o anular */
    }
    #norte{
      z-index: 999;
      position: absolute;
      top: -45px;
      right: 5%;
      transform: translate(0, 100%);
      width: 65px; 
      height: 65px;
    }
    .leaflet-control-coordinates {
    background: white;
    border: 5px solid #ccc;
    padding: 5px;
    }
    .custom-h2 {
    font-family:"Noto Sans", sans-serif;
    text-align: center;
    margin: 0;
    font-size:25px;
    }


    </style>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400;500;700&family=Noto+Sans:wght@700&display=swap">

</head>
<body>
  <p style="font-size: 130%; text-align: center; color:black; "> Equipamientos en la Comuna 16</p>
  <div id="map">
  <img id="norte" src="img/n.png" class="norte"/>
      </div>
    <!---------------------------- FORMULARIO : Eliminar datos ---------------------------->
    <div id="form" class="w3-container">
        <h2 class="custom-h2">Eliminar Dato</h2>
        <form id="deleteForm">
          <label for="id">Escriba el ID del dato a eliminar:</label>
          <input class="w3-input w3-border" type="text" id="id" placeholder="Identificador" required>
          <br>
          <button type="submit" class="w3-button w3-blue">Eliminar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button class="w3-button w3-black" type="button" onclick="cancelForm1()">Cancelar</button>
        </form>
      </div>
      <!---------------------------- FORMULARIO : Añadir datos ---------------------------->
      <div id="form3" class="w3-container">
        <h2 class="custom-h2">Agregar Dato</h2>
        <form id="addForm" method="POST" action="php/save.php">
            <input type="text" class="w3-input w3-border" id="id" name="id" placeholder="Identificador" required>
            <br>
            <input type="text" class="w3-input w3-border" id="tipo" name="tipo" placeholder="Tipo" required>
            <br>
            <input type="text" class="w3-input w3-border" id="nombre" name="nombre" placeholder="Nombre" required>
            <label for="id">Latitud:</label>
            <input type="text" id="latitude" class="w3-input w3-border" name="latitude" placeholder="Latitud" readonly>
            <label for="id">Longitud:</label>
            <input type="text" id="longitude" class="w3-input w3-border" name="longitude" placeholder="Longitud" readonly>
            <br>
            <button type="submit" class="w3-button w3-blue">Guardar</button>&nbsp;&nbsp;
            <button type="button" class="w3-button w3-black" onclick="cancelForm3()">Cancelar</button>
       </form>
      </div>
      <!-------------------------------Formulario EDITAR------------------------------------>
      <div id="form2" class="w3-container" style="display: none;">
    <h2 class="custom-h2">Editar Dato</h2>
    <form id="editForm" action="php/edit.php" method="POST">
        <label for="editId">ID:</label>
        <input id="editId" class="w3-input w3-border" name="editId" placeholder="ID a editar" required><br>
        <label for="edittipo">Tipo:</label>
        <input id="edittipo" class="w3-input w3-border" name="edittipo" placeholder="Tipo" required><br>
        <label for="editnombre">Nombre:</label>
        <input id="editnombre" class="w3-input w3-border" name="editnombre" placeholder="Nombre" required><br>
        <label for="editlat">Latitud:</label>
        <input id="editlat" class="w3-input w3-border" name="editlat" placeholder="Latitud" required><br>
        <label for="editlong">Longitud:</label>
        <input id="editlong" class="w3-input w3-border" name="editlong" placeholder="Longitud" required><br>
        <input type="submit" class="w3-button w3-blue" value="Guardar">&nbsp;&nbsp;
        <button type="button" class="w3-button w3-black" id="cancelEditingBtn">Cancelar</button>
        <button type="button" class="w3-button w3-red" onclick="getRecordById()">Obtener Registro</button>
    </form>
</div>


      <script src="geosearch/leaflet-search.js"></script>
    </div> 
</body>
<script>
    var map = L.map("map", {
  zoomControl: true,
  maxZoom: 19,
  minZoom: 12,
  }).setView([3.450430, -76.534438], 15);

  // Agregar el proveedor de mapas base de Stadia AlidadeSmooth
  var Stadia_AlidadeSmooth = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.{ext}', {
      minZoom: 0,
      maxZoom: 20,
      attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      ext: 'png'
  });
  Stadia_AlidadeSmooth.addTo(map);

  // Crear un nuevo panel y configurar su Z-index
  map.createPane("pane_Esri_WorldGrayCanvas");
  map.getPane("pane_Esri_WorldGrayCanvas").style.zIndex = 400;

  Stadia_AlidadeSmooth.addTo(map);
  // Carga de los límites de la comuna 16
  fetch("json/com.geojson")
  .then((response) => response.json())
  .then((data) => {
    var geojsonLayer = L.geoJSON(data, {
      style: {
        fillColor: "transparent", // Relleno transparente
        color: "red", // Color del límite
        weight: 1 // Grosor del límite
      }
    }).addTo(map);

    var bounds = geojsonLayer.getBounds();
    map.setMaxBounds(bounds);
    map.fitBounds(bounds);
  });

   //---------------------------- Carga de información desde la BDG ----------------------------//
   var puntos = L.geoJSON();
    $.post("php/conect.php",{
      peticion: 'cargar',
    },function (data, status, feature){
      if(status=='success'){
        puntos = eval('('+data+')');
        var puntos = L.geoJSON(puntos, {
          onEachFeature: info_popup
        });
        puntos.eachLayer(function (layer) {
          layer.setZIndexOffset(1000);
        });
        leyenda.addOverlay(puntos, 'Equipamientos');
      }
    });
    //---------------------------- Geolocalizacion ----------------------------//							
    var lc = L.control.locate({
      position: 'topleft',
      strings: {
        title: "Mostrar tu ubicación",
        popup: "Estás a {distance} {unit} de este punto",
        outsideMapBoundsMsg: "Estás fuera del limite del mapa"
      },
    }).addTo(map);

    // Función para crear la cabecera del panel
      function createHeader() {
        return '<div class="header centered-title">Tabla de Datos</div>';
      }
          //---------------------------- Tabla de datos ----------------------------//			 
      // Declarar el objeto de popups fuera de la función para evitar redeclaraciones
      var popups = {};

      // Función para acercamiento a puntos individuales con popup
      function zoomToLocation(lat, lng, nombre) {
        if (currentMarker) {
          map.removeLayer(currentMarker);
        }
        currentMarker = L.marker([lat, lng]).addTo(map);

        // Volcar la vista del mapa al punto y mostrar un popup
        map.flyTo([lat, lng], 18);

        // Verificar si hay un popup existente y cerrarlo antes de crear uno nuevo
        if (popups[nombre]) {
          popups[nombre].close();
        }

        // Agregar un popup al marcador con el nombre del equipamiento
        popups[nombre] = L.popup({ closeButton: false, autoClose: false })
          .setLatLng([lat, lng])
          .setContent(nombre)
          .openOn(map);
      }

      // Función para crear el contenido principal del panel
      function createContent() {
        return `
          <div class="content custom-table-container">
            <h6>Sistemas de equipamientos presentes en la comuna 16 basados en su categoría junto con su nombre distintivo. Se puede interactuar con cada dato para enfocarlo y ver su marcador.</h6>
            <table class="table" id="locationsTable">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Tipo</th>
                  <th>Nombre</th>
                  <th>Acercar</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>`;
      }

      // Crear la cabecera y el contenido del panel
      const rightPanel = createHeader() + createContent();

      // Agregar el panel a tu código existente
      const slideMenu = L.control.slideMenu("", {
        position: "bottomright",
        menuposition: "topright",
        width: "40%",
        height: "500px",
        delay: "10",
        icon: "fa fa-table",
      }).addTo(map);

      // Establecer el contenido del panel
      slideMenu.setContents(rightPanel);

      var currentMarker;

      // Cargar datos desde PHP usando Ajax
      $.ajax({
        url: 'php/get_data.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
          data.forEach(function (row) {
            var id = row.id;
            var tipo = row.tipo;
            var nombre = row.nombre;
            var lat = row.lat;
            var lng = row.lng;

            $('#locationsTable tbody').append(`
              <tr style="background-color: white;">
                <td style="color: black;">${id}</td>
                <td style="color: black;">${tipo}</td>
                <td style="color: black;">${nombre}</td>
                <td style="color: black;"><button onclick="zoomToLocation(${lat}, ${lng}, '${nombre}')">Enfocar</button></td>
              </tr>
            `);
          });
        },
        error: function (xhr, status, error) {
          console.error('Error al cargar datos desde get_data.php:', xhr.responseText);
        }
      });
        //---------------------------- Escala ----------------------------//
        L.control.scale({position:'bottomleft'}).addTo(map);

        //---------------------------- BOTON Y CONEXION : Eliminar datos ----------------------------//

          // Código para mostrar/ocultar el formulario de eliminación
        function toggleForm() {
          $('#form').toggle();
        }

        // Código para eliminar el marcador
        function eliminarPunto(id) {
          $.ajax({
            url: 'php/delete.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
              alert(response);
            },
            error: function() {
              alert('Error al eliminar el marcador.');
            }
          });
        }

        // Manejador de eventos para enviar el formulario
        $('#deleteForm').on('submit', function(event) {
          event.preventDefault();
          eliminarPunto($('#id').val());
          $('#form').hide();
          // resetForm3(); // Agrega tu función para restablecer el formulario si es necesario
        });

        // Función para cancelar el formulario
        function cancelForm1() {
          $('#form').hide();
          // resetForm3(); // Agrega tu función para restablecer el formulario si es necesario
        }

        // Crear el EasyButton para abrir el formulario de eliminación
        var eliminarButton = L.easyButton('fa-trash', function() {
          toggleForm();
        }).addTo(map);

        // Ocultar el formulario al cargar la página
        $(document).ready(function() {
          $('#form').hide();
        });

      //---------------------------- BOTON Y CONEXION : Agregar datos ----------------------------//
      
      let clickedLatLng;
      let marker;
      let isFormOpened = false;

      // Código para alternar la visibilidad del formulario
      function toggleForm3() {
        const form3 = $('#form3');
        form3.toggle();
        isFormOpened = !isFormOpened;

        if (isFormOpened) {
          map.on('click', onMapClick);
        } else {
          map.off('click', onMapClick);
          removeMarker();
        }
      }

      function onMapClick(event) {
        if (isFormOpened) {
          removeMarker();
          clickedLatLng = event.latlng;
          updateFormCoordinates();
          marker = L.marker(clickedLatLng).addTo(map);
        }
      }

      function removeMarker() {
        if (marker) {
          map.removeLayer(marker);
        }
      }

      function updateFormCoordinates() {
        const latitudeInput = $('#latitude');
        const longitudeInput = $('#longitude');
        latitudeInput.val(clickedLatLng.lat);
        longitudeInput.val(clickedLatLng.lng);
      }

      function resetForm3() {
        $('#addForm')[0].reset();
      }

      function cancelForm3() {
        const form3 = $('#form3');
        form3.hide();
        isFormOpened = false;
        map.off('click', onMapClick);
        removeMarker();
        resetForm3();
      }

      // Manejador de eventos para enviar el formulario
      $('#addForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
            alert(response);
            resetForm3();
          },
          error: function() {
            alert('Error al guardar el punto.');
          }
        });
      });

      // Ruta a tu imagen personalizada
      const imagePath = 'img/point.svg';

      // Crea un botón fácil de Leaflet con la imagen personalizada
      const easyButton = L.easyButton({
        states: [{
          stateName: 'add-point',
          icon: `<img src="${imagePath}" alt="Imagen personalizada" style="width: 20px; height: 20px;">`,
          title: 'Añadir Dato',
          onClick: function (control) {
            toggleForm3();
            control.state('default');
          }
        }]
      }).addTo(map);

      // Ocultar el formulario al cargar la página
      $(document).ready(function() {
        $('#form3').hide();
      });

      //---------------------------- BOTON Y CONEXION : Editar datos ----------------------------//

      var marker2; // Variable para almacenar el marcador

      // Función para abrir o cerrar el formulario
      function toggleForm2() {
          $('#form2').toggle();
          if ($('#form2').is(':visible')) {
              // Si el formulario se muestra, agregar el evento de clic al mapa
              map.on('click', onMapClick2);
          } else {
              // Si el formulario se oculta, eliminar el marcador y el evento de clic del mapa
              map.off('click', onMapClick2);
              if (marker2) {
                  map.removeLayer(marker2);
                  marker2 = null; // Eliminar la referencia al marcador
              }
          }
      }

      // Manejador de eventos para el clic en el mapa
      function onMapClick2(e) {
          if ($('#form2').is(':visible')) {
              // Verificar si el formulario está visible
              if (marker2) {
                  map.removeLayer(marker2);
              }
              var lat = e.latlng.lat;
              var long = e.latlng.lng;
              marker2 = L.marker([lat, long]).addTo(map);
              document.getElementById('editlat').value = lat;
              document.getElementById('editlong').value = long;
          }
      }

      // Función para cancelar el formulario
      function cancelForm() {
          document.getElementById('form2').style.display = 'none';
      }

      // Obtener referencia al contenedor del formulario
      var formContainer = document.getElementById('formContainer');

      // Obtener referencia al botón de cancelar
      var cancelEditingBtn = document.getElementById('cancelEditingBtn');

      // Establecer el manejador de eventos para el botón de cancelar
      cancelEditingBtn.addEventListener('click', function () {
          toggleForm2();
      });

      // Ruta a tu imagen personalizada para el botón de editar
      const editImagePath = 'img/edit.svg';

      // Crea un botón fácil de Leaflet para editar con la imagen personalizada
      const editButton = L.easyButton({
          states: [{
              stateName: 'edit-point',
              icon: `<img src="${editImagePath}" alt="Imagen personalizada para editar" style="width: 20px; height: 20px;">`,
              title: 'Editar Dato',
              onClick: function (control) {
                  toggleForm2();
                  control.state('default');
              }
          }]
      }).addTo(map);

      // Función para obtener un registro por ID
      function getRecordById() {
          var editId = document.getElementById('editId').value;
          console.log("ID enviado al servidor:", editId);

          // Realizar una solicitud AJAX al servidor para obtener los datos por ID
          $.ajax({
              type: 'POST',
              url: 'php/edit.php', // <-- Ajusta la ruta aquí
              data: { id: editId },
              success: function (data) {
                  console.log("Respuesta del servidor:", data);
                  // Procesar los datos obtenidos y llenar el formulario con ellos
                  var record = JSON.parse(data);
                  document.getElementById('editId').value = record.id;
                  document.getElementById('edittipo').value = record.tipo;
                  document.getElementById('editnombre').value = record.nombre;
                  // Ajustar aquí para acceder a las coordenadas correctamente
                  document.getElementById('editlat').value = record.lat;
                  document.getElementById('editlong').value = record.long;
              },
              error: function (jqXHR, textStatus, errorThrown) {
                  console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                  alert('Error al obtener el registro por ID.');
              }
          });
      }

      // Manejador de eventos para el envío del formulario
      $('#editForm').submit(function (event) {
          // Capturar el valor del ID antes de enviar el formulario
          var editId = document.getElementById('editId').value;
          console.log("ID enviado al servidor:", editId);

          // Si el ID no está presente, prevenir el envío del formulario
          if (editId.trim() === "") {
              console.log("ID no proporcionado.");
              alert("ID no proporcionado.");
              event.preventDefault();
              return;
          }

          // Limpiar el formulario de campos ocultos existentes antes de agregar el nuevo
          $('#editForm input[type="hidden"]').remove();

          // Agregar el ID como campo oculto al formulario antes de enviarlo
          $('#editForm').append('<input type="hidden" name="id" value="' + editId + '">');

          // Continuar con el envío del formulario de manera asincrónica
          $.ajax({
              type: 'POST',
              url: 'php/edit.php',
              data: $('#editForm').serialize(), // Serializar el formulario para enviar todos los campos
              success: function (data) {
                  console.log("Respuesta del servidor:", data);
                  // Aquí puedes manejar la respuesta del servidor según tus necesidades
              },
              error: function (jqXHR, textStatus, errorThrown) {
                  console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                  alert('Error al guardar los datos.');
              }
          });

          // Prevenir el envío del formulario de manera síncrona
          event.preventDefault();
      });

         //---------------------------- Cargar Puntos ----------------------------//
        // Definir un nuevo icono más pequeño basado en el ícono por defecto de Leaflet
        var smallIcon = new L.Icon({
        iconUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png',
        iconSize: [20, 30],
        iconAnchor: [10, 30],
        popupAnchor: [0, -30]
        });

        var puntosLayer = L.geoJSON(null, {
        pointToLayer: function (feature, latlng) {
          return L.marker(latlng, { icon: smallIcon });
        }
        });

        $.post("php/conect.php", { peticion: 'cargar' }, function (data, status) {
        if (status === 'success') {
          var puntosData = JSON.parse(data);

          puntosLayer.addData(puntosData);

          var overlayMaps = {
            "Equipamientos": puntosLayer
          };

          L.control.layers(null, overlayMaps).addTo(map);

          puntosLayer.addTo(map);

          map.fitBounds(puntosLayer.getBounds());

          puntosLayer.eachLayer(function (layer) {
            var popupContent = '<b>Tipo:</b> ' + (layer.feature.properties.tipo || 'N/A') +
                                '<br><b>Nombre:</b> ' + (layer.feature.properties.nombre || 'N/A');
            layer.bindPopup(popupContent);
          });
        } else {
          console.error('Error en la solicitud:', status);
        }
        });



  
           function addCoordinatesControl() {
             L.Control.coordinates = L.Control.extend({
               onAdd: function(map) {
                 var container = L.DomUtil.create('div', 'leaflet-control-coordinates');
                 container.style.padding = '5px';
                 container.innerHTML = 'Lat: 0.0000, Lng: 0.0000';
                 map.on('mousemove', function(e) {
                   container.innerHTML = 'Lat: ' + e.latlng.lat.toFixed(4) + ', Lng: ' + e.latlng.lng.toFixed(4);
                 });
   
                 return container;
               },
   
               onRemove: function(map) {
                 map.off('mousemove');
               }
             });
   
             L.control.coordinates = function(options) {
               return new L.Control.coordinates(options);
             };
   
             L.control.coordinates({ position: 'topleft' }).addTo(map);
           }
           addCoordinatesControl();
   


    </script>
</html>