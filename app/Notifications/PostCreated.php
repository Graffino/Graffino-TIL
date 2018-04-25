<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Auth;
use App\Developer;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use NotificationChannels\Twitter\TwitterChannel;
use NotificationChannels\Twitter\TwitterStatusUpdate;
use App\Helpers\ApplicationHelper;

class PostCreated extends Notification
{
    use Queueable;

    private $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return [TwitterChannel::class, 'slack',];
        return [];
    }

    /**
     * Get the slack representation of the notification.
     *
     *s.param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
      $post = $this->post;

      return (new SlackMessage)
        ->success()
        ->content('A new post has been created')
        ->attachment(function ($attachment) use ($post) {
          $attachment
            ->title($post->title, 'http://localhost:8000')
            ->content('Go see what\'s up');
        });
    }

    public function toTwitter($notifiable)
    {
      $canonicalUrl = ApplicationHelper::canonicalUrl($this->post->slug);
      $developer = Developer::find(Auth::id());
      $tweet = $this->post->title.' '.$canonicalUrl.' via @'.Developer::twitterHandle($developer->id).' #til #'.$this->post->channel->twitter_hashtag;

      return new TwitterStatusUpdate($tweet);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
          'title' => $this->post->title,
          'author' => $this->post->author,
        ];
    }
}
