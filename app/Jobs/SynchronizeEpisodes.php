<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SynchronizeEpisodes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $movie = $this->movie;
        $slug = $movie->slug;
        $movieData = Http::get("https://ophim1.com/phim/" . $slug)->json();
    
        if (empty($movieData['episodes'])) {
            return;
        }
    
        foreach ($movieData['episodes'] as $episodeData) {
            foreach ($episodeData['server_data'] as $serverData) {
                $episodeName = $serverData['name'];
    
                // Check if the episode already exists for this movie
                if (!$this->episodeExists($movie->id, $episodeName)) {
                    $episode = new Episode();
                    $episode->movie_id = $movie->id;
                    $linkEmbed = '<p><iframe allowfullscreen frameborder="0" height="360" scrolling="0" src="' . $serverData['link_embed'] . '" width="100%"></iframe></p>';
                    $episode->linkphim = $linkEmbed;
                    $episode->episode = $episodeName;
                    $linkmovie = LinkMovie::orderBy('id', 'desc')->first();
                    $episode->server = $linkmovie->id;
                    $episode->created_at = now('Asia/Ho_Chi_Minh');
                    $episode->save();
                    $episode->update(['updated_at' => now('Asia/Ho_Chi_Minh')]);
                }
            }
        }
    }
    
}
