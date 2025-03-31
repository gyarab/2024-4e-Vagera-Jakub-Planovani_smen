<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Pusher\Pusher;
use Illuminate\Support\Facades\Config; // Use Config facade for clarity

class ListPusherChannels extends Command
{
    protected $signature = 'pusher:channels';
    protected $description = 'List active Pusher channels';

    public function handle()
    {
        try {
            $pusher = new Pusher(
                Config::get('broadcasting.connections.pusher.key'),
                Config::get('broadcasting.connections.pusher.secret'),
                Config::get('broadcasting.connections.pusher.app_id'),
                Config::get('broadcasting.connections.pusher.options')
            );

            $result = $pusher->get_channels();

            if (isset($result->channels) && is_array($result->channels)) {
                $this->info('Active Channels:');
                foreach ($result->channels as $channel => $info) {
                    $this->line(" - {$channel}");
                }
            } else {
                $this->info('No active channels found.');
            }
        } catch (\Pusher\PusherException $e) {
            $this->error('Error fetching Pusher channels: ' . $e->getMessage());
        } catch (\Exception $e) {
            $this->error('An unexpected error occurred: ' . $e->getMessage());
        }

        // For detailed info about a specific channel:
        // $channelInfo = $pusher->get_channel_info('private-chatify.1');
        // $this->info(json_encode($channelInfo));
    }
}
