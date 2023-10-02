<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MoviesNew extends Mailable
{
    use Queueable, SerializesModels;
    public $movies;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($movies)
    {
        $this->movies = $movies;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->subject('Mail thông báo về có phim mới đã cập nhật trên website của chúng tôi')
            ->view('email.movies_new')->with(['movies' => $this->movies]);
    }

}
