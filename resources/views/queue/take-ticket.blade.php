<!DOCTYPE html>
<html>
<head>
    <title>Take Ticket</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">

    <button type="button" class="btn btn-primary" id="talon" data-toggle="modal" data-target="#takeTicketModal">
        Взять талончик
    </button>
    <!-- Modal -->
    <div class="modal fade" id="takeTicketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Введите номер телефона</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form id="takeTicketForm" method="POST" action="{{ route('queue.take-ticket.post') }}">
                        @csrf
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary mt-5" id="talon" data-toggle="modal" data-target="#takeTicketModalforLate">
        Записаться
    </button>
    <!-- Modal -->
    <div class="modal fade" id="takeTicketModalforLate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Введите номер телефона и выберите дату</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dailyQueueForm" method="POST" action="{{ route('daily.queue.post') }}">
                        @csrf
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Выберите дату</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</body>
</html>

<style>
    .container{
        height: 900px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }
    #talon {
        height: 200px;
        width: 600px;
        font-size: 50px;
        background-color: #718096;
        border: none;
    }
    #talon:hover {
        background-color: #1a202c;
    }
</style>
