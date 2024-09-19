<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listagem de veículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <main class="container border border-top-0 px-0">
        <header class="d-flex align-items-center justify-content-between bg-primary bg-gradient px-4 py-3">
            <h1 class="h4 text-white">Cadastrar veículo</h1>
        </header>
        <form action="vehicles" method="post" class="needs-validation p-4" novalidate>
            <div class="row">
                <div class="col mb-3">
                    <label for="ownerName" class="form-label">Proprietário do veículo</label>
                    <input type="text" class="form-control" id="ownerName" name="ownerName" placeholder="Ex.: João da Silva" required>
                    <div class="invalid-feedback">
                        Informe o proprietário.
                    </div>
                </div>
                <div class="col mb-3">
                    <label for="model" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="model" name="model" placeholder="Ex.: Etios" required>
                    <div class="invalid-feedback">
                        Informe o modelo do veículo.
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label for="colorId" class="form-label">Cor</label>
                    <select class="form-select" id="colorId" name="colorId" required>
                        <option value="" selected disabled>Selecione a cor</option>
                        <?php
                            foreach ($colors as $color) {
                                echo "<option value='{$color->id}'>$color->name</option>";
                            }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        Informe a cor do veículo.
                    </div>
                </div>
                <div class="col">
                    <label for="plate" class="form-label">Placa</label>
                    <input type="text" class="form-control" id="plate" name="plate" placeholder="Ex.: AAA0000"
                           maxlength="7"
                           pattern="^[A-Z]{3}-?\d{4}$|^[A-Z]{3}\d[A-Z]\d{2}$"
                           required>
                    <div class="invalid-feedback">
                        Informe uma placa válida.
                    </div>
                </div>
            </div>

            <?php
                $url = $_SERVER['HTTP_HOST'];
                echo "<a class='btn btn-outline-primary' href='http://{$url}'>Voltar</a>"
            ?>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
    </main>

    <script>
        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>