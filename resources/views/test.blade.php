<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test</title>
    @livewireStyles
</head>
<body>

<livewire:counter/>

<div style="text-align: center">
    <button onclick="increment()">js</button>
    <h1 id="counter">0</h1>
</div>


<livewire:search-customer/>


<script>
    let counter = 0;

    function increment() {
        counter++;
        document.getElementById('counter').innerHTML = counter.toString();
    }
</script>

@livewireScripts
</body>
</html>
