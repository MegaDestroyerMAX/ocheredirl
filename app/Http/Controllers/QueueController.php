<?php

namespace App\Http\Controllers;

use App\Models\DailyQueue;
use Illuminate\Http\Request;
use App\Models\Queue;
use App\Events\QueueUpdated;

class QueueController extends Controller
{
    public function index()
    {
        $queues = Queue::where('status', 'waiting')->orderBy('number')->get();
        return view('queue.index', compact('queues'));
    }

    public function create()
    {
        $lastQueue = Queue::orderBy('number', 'desc')->first();
        $number = $lastQueue ? $lastQueue->number + 1 : 1;
        $queue = Queue::create(['number' => $number]);

        return redirect()->route('queue.index');
    }

    public function call()
    {
        $queue = Queue::where('status', 'waiting')->orderBy('number')->first();
        if ($queue) {
            $queue->update(['status' => 'called']);
        }

        return redirect()->route('queue.index');
    }

    public function serve(Queue $queue)
    {
        $queue->update(['status' => 'served']);
        return redirect()->route('queue.index');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $lastQueue = Queue::orderBy('number', 'desc')->first();
        $number = $lastQueue ? $lastQueue->number + 1 : 1;
        Queue::create(['number' => $number, 'name' => $request->name]);

        return redirect()->route('queue.index');
    }

    public function showTakeTicketPage()
    {
        return view('queue.take-ticket');
    }

    public function takeTicket(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:15',
        ]);


        $lastQueue = Queue::orderBy('number', 'desc')->first();
        $number = $lastQueue ? $lastQueue->number + 1 : 1;
        Queue::create(['number' => $number, 'phone' => $request->phone]);
        $this->broadcastQueueUpdates();

        return redirect()->route('queue.take-ticket');
    }

    public function takeDailyTicket(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:15',
            'date' => 'required|date',
        ]);

        $lastQueue = DailyQueue::where('date', $request->date)->orderBy('number', 'desc')->first();
        $number = $lastQueue ? $lastQueue->number + 1 : 1;
        DailyQueue::create([
            'number' => $number,
            'phone' => $request->phone,
            'date' => $request->date
        ]);

        return redirect()->route('queue.index');
    }

    private function broadcastQueueUpdates()
    {
        $queues = Queue::all();
        $dailyQueues = DailyQueue::all();

        broadcast(new QueueUpdated($queues, $dailyQueues))->toOthers();
    }
}
