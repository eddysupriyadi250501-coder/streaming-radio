<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Streaming;

class VideoPlayer extends Component
{
    public function render()
    {
        $streamingData = Streaming::latest()->first();
        $liveId = null;
        $isAutoLive = false;

        if ($streamingData && !empty($streamingData->link_eksternal)) {
            $url = trim($streamingData->link_eksternal);

            if (str_contains($url, '/live')) {
                // Deteksi Live Streaming Channel (Format: /live)
                $isAutoLive = true;
                $channelHandle = strstr($url, '@');
                
                $liveId = $channelHandle ? str_replace('/live', '', $channelHandle) : 'active';
            } else {
                // Deteksi Video Biasa (watch?v= atau youtu.be/)
                $isAutoLive = false;
                $queryString = parse_url($url, PHP_URL_QUERY);
                
                if ($queryString) {
                    parse_str($queryString, $queryParams);
                    $liveId = $queryParams['v'] ?? null;
                }

                if (!$liveId) {
                    $liveId = trim(parse_url($url, PHP_URL_PATH), '/');
                }
            }
        }

        return view('livewire.video-player', compact('streamingData', 'liveId', 'isAutoLive'));
    }
}