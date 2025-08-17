<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini; // Fasad utama
use Gemini\Data\Content; // WAJIB: Usaremos os factories desta classe
use Gemini\Data\Blob; // WAJIB: Untuk handle file uploads
use Gemini\Enums\MimeType; // OPSIONAL: Untuk MIME type constants
use Illuminate\Support\Facades\Log;

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

            $client = Gemini::client($apiKey);

            $systemPrompt = "Kamu adalah WasteWise Bot, asisten AI ahli yang berspesialisasi dalam pengelolaan sampah dan isu lingkungan. Tugas utamamu adalah memberikan informasi yang akurat dan edukatif.
            JAWAB HANYA pertanyaan yang berkaitan dengan topik berikut: klasifikasi sampah (organik, anorganik, B3), proses daur ulang, 3R (Reduce, Reuse, Recycle), pembuatan kompos, polusi (tanah, air, udara), ecobrick, bank sampah, dampak perubahan iklim terhadap sampah, dan topik lingkungan terkait.
            JANGAN PERNAH menjawab pertanyaan di luar topik ini (misalnya tentang politik, selebriti, sejarah, matematika, atau permintaan kreatif lainnya).
            Jika pengguna bertanya di luar topik, kamu HARUS menolak dengan sopan. Contoh penolakan: 'Maaf, saya adalah WasteWise Bot. Saya hanya bisa menjawab pertanyaan seputar sampah dan lingkungan. Ada yang bisa saya bantu terkait topik tersebut?'";

            $userMessage = $request->input('message', '');
            $userParts = [];

            if ($request->hasFile('image') && empty($userMessage)) {
                $userMessage = 'Jelaskan tentang sampah pada gambar ini dan bagaimana cara mengelolanya.';
            }

            // ALTERNATIF SEDERHANA: Tambahkan system prompt langsung ke user message
            // Ini menghindari masalah dengan Content object untuk system instruction
            $fullPrompt = $systemPrompt . "\n\n" . (!empty($userMessage) ? "User: " . $userMessage : "User mengirim media tanpa teks.");
            
            // Reset userParts dan mulai dengan prompt lengkap
            $userParts = [$fullPrompt];
            
            // Tambahkan media files jika ada
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

            if ($request->hasFile('audio')) {
                $audioFile = $request->file('audio');
                $mimeType = $this->convertMimeTypeToEnum($audioFile->getMimeType());
                
                if ($mimeType) {
                    $userParts[] = new Blob(
                        mimeType: $mimeType,
                        data: base64_encode(file_get_contents($audioFile->getRealPath()))
                    );
                }
            }

            $model = $client->generativeModel('gemini-1.5-flash');

            // Metode generateContent dapat menerima campuran string dan objek Content
            $result = $model->generateContent(...$userParts);

            return response()->json(['reply' => $result->text()]);

        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return response()->json([
                'error' => 'Maaf, terjadi kesalahan internal saat memproses permintaan Anda.',
                'exception_message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Convert string MIME type to Gemini MimeType enum
     */
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