<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1>Admin Panel</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Живая очередь</h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Номер</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Статус</th>
            <th>Дата создания</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($queues as $queue)
            <tr>
                <td>{{ $queue->id }}</td>
                <td>{{ $queue->number }}</td>
                <td>{{ $queue->name }}</td>
                <td>{{ $queue->phone }}</td>
                <td>{{ $queue->status }}</td>
                <td>{{ $queue->created_at }}</td>
                <td>
                    <form action="{{ route('admin.panel.queue.delete', $queue->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>Запись</h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Номер</th>
            <th>Телефон</th>
            <th>Дата записи</th>
            <th>Дата создания</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dailyQueues as $dailyQueue)
            <tr>
                <td>{{ $dailyQueue->id }}</td>
                <td>{{ $dailyQueue->number }}</td>
                <td>{{ $dailyQueue->phone }}</td>
                <td>{{ $dailyQueue->date }}</td>
                <td>{{ $dailyQueue->created_at }}</td>
                <td>
                    <form action="{{ route('admin.panel.daily-queue.delete', $dailyQueue->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                    <form action="{{ route('admin.panel.daily-queue.edit', $dailyQueue->id) }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-primary" id="talon" data-toggle="modal" data-target="#editQueue">Редактировать</button>
                    </form>
                        <div class="modal fade" id="editQueue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Введите номер телефона и выберите дату</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="dailyQueueForm" method="POST" action="{{ route('admin.panel.daily-queue.update', $dailyQueue->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="date">Выберите дату</label>
                                                <input type="date" class="form-control" id="date" name="date" value="{{ $dailyQueue->date }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
