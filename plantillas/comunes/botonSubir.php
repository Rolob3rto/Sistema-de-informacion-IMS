<footer>
    <button id="btn-volver-arriba" class="btn btn-secondary" type="button">
        <i class="bi bi-arrow-up"></i>
    </button>
</footer>

<style>
    #btn-volver-arriba {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        padding: 0.5em 1em 0.5em 1em;
    }
</style>

<script>
    $(document).ready(function() {
        // Verificar la posición del usuario en la página
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#btn-volver-arriba').fadeIn();
            } else {
                $('#btn-volver-arriba').fadeOut();
            }
        });

        // Hacer scroll suave al hacer clic en el botón
        $('#btn-volver-arriba').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
</script>