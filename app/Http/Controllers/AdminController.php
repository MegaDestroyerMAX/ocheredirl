<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use App\Models\DailyQueue;
use App\Events\QueueUpdated;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Закрываем доступ к админке для неавторизованных пользователей
    }

    public function index()
    {
        $queues = Queue::all();
        $dailyQueues = DailyQueue::all();
        return view('admin.admin', compact('queues', 'dailyQueues'));
    }

    public function destroyQueue($id)
    {
        $queue = Queue::findOrFail($id);
        $queue->delete();

        return redirect()->route('admin.panel')->with('success', 'Запись успешно удалена.');
    }

    public function destroyDailyQueue($id)
    {
        $dailyQueue = DailyQueue::findOrFail($id);
        $dailyQueue->delete();

        return redirect()->route('admin.panel')->with('success', 'Запись успешно удалена.');
    }

    public function editDailyQueue($id)
    {
        $dailyQueue = DailyQueue::findOrFail($id);
        return view('admin.edit-daily-queue', compact('dailyQueue'));
    }

    public function updateDailyQueue(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $dailyQueue = DailyQueue::findOrFail($id);
        $dailyQueue->update([
            'date' => $request->date,
        ]);

        return redirect()->route('admin.panel')->with('success', 'Дата записи успешно обновлена.');
    }
}
