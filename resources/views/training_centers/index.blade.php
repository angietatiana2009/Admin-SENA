<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <title>Lista Centros</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 800px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .15);
        }

        h1 {
            text-align: center;
            color: #2563eb;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 10px;
        }

        thead {
            background: #2563eb;
            color: white;
        }

        thead th {
            padding: 15px;
            text-align: left;
            font-size: 18px;
        }

        tbody td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        tbody tr:hover {
            background: #dbeafe;
            transition: .3s;
        }

        .numero {
            width: 70px;
            text-align: center;
            font-weight: bold;
        }

        .nombre {
            font-size: 17px;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($trainingcenters as $trainingcenter)
                    <tr>
                        <td>{{ $trainingcenter->name }}</td>
                        <td>{{ $trainingcenter->location }}</td>
                        <td>
                            <a href="{{ route('trainingcenter.show', $trainingcenter->id) }}"
                                class="btn btn-primary btn-sm">
                                Mostrar
                            </a>

                            @unless (auth()->check() && in_array(auth()->user()->role, ['teacher', 'apprentice'], true))
                                <a href="{{ route('trainingcenter.edit', $trainingcenter->id) }}"
                                    class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('trainingcenter.destroy', $trainingcenter->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>
                            @endunless
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
