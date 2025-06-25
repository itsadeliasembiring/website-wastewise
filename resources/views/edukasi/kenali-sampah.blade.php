<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise Bot - Edukasi Sampah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        #chatbox::-webkit-scrollbar { width: 8px; }
        #chatbox::-webkit-scrollbar-track { background: #f9fafb; }
        #chatbox::-webkit-scrollbar-thumb { background: #a8a8a8; border-radius: 10px; }
        #chatbox::-webkit-scrollbar-thumb:hover { background: #888; }
        html, body { height: 100%; overflow: hidden; }
        .mic-recording { color: #ef4444; animation: pulse 1.5s infinite; }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans flex flex-col h-screen">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <x-header.pengguna/>
    </header>
    
    <div class="bg-[#3D8D7A] text-white shadow-md z-10 flex justify-center items-center text-center h-20">
        <div>
            <h1 class="text-xl font-bold">WasteWise Bot</h1>
            <p class="text-sm text-white">Tanya Jawab Seputar Sampah & Lingkungan</p>
        </div>
    </div>

    <main class="flex-1 flex flex-col bg-gray-100 overflow-hidden">
        <div id="chatbox" class="flex-1 p-6 overflow-y-auto"></div>
        
        <div id="suggestion-chips" class="px-4 pb-2 bg-white"></div>

        <div id="image-preview-container" class="px-6 pt-2 text-center hidden">
            <div class="relative inline-block">
                <img id="image-preview" class="h-24 w-24 object-cover rounded-lg shadow-md" />
                <button id="remove-image-btn" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs font-bold hover:bg-red-600 transition-transform transform hover:scale-110">X</button>
            </div>
        </div>
        
        <div class="p-4 bg-white border-t border-gray-200">
            <div class="flex items-center space-x-3">
                <button id="upload-image-btn" class="p-2 text-gray-500 hover:text-[#3D8D7A] transition-colors" title="Unggah gambar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm14.243 4.828l-4.586 4.586a2 2 0 0 1-2.828 0l-1.414-1.414a1 1 0 0 0-1.414 0L4 16h16l-3.757-3.757a1 1 0 0 0-1.414 0zM8 9a1 1 0 1 0 0 2a1 1 0 0 0 0-2z"/></svg>
                </button>
                <input type="file" id="image-input" accept="image/*" class="hidden">

                <button id="mic-btn" class="p-2 text-gray-500 hover:text-[#3D8D7A] transition-colors" title="Klik untuk mulai/berhenti merekam suara">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M12 14a3 3 0 0 0 3-3V5a3 3 0 0 0-6 0v6a3 3 0 0 0 3 3zm5.4-3a5.4 5.4 0 0 1-10.8 0H5a7 7 0 0 0 6 6.92V21h2v-3.08A7 7 0 0 0 19 11h-1.6z"/></svg>
                </button>
                
                <input type="text" id="chat-input" placeholder="Tulis pertanyaan atau rekam suara..." class="flex-1 w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#3D8D7A] transition duration-200">
                
                <button id="send-button" class="bg-[#3D8D7A] text-white p-3 rounded-full hover:bg-[#3D8D7A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3D8D7A] transition-transform transform hover:scale-105 duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </div>
        </div>
    </main>

<script>
    // --- Referensi Elemen DOM ---
    const sendButton = document.getElementById('send-button');
    const chatInput = document.getElementById('chat-input');
    const chatbox = document.getElementById('chatbox');
    const uploadImageBtn = document.getElementById('upload-image-btn');
    const suggestionChipsContainer = document.getElementById('suggestion-chips'); 
    const imageInput = document.getElementById('image-input');
    const imagePreviewContainer = document.getElementById('image-preview-container');
    const imagePreview = document.getElementById('image-preview');
    const removeImageBtn = document.getElementById('remove-image-btn');
    const micBtn = document.getElementById('mic-btn');

    // --- State Management ---
    let selectedImageFile = null;
    let recognition;
    let isListening = false;
    const mascotUrl = "{{ asset('Assets/maskot.gif') }}"; // Simpan URL maskot untuk digunakan kembali

    // --- Inisialisasi Speech Recognition ---
    function initSpeechRecognition() {
        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            recognition = new SpeechRecognition();
            
            recognition.continuous = true;
            recognition.interimResults = true;
            recognition.lang = 'id-ID';
            
            recognition.onstart = () => {
                isListening = true;
                micBtn.classList.add('mic-recording');
                chatInput.placeholder = "Sedang mendengarkan...";
                chatInput.value = "";
            };
            
            recognition.onresult = (event) => {
                let interimTranscript = '';
                let finalTranscript = '';
                for (let i = event.resultIndex; i < event.results.length; i++) {
                    const transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        finalTranscript += transcript;
                    } else {
                        interimTranscript += transcript;
                    }
                }
                chatInput.value = finalTranscript + interimTranscript;
            };
            
            recognition.onerror = (event) => {
                console.error('Speech recognition error:', event.error);
                stopListening();
                let errorMessage = 'Terjadi kesalahan pada pengenalan suara.';
                switch(event.error) {
                    case 'no-speech': errorMessage = 'Tidak ada suara yang terdeteksi. Silakan coba lagi.'; break;
                    case 'audio-capture': errorMessage = 'Tidak dapat mengakses mikrofon. Mohon periksa izin mikrofon pada browser Anda.'; break;
                    case 'not-allowed': errorMessage = 'Akses mikrofon ditolak. Mohon berikan izin untuk menggunakan fitur suara.'; break;
                    case 'network': errorMessage = 'Masalah jaringan terdeteksi. Mohon periksa koneksi internet Anda.'; break;
                }
                appendMessage('bot', `❌ ${errorMessage}`);
            };
            
            recognition.onend = () => {
                stopListening();
                if (chatInput.value.trim()) {
                    sendMessage(chatInput.value.trim());
                }
            };
            
            return true;
        } else {
            console.warn('Speech recognition not supported in this browser.');
            return false;
        }
    }

    function startListening() {
        if (recognition && !isListening) {
            try {
                recognition.start();
            } catch (error) {
                console.error('Error starting recognition:', error);
                appendMessage('bot', '❌ Gagal memulai pengenalan suara. Coba segarkan halaman ini.');
            }
        }
    }

    function stopListening() {
        if (recognition && isListening) {
            recognition.stop();
        }
        isListening = false;
        micBtn.classList.remove('mic-recording');
        chatInput.placeholder = "Tulis pertanyaan atau rekam suara...";
    }

    // --- FUNGSI-FUNGSI CHAT ---
    const sendMessage = async (messageText) => {
        const message = (typeof messageText === 'string' ? messageText : chatInput.value).trim();
        if (message === '' && !selectedImageFile) return;

        appendMessage('user', message, selectedImageFile);
        chatInput.value = '';
        suggestionChipsContainer.innerHTML = '';
        const imageToSend = selectedImageFile;
        removeImagePreview();
        appendTypingIndicator();

        const formData = new FormData();
        formData.append('message', message);
        if (imageToSend) {
            formData.append('image', imageToSend, imageToSend.name);
        }

        try {
            const botResponse = await getGeminiResponse(formData); 
            removeTypingIndicator();
            appendMessage('bot', botResponse.text, null, botResponse.suggestions);
        } catch (error) {
            removeTypingIndicator();
            appendMessage('bot', `Maaf, sepertinya ada sedikit gangguan di pihak saya. Coba beberapa saat lagi ya. (${error.message})`);
            console.error("Error:", error);
        }
    };

    function appendMessage(sender, message, imageFile = null, suggestions = []) {
        const messageWrapper = document.createElement('div');
        messageWrapper.classList.add('mb-6', 'flex', 'items-end', 'gap-3');
        
        let imageHTML = '';
        if (imageFile) {
            const imageURL = URL.createObjectURL(imageFile);
            imageHTML = `<img src="${imageURL}" class="max-w-xs w-full rounded-md mt-2 cursor-pointer" alt="User Upload" onclick="window.open('${imageURL}')">`;
        }

        const messageBubble = document.createElement('div');
        messageBubble.classList.add('max-w-lg', 'break-words');

        if (sender === 'user') {
            messageWrapper.classList.add('justify-end');
            
            // User Message Bubble
            messageBubble.classList.add('bg-[#3D8D7A]', 'text-white', 'p-3', 'rounded-xl', 'rounded-br-none', 'shadow');
            if (message) messageBubble.innerHTML += `<p>${message}</p>`;
            if (imageHTML) messageBubble.innerHTML += imageHTML;
            
            // User Avatar
            const avatar = document.createElement('div');
            avatar.classList.add('w-10', 'h-10', 'rounded-full', 'bg-gray-300', 'flex', 'items-center', 'justify-center', 'flex-shrink-0');
            avatar.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>`;
            
            messageWrapper.appendChild(messageBubble);
            messageWrapper.appendChild(avatar);

        } else { // Bot message
            messageWrapper.classList.add('justify-start');

            // Bot Avatar
            const avatar = document.createElement('div');
            avatar.classList.add('w-20', 'h-20', 'rounded-full', 'overflow-hidden', 'flex-shrink-0', 'bg-white');
            avatar.innerHTML = `<img src="${mascotUrl}" alt="Bot Avatar" class="w-full h-full object-cover">`;

            // Bot Message Bubble
            // Menggunakan innerHTML agar bisa merender <br> dari \n
            messageBubble.classList.add('bg-white', 'text-gray-800', 'p-3', 'rounded-xl', 'rounded-bl-none', 'shadow');
            messageBubble.innerHTML = message.replace(/\n/g, '<br>');

            messageWrapper.appendChild(avatar);
            messageWrapper.appendChild(messageBubble);
        }
        
        chatbox.appendChild(messageWrapper);
        
        if (suggestions && suggestions.length > 0) {
            addSuggestionChips(suggestions);
        }
        chatbox.scrollTop = chatbox.scrollHeight;
    }
    
    // --- Image Handling ---
    uploadImageBtn.addEventListener('click', () => imageInput.click());
    imageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            selectedImageFile = file;
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreviewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
    
    function removeImagePreview() {
        selectedImageFile = null;
        imageInput.value = '';
        imagePreviewContainer.classList.add('hidden');
    }
    removeImageBtn.addEventListener('click', removeImagePreview);

    // --- Voice Handling (Speech-to-Text) ---
    micBtn.addEventListener('click', () => {
        if (!isListening) {
            startListening();
        } else {
            stopListening();
        }
    });

    // --- Koneksi ke Backend ---
    async function getGeminiResponse(formData) {
        try {
            const serverUrl = 'http://127.0.0.1:8000/chat';

            const response = await fetch(serverUrl, {
                method: 'POST',
                headers: { 'Accept': 'application/json' },
                body: formData 
            });

            if (!response.ok) {
                const errorData = await response.json().catch(() => ({ error: `HTTP error! status: ${response.status}` }));
                throw new Error(errorData.error || `HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            return { text: data.reply, suggestions: data.suggestions || [] }; // Pastikan backend bisa mengirim suggestions
        } catch (error) {
            console.error("Tidak dapat terhubung ke server:", error);
            throw error;
        }
    }
    
    // --- Event listeners ---
    sendButton.addEventListener('click', () => sendMessage());
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
    
    // --- Inisialisasi ---
    window.onload = () => {
        const speechSupported = initSpeechRecognition();
        let welcomeMessage = "Halo! Aku WasteWise Bot. Aku siap membantumu mengenali berbagai jenis sampah dan cara memanfaatkannya dengan bijak. Yuk, mulai jelajahi dunia daur ulang bersamaku!\n\nKirimkan teks, gambar sampah, atau gunakan tombol mikrofon untuk berbicara.";
        
        if (!speechSupported) {
            micBtn.style.display = 'none';
            welcomeMessage = "Halo! Aku WasteWise Bot. Aku siap membantumu mengenali berbagai jenis sampah dan cara memanfaatkannya dengan bijak.\n\nKamu bisa mulai dengan mengirim teks atau gambar sampah kepadaku.\n\n⚠️ *Fitur input suara tidak didukung di browser ini.*";
        }
        
        appendMessage('bot', welcomeMessage);
    };

    function addSuggestionChips(suggestions) {
        suggestionChipsContainer.innerHTML = '';
        const container = document.createElement('div');
        container.className = 'flex flex-wrap gap-2 justify-center py-2';

        suggestions.forEach(suggestion => {
            const button = document.createElement('button');
            button.className = 'bg-teal-100 text-teal-800 px-4 py-2 rounded-full text-sm hover:bg-teal-200 transition duration-200 shadow-sm';
            button.textContent = suggestion;
            button.onclick = () => {
                sendMessage(suggestion);
            };
            container.appendChild(button);
        });
        suggestionChipsContainer.appendChild(container);
    }

    function appendTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.id = 'typing-indicator';
        typingDiv.className = 'mb-6 flex items-end justify-start gap-3';
        typingDiv.innerHTML = `
            <div class="w-20 h-20 rounded-full overflow-hidden flex-shrink-0 bg-white">
                <img src="${mascotUrl}" alt="Bot Avatar" class="w-full h-full object-cover">
            </div>
            <div class="bg-white text-gray-800 p-3 rounded-xl rounded-bl-none shadow">
                <div class="flex items-center space-x-1.5">
                    <span class="w-2.5 h-2.5 bg-gray-400 rounded-full animate-bounce"></span>
                    <span class="w-2.5 h-2.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></span>
                    <span class="w-2.5 h-2.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s;"></span>
                </div>
            </div>
        `;
        chatbox.appendChild(typingDiv);
        chatbox.scrollTop = chatbox.scrollHeight;
    }

    function removeTypingIndicator() {
        const indicator = document.getElementById('typing-indicator');
        if (indicator) {
            indicator.remove();
        }
    }
</script>

</body>
</html>