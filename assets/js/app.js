// assets/js/app.js
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. VALIDACIÓN DE FORMULARIO Y MANIPULACIÓN DEL DOM
    const formEntrada = document.getElementById('formEntrada');
    if (formEntrada) {
        const inputTitulo = document.getElementById('titulo');
        const inputResumen = document.getElementById('resumen');
        const inputContenido = document.getElementById('contenido');
        const contadorResumen = document.getElementById('contadorResumen');
        const contadorContenido = document.getElementById('contadorContenido');

        // Función auxiliar para validar longitud mínima y aplicar clases de Bootstrap
        const validarCampo = (campo, minLength) => {
            const valor = campo.value.trim();
            if (valor.length < minLength) {
                campo.classList.remove('is-valid');
                campo.classList.add('is-invalid');
                return false;
            } else {
                campo.classList.remove('is-invalid');
                campo.classList.add('is-valid');
                return true;
            }
        };

        // Función para actualizar contadores de caracteres en tiempo real
        const actualizarContador = (campo, elementoContador, minimo) => {
            const longitud = campo.value.trim().length;
            elementoContador.textContent = `${longitud} caracteres (mín. ${minimo})`;
            if (longitud >= minimo) {
                elementoContador.classList.remove('text-muted', 'text-danger');
                elementoContador.classList.add('text-success', 'fw-bold');
            } else {
                elementoContador.classList.remove('text-success', 'fw-bold');
                elementoContador.classList.add('text-muted');
            }
        };

        // Inicializar contadores al cargar (útil cuando se edita una entrada existente)
        actualizarContador(inputResumen, contadorResumen, 10);
        actualizarContador(inputContenido, contadorContenido, 20);

        // Eventos en tiempo real mientras el usuario escribe
        inputTitulo.addEventListener('input', () => validarCampo(inputTitulo, 5));
        inputResumen.addEventListener('input', () => {
            validarCampo(inputResumen, 10);
            actualizarContador(inputResumen, contadorResumen, 10);
        });
        inputContenido.addEventListener('input', () => {
            validarCampo(inputContenido, 20);
            actualizarContador(inputContenido, contadorContenido, 20);
        });

        // Validación completa al intentar enviar el formulario
        formEntrada.addEventListener('submit', (evento) => {
            const tituloValido = validarCampo(inputTitulo, 5);
            const resumenValido = validarCampo(inputResumen, 10);
            const contenidoValido = validarCampo(inputContenido, 20);

            if (!tituloValido || !resumenValido || !contenidoValido) {
                evento.preventDefault(); // Detiene el envío si hay errores
                evento.stopPropagation();
            }
        });
    }

    // 2. CONFIRMACIÓN INTERACTIVA ANTES DE ELIMINAR UN REGISTRO
    const formulariosEliminar = document.querySelectorAll('.form-eliminar');
    formulariosEliminar.forEach((form) => {
        form.addEventListener('submit', (evento) => {
            const tituloPost = form.getAttribute('data-titulo') || 'esta publicación';
            const confirmado = confirm(`¿Estás seguro de que deseas eliminar "${tituloPost}"?\nEsta acción no se puede deshacer.`);
            
            if (!confirmado) {
                evento.preventDefault();
            }
        });
    });

    // 3. INTERACCIÓN DINÁMICA: AUTO-OCULTAR ALERTAS DE ÉXITO TRAS 4 SEGUNDOS
    const alertaExito = document.querySelector('.alert-success');
    if (alertaExito) {
        setTimeout(() => {
            // Usamos la instancia nativa de Bootstrap Alert para cerrarla con animación suave
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alertaExito);
            bsAlert.close();
        }, 4000);
    }
});