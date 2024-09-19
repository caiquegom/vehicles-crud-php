<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listagem de veículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <main class="container border-start border-end px-0">
        <header class="d-flex align-items-center justify-content-between bg-primary bg-gradient px-4 py-3">
            <h1 class="h4 text-white">Veículos</h1>
            <?php
                $url = $_SERVER['HTTP_HOST'];
                echo "<a class='btn btn-success' href='http://{$url}/newVehicle'>Adicionar veículo</a>"
            ?>
        </header>
        <table class="table mb-0">
            <thead>
                <tr>
                    <th scope="col">Dono</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Cor</th>
                    <th scope="col">Placa</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

                    <?php
                    $url = $_SERVER['HTTP_HOST'];
                    foreach ($vehicles as $vehicle) {
                        echo "
                            <tr>
                                <td>{$vehicle->owner_name}</td>
                                <td>{$vehicle->model}</td>
                                <td>{$vehicle->color_name}</td>
                                <td>{$vehicle->plate}</td>
                                <td>
                                    <a href='http://{$url}/vehicles/{$vehicle->id}/edit' class='btn btn-primary'>Editar</a>
                                    <form action='vehicles/{$vehicle->id}/delete' method='post' style='display: inline'>
                                        <button type='submit' class='btn btn-danger' class='remove-button'>Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }

                    ?>
                </form>
            </tbody>
        </table>
    </main>

</body>
</html>