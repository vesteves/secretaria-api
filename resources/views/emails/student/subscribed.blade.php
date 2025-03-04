<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudante inscrito</title>
</head>

<body>
    <div>Olá, {{ $student->name }}!!!</div>

    <div>Você foi inscrito(a) no curso {{ $course->name }}!</div>
    <div>Sua turma começará em {{ $group->start }}.</div>

    <div>Seu contrato está em anexo.</div>
</body>

</html>