<div class="menuPrincipal shadow">
    <div class="container">
        <a href="../index.php">
            <img src="../img/portada.png" alt="logo de la empresa" width="270em" class="mt-3" />
        </a>
        <h1 class="h1 text-primary" style="text-shadow: 2px 2px 4px gray;">SISTEMA DE INFORMACIÓN</h1>
    </div>
    <ul style="padding: 0;">
        <li class="btn text-primary shadow-lg border-white <?php if ($pagina_actual == 'listadoClientes') echo 'activo'; ?>"><a href="listadoClientes.php">Clientes</a></li>
        <li class="btn text-primary shadow-lg border-white <?php if ($pagina_actual == 'listadoPartesDeTrabajo') echo 'activo'; ?>"><a href="listadoPartesDeTrabajo.php">Partes de trabajo</a></li>
    </ul>
    <style>
        .activo {
            background-color: #84F588 !important;
        }
    </style>
</div>