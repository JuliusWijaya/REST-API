<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\InvoicePaid;


class HomeController extends Controller
{
    public function send()
    {
        $user = User::find(4);
        
        $project = [
            'greeting' => 'Hi ' .$user->username.'',
            'body' => 'This is the project assigned to you.',
            'thanks' => 'Thank you this is from codeanddeploy.com',
            'actionText' => 'View Project',
            'actionURL' => url('/home'),
            'id' => 57,
        ];

        $user->notify(new InvoicePaid($project));

        return 'Notification successfully sent! ' . $user['username'];
    }
}
