<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>BirdBoard</h1>
    <div>
        @foreach ($projects as $project)
            <a href="{{ route('project.show', ['id' => $project->id])}}"><p>{{ $project->title }}</p>
        @endforeach
    </div>

</body>
</html>