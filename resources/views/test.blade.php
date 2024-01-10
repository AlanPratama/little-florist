<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TESTING</title>
    <style>
        .test {
            display: flex;
            flex-wrap: wrap;
            justify-content: start;
            align-items: center;
            gap: 6px;
        }
    </style>
</head>

<body>
    <form enctype="multipart/form-data" method="POST" action="{{ route('testPost') }}">
        @csrf
        <input type="file" accept="image/*" name="image">
        <button type="submit">SUBMIT</button>
    </form>

    <hr>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

    <div class="test">
        @foreach ($test as $item)
            <img src="{{ asset('storage/' . $item->image) }}" alt="test" style="width: 35px;">
            <h3>{{ $item->name }}</h3>
            <span>|</span>
        @endforeach
    </div>

</body>

</html>
