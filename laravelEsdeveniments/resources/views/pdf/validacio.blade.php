<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Validar QR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900 dark:text-white-100">
                    <!-- Mensaje de instrucción -->
                    <h3 class="text-center text-lg font-semibold">
                        Passa el QR de les entrades per aquí:
                    </h3>

                    <!-- Zona de la cámara y filtro de escaneo -->
                    <div id="qr-scanner-container" class="relative mt-6">
                        <video id="video" width="100%" height="auto" style="border: 1px solid #ccc;"></video>
                        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-40"></div>
                        <div id="scannerArea" class="absolute top-1/4 left-1/4 w-1/2 h-1/2 border-4 border-dashed border-white"></div>
                    </div>

                    <!-- Botón para iniciar el escaneo -->
                    <div id="startScanBtn" class="text-center mt-4">
                        <button id="startScan" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Iniciar Escaneo
                        </button>
                    </div>

                    <!-- Mostrar mensaje de resultado -->
                    <div id="scanResult" class="text-center mt-4 text-xl"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluye la librería para leer el QR -->
    <script src="https://unpkg.com/jsQR/dist/jsQR.js"></script>
    <script>
        let videoElement = document.getElementById('video');
        let startScanButton = document.getElementById('startScan');
        let scanResult = document.getElementById('scanResult');
        let scannerArea = document.getElementById('scannerArea');
        let scanStarted = false;

        // Accede a la cámara
        async function startCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: 'environment' } // Usa la cámara trasera en dispositivos móviles
                });
                videoElement.srcObject = stream;
                videoElement.setAttribute("playsinline", true); // Hace que funcione en iOS
                videoElement.play();
                scanStarted = true;
                startScanButton.style.display = 'none'; // Oculta el botón después de iniciar
                requestAnimationFrame(scanQRCode); // Llama a la función para escanear el QR
            } catch (err) {
                console.error("Error al acceder a la cámara: ", err);
                scanResult.textContent = "No se puede acceder a la cámara. Asegúrate de tener permisos.";
            }
        }

        // Escanea el QR de la cámara
        function scanQRCode() {
            if (videoElement.readyState === videoElement.HAVE_ENOUGH_DATA) {
                const canvasElement = document.createElement("canvas");
                const canvas = canvasElement.getContext("2d");
                canvasElement.height = videoElement.videoHeight;
                canvasElement.width = videoElement.videoWidth;
                canvas.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);

                const imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                const code = jsQR(imageData.data, canvasElement.width, canvasElement.height, {
                    inversionAttempts: "dontInvert"
                });

                if (code) {
                    // Si se detecta el código QR, envía la solicitud al servidor
                    handleScanResult(code.data);
                } else {
                    if (scanStarted) {
                        requestAnimationFrame(scanQRCode); // Vuelve a intentar si no detecta un QR
                    }
                }
            }
        }

        // Envia el código QR al servidor para validarlo
        function handleScanResult(codigoQr) {
            scanResult.textContent = `QR Detectado: ${codigoQr}`;
            fetch("{{ route('pdf.validarQr') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ codigo_qr: codigoQr })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    scanResult.textContent = data.message;
                    scanResult.style.color = "green";
                } else {
                    scanResult.textContent = data.message;
                    scanResult.style.color = "red";
                }
            })
            .catch(error => {
                console.error('Error al validar el QR:', error);
                scanResult.textContent = "Hubo un error al validar el QR.";
                scanResult.style.color = "red";
            });
        }

        // Iniciar el escaneo cuando el usuario presione el botón
        startScanButton.addEventListener('click', startCamera);
    </script>
</x-app-layout>
