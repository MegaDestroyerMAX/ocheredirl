<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Queue</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">

    <h1>Живая очередь</h1>
    <div class="ochered" id="queue-table">
        <div class="col-6">
            <h2>Ожидание</h2>
            @foreach($queues as $queue)
                <ul class="col-6">
                    <li>Талон:{{ $queue->number }}</li>
                    <li>Статус: <span>{{ $queue->status }}</span></li>
                </ul>
            @endforeach
        </div>
        <hr>
        <div class="col-6">
            <h2>Окно</h2>

        </div>
    </div>
</div>

    {{--    <h2>Register in Queue</h2>--}}
    {{--    <form action="{{ route('queue.register') }}" method="POST">--}}
    {{--        @csrf--}}
    {{--        <label for="name">Name:</label>--}}
    {{--        <input type="text" name="name" id="name" required>--}}
    {{--        <button type="submit">Register</button>--}}
    {{--    </form>--}}

    {{--    <form action="{{ route('queue.create') }}" method="POST">--}}
    {{--        @csrf--}}
    {{--        <button type="submit">Get Number</button>--}}
    {{--    </form>--}}

    {{--    <form action="{{ route('queue.call') }}" method="POST">--}}
    {{--        @csrf--}}
    {{--        <button type="submit">Call Next</button>--}}
    {{--    </form>--}}


</body>
</html>

<style>
    body {
        background-color: #c3cedd;
        font-family: Montserrat;
    }

    .ochered {
        display: flex;
        justify-content: space-between;
    }

    h1 {
        margin-top: 50px;
        text-align: center;
        font-size: 55px;
        font-weight: bold;
    }

    h2 {
        margin: 35px 0;
        text-align: center;
    }

    ul {
        list-style-type: none;
        box-shadow: -9px 0px 33px -17px black;
        border-radius: 15px;
        padding: 10px 0;
        background-color: #dee7fd;
        margin-bottom: 35px;
        text-align: center;
    }

    ul li {
        font-size: 26px;
        margin: 0 10px 10px;
    }

    li:last-child {
        margin-bottom: 0;
    }
    span {
        color: #9c5252;
    }

    hr {
        width: 1px;
        height: 650px;
        background-color: black;
        right: 50%;
        position: absolute;
        z-index: 10;
    }
</style>

<script src="{{ mix('resources/js/app.js') }}"></script>
<script type="module">
    console.log("123");
    Echo.channel('queue-updates')
        .listen('QueueUpdated', (e) => {
            updateQueueTable(e.queues);
            updateDailyQueueTable(e.dailyQueues);
        });

    function updateQueueTable(queues) {
        let tableBody = $('#queue-table body');
        tableBody.empty();

        queues.forEach(queue => {
            tableBody.append(`
                <ul class="col-6">
                <li>Талон:{{ $queue->number }}</li>
                <li>Статус: <span>{{ $queue->status }}</span></li>
                </ul>
            `);
        });
    }

    function updateDailyQueueTable(dailyQueues) {
        let tableBody = $('#daily-queue-table tbody');
        tableBody.empty();

        dailyQueues.forEach(dailyQueue => {
            tableBody.append(`

`);
        });
    }
</script>
