<!-- Incluir los scripts de Three.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three/examples/js/loaders/GLTFLoader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three/examples/js/controls/OrbitControls.js"></script>

<style>
    /* Estilos del fondo con degradado */
    body {
        margin: 0;
        height: 100vh;
        background: linear-gradient(to bottom, #dcdcdc, #a9a9a9); /* Degradado gris plomo */
        display: flex;
        flex-direction: column;
    }

    /* Estilo para el contenedor del modelo 3D */
    #modelo-3d {
        width: 100%;
        height: 500px;
        position: relative;
        flex-grow: 1;
    }

    /* Estilo para el navbar */
    nav {
        background-color: #333;
        padding: 15px;
        color: white;
        text-align: center;
    }

    nav a {
        color: white;
        text-decoration: none;
        margin: 0 15px;
        font-size: 18px;
    }

    nav a:hover {
        text-decoration: underline;
    }
</style>

<body>

    <!-- Navbar con el Login -->
    <nav>
        <a href="{{ route('login') }}">Login</a>
    </nav>

    <!-- Contenedor del modelo 3D -->
    <div id="modelo-3d"></div>

    <script>
        // Crear la escena
        const scene = new THREE.Scene();
        scene.background = new THREE.Color(0xcccccc); // Fondo con gris suave

        // Crear la cámara
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.set(0, 2, 5); // Posición de la cámara más cercana al modelo

        // Crear el renderizador
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('modelo-3d').appendChild(renderer.domElement);

        // Agregar controles de órbita (zoom y rotación)
        const controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true; // Suaviza el movimiento

        // Agregar luces
        const light = new THREE.AmbientLight(0xffffff, 1); // Luz ambiental
        scene.add(light);

        const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
        directionalLight.position.set(5, 5, 5);
        scene.add(directionalLight);

        // Cargar el modelo GLB
        const loader = new THREE.GLTFLoader();
        loader.load("{{ asset('modelo/oficina.glb') }}", function (gltf) {
            const model = gltf.scene;
            model.position.set(0, 0, 0);
            model.scale.set(1, 1, 1); // Escalar el modelo

            // Aplicar rotación inicial (modificar estos valores para ajustar la inclinación)
            model.rotation.set(0, -0.8, 0); // Rota el modelo en los ejes X, Y y Z

            scene.add(model);

            console.log('Modelo 3D cargado correctamente:', model);

            // Función de animación
            function animate() {
                requestAnimationFrame(animate);
                controls.update(); // Actualiza los controles
                renderer.render(scene, camera);
            }
            animate();
        }, undefined, function (error) {
            console.error('Error al cargar el modelo:', error);
        });

        // Ajustar el tamaño al cambiar ventana
        window.addEventListener('resize', function () {
            const container = document.getElementById('modelo-3d');
            const width = container.clientWidth;
            const height = container.clientHeight;

            camera.aspect = width / height;
            camera.updateProjectionMatrix();
            renderer.setSize(width, height);
        });
    </script>


</body>



{{--

 <!DOCTYPE html>
 <html lang="es">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Modelo 3D con Three.js</title>

     <!-- Incluir los scripts de Three.js -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/three/examples/js/loaders/GLTFLoader.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/three/examples/js/controls/OrbitControls.js"></script>

     <style>
         /* El contenedor tendrá un tamaño específico */
         #modelo-3d {
             width: 100%;  /* Ajuste al 100% del contenedor padre */
             height: 500px; /* Ajusta la altura como necesites */
             position: relative;
         }
     </style>
 </head>
 <body>

     <!-- Contenedor del modelo 3D -->
     <div id="modelo-3d"></div>

     <script>
         // Crear la escena
         const scene = new THREE.Scene();
         scene.background = new THREE.Color(0x0000ff); // Fondo azul

         // Crear la cámara
         const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
         camera.position.set(0, 2, 5); // Posición inicial

         // Crear el renderizador
         const renderer = new THREE.WebGLRenderer();
         renderer.setSize(window.innerWidth, window.innerHeight);
         document.getElementById('modelo-3d').appendChild(renderer.domElement);

         // Agregar controles de órbita (zoom y rotación)
         const controls = new THREE.OrbitControls(camera, renderer.domElement);
         controls.enableDamping = true; // Suaviza el movimiento

         // Agregar luces
         const light = new THREE.AmbientLight(0xffffff, 1); // Luz ambiental
         scene.add(light);

         const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
         directionalLight.position.set(5, 5, 5);
         scene.add(directionalLight);

         // Variable para guardar el modelo
         let model;

         // Cargar el modelo GLB
         const loader = new THREE.GLTFLoader();
         loader.load("{{ asset('modelo/oficina.glb') }}", function (gltf) {
             model = gltf.scene;
             model.position.set(0, 0, 0);
             model.scale.set(1, 1, 1); // Escalar el modelo
             scene.add(model);

             console.log('Modelo 3D cargado correctamente:', model);
         }, undefined, function (error) {
             console.error('Error al cargar el modelo:', error);
         });

         // Función de animación
         function animate() {
             requestAnimationFrame(animate);

             // Rotación automática del modelo
             if (model) {
                 model.rotation.y += 0.01; // Ajusta este valor para controlar la velocidad de la rotación
             }

             controls.update(); // Actualiza los controles
             renderer.render(scene, camera);
         }
         animate();

         // Ajustar el tamaño al cambiar ventana
         window.addEventListener('resize', function () {
             const container = document.getElementById('modelo-3d');
             const width = container.clientWidth;
             const height = container.clientHeight;

             camera.aspect = width / height;
             camera.updateProjectionMatrix();
             renderer.setSize(width, height);
         });
     </script>

 </body>
 </html>



 --}}
