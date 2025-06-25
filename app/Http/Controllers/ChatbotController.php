<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini; // Make sure this facade is correctly set up
use Gemini\Client; // Import the actual client
use Gemini\Data\Content;
use Gemini\Data\Blob;
use Gemini\Enums\MimeType;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client as GuzzleClient;

class ChatbotController extends Controller
{
    public function handleChat(Request $request)
    {
        set_time_limit(0);

        $request->validate([
            'message' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'audio' => 'nullable|file|mimes:mpga,mp3,wav,webm,mp4,m4a,aac,flac|max:5120',
        ]);

        try {
            $apiKey = env('GEMINI_API_KEY');
            if (!$apiKey) {
                return response()->json(['error' => 'API Key Gemini tidak ditemukan.'], 500);
            }

            // Correctly instantiate Guzzle client with proxy
            // $httpClient = new GuzzleClient([
            //     'proxy' => 'socks5h://104.223.91.227:1080',
            //     'timeout' => 30, // Increased timeout for potentially slow proxy
            // ]);

            // Pass the configured Guzzle client to the Gemini client
            $client = Gemini::client($apiKey);

            $systemPrompt = "Kamu adalah WasteWise Bot, ..."; // Your system prompt remains the same

            $userMessage = $request->input('message', '');
            $userParts = [];

            if ($request->hasFile('image') && empty($userMessage)) {
                $userMessage = 'Jelaskan tentang sampah pada gambar ini dan bagaimana cara mengelolanya.';
            }

            $fullPrompt = $systemPrompt . "\n\n" . (!empty($userMessage) ? "User: " . $userMessage : "User mengirim media tanpa teks.");
            $userParts = [$fullPrompt];

            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $mimeType = $this->convertMimeTypeToEnum($imageFile->getMimeType());
                if ($mimeType) {
                    $userParts[] = new Blob(
                        mimeType: $mimeType,
                        data: base64_encode(file_get_contents($imageFile->getRealPath()))
                    );
                }
            }

            // Add audio file handling if needed (code was present in original)

            // Use the 'gemini-1.5-flash' model with the instantiated client
            $result = $client->gemini1_5Flash()->generateContent(...$userParts);

            return response()->json(['reply' => $result->text()]);

        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return response()->json([
                'error' => 'Maaf, terjadi kesalahan internal saat memproses permintaan Anda.',
                'exception_message' => $e->getMessage(),
            ], 500);
        }
    }

    private function convertMimeTypeToEnum(string $mimeType): ?MimeType
    {
        return match ($mimeType) {
            // Image types
            'image/jpeg' => MimeType::IMAGE_JPEG,
            'image/png' => MimeType::IMAGE_PNG,
            'image/gif' => MimeType::IMAGE_GIF,
            'image/webp' => MimeType::IMAGE_WEBP,
            
            // Audio types
            'audio/mpeg' => MimeType::AUDIO_MPEG,
            'audio/mp3' => MimeType::AUDIO_MP3,
            'audio/wav' => MimeType::AUDIO_WAV,
            'audio/webm' => MimeType::AUDIO_WEBM,
            'audio/mp4' => MimeType::AUDIO_MP4,
            'audio/m4a' => MimeType::AUDIO_M4A,
            'audio/aac' => MimeType::AUDIO_AAC,
            'audio/flac' => MimeType::AUDIO_FLAC,
            'audio/mpga' => MimeType::AUDIO_MPEG, // mpga is usually MPEG audio
            
            default => null,
        };
    }
}