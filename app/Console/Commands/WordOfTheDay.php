<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Company;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class WordOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a word and its meaning';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $words = [
            'aberration' => 'a state or condition markedly different from the norm',
            'convivial' => 'occupied with or fond of the pleasures of good company',
            'diaphanous' => 'so thin as to transmit light',
            'elegy' => 'a mournful poem; a lament for the dead',
            'ostensible' => 'appearing as such but not necessarily so'
        ];
 
        // Finding a random word
        $key = array_rand($words);
        $value = $words[$key];
 
        $users = User::all();
        $companies = Company::all();
        dd($companies);
        foreach ($users as $user) {
            Mail::to($user->email)->send(new ContactFormMail($user));
        }
 
        $this->info('Word of the Day sent to All Users');
    }
}
