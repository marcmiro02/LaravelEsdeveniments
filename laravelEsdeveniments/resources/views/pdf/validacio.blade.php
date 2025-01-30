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

                    <!-- Contenedor del lector QR -->
                    <div id="qr-reader" style="width: 100%; max-width: 500px; margin: 20px auto;"></div>

                    <!-- Contenedor para mostrar el resultado -->
                    <div id="scanResult" class="text-center mt-4 text-xl"></div>

                    <!-- Botón para volver a escanear -->
                    <div id="retryButtonContainer" class="text-center mt-4" style="display: none;">
                        <button id="retryButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Volver a Escanear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Librería HTML5-QRCode -->
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        // Elementos de la página
        const qrReaderContainer = document.getElementById("qr-reader");
        const scanResult = document.getElementById("scanResult");
        const retryButtonContainer = document.getElementById("retryButtonContainer");
        const retryButton = document.getElementById("retryButton");

        // Configuración para el lector QR
        const config = {
            fps: 10, // Frames por segundo
            qrbox: 250 // Tamaño del cuadro para detectar QR
        };

        // Función para manejar el escaneo exitoso
        function onScanSuccess(decodedText, decodedResult) {
            console.log("QR Detectado:", decodedText); // Muestra el QR en la consola
            scanResult.textContent = `QR Detectado: ${decodedText}`;
            scanResult.style.color = "green";

            // Limpiar el valor del código QR (eliminar saltos de línea y espacios extra)
            const codigoQrLimpio = decodedText.replace(/[\r\n]+/g, "").trim();

            // Aquí se asegura que solo la primera parte del QR (antes de un espacio o salto de línea) sea enviada
            const codigoQrFinal = codigoQrLimpio.split(' ')[0];  // Si el QR tiene un espacio, esto toma solo la primera parte

            console.log("Código QR final:", codigoQrFinal); // Verifica si el valor está correcto

            // Obtener el id del evento seleccionado directamente
            //const selectedEventId = document.getElementById('id_esdeveniment').value;
            //console.log("ID del evento seleccionado:", selectedEventId); // Verifica que el ID se obtiene correctamente

            // if (!selectedEventId) {
            //     scanResult.textContent = "❌ No se ha seleccionado un evento.";
            //     scanResult.style.color = "red";
            //     // Detenemos el escáner si no hay evento seleccionado
            //     html5QrCode.stop().catch(err => {
            //         console.error("Error al detener el lector QR:", err);
            //     });
            //     return; // Si no hay evento seleccionado, aborta el proceso
            // }

            // Detener el escáner antes de validar el QR
            html5QrCode.stop().then(() => {
                console.log("Enviando código QR al servidor:", codigoQrFinal);

                // Llama al servidor para validar el QR
                fetch("{{ route('pdf.validarQr') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ codigo_qr: codigoQrFinal }) // Envía el QR limpio y correcto al servidor
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error del servidor: ${response.status}`);
                    }
                    return response.json(); // Asegúrate de que el servidor devuelve JSON
                })
                .then(data => {
                    console.log("Respuesta del servidor:", data);
                    if (data.success) {
                        scanResult.textContent = `✅ ${data.message}`;
                        scanResult.style.color = "green";
                    } else {
                        scanResult.textContent = `❌ ${data.message}`;
                        scanResult.style.color = "red";
                    }
                    // Mostrar el botón para volver a escanear
                    retryButtonContainer.style.display = "block";
                })
                .catch(error => {
                    console.error("Error al validar el QR:", error);
                    scanResult.textContent = "Hubo un error al validar el QR.";
                    scanResult.style.color = "red";
                    // Mostrar el botón para volver a escanear
                    retryButtonContainer.style.display = "block";
                });
            }).catch(err => {
                console.error("Error al detener el lector QR:", err);
                scanResult.textContent = "Hubo un error al detener el lector QR.";
                scanResult.style.color = "red";
                // Mostrar el botón para volver a escanear
                retryButtonContainer.style.display = "block";
            });
        }

        // Inicializa el lector QR con la cámara trasera
        const html5QrCode = new Html5Qrcode("qr-reader");

        html5QrCode.start(
            { facingMode: "environment" }, // Usa la cámara trasera
            config,
            onScanSuccess
        ).catch(err => {
            console.error("Error al iniciar el lector QR:", err);
            scanResult.textContent = "No se puede acceder a la cámara. Asegúrate de otorgar permisos.";
            scanResult.style.color = "red";
        });

        // Función para volver a escanear
        retryButton.addEventListener("click", () => {
            scanResult.textContent = "";
            retryButtonContainer.style.display = "none";
            html5QrCode.start(
                { facingMode: "environment" }, // Usa la cámara trasera
                config,
                onScanSuccess
            ).catch(err => {
                console.error("Error al iniciar el lector QR:", err);
                scanResult.textContent = "No se puede acceder a la cámara. Asegúrate de otorgar permisos.";
                scanResult.style.color = "red";
            });
        });
    </script>
</x-app-layout>