<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
</head>

<body>
    <div>Olá, {{ $student->name }}!!!</div>

    <div>Você está há 1 passo de completar sua inscrição no curso {{ $course->name }}!</div>
    <div>Para concluir sua inscrição, favor efetuar o pagamento abaixo.</div>

    @foreach (explode(' ', $links) as $link)
    <a href="{{ $link }}" target="_blank">{{ $link }}</a><br>
    @endforeach
</body>

</html>