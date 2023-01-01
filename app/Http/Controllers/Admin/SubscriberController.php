<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function index()
    {
        return view('admin.subscribers.index');
    }

    public function download()
    {
        //  Code for generating csv file
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=subscribers.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Subscribers Emails']);
        $result = Subscriber::all();

        foreach ($result as $row) {
            fputcsv($output, $row->toArray());
        }
        fclose($output);
    }
}
