<div id="sorgummi-chat-widget" class="fixed bottom-6 right-6 z-50 font-sans">
    <!-- Chat Button -->
    <button id="sorgummi-toggle-btn" class="bg-[#F53003] hover:bg-[#d62700] text-white p-4 rounded-full shadow-lg transition-transform transform hover:scale-105 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <!-- Chat Window -->
    <div id="sorgummi-chat-window" class="hidden absolute bottom-16 right-0 w-80 bg-white dark:bg-[#161615] rounded-lg shadow-2xl border border-gray-200 dark:border-[#3E3E3A] overflow-hidden flex flex-col h-[400px]">
        <!-- Header -->
        <div class="bg-[#F53003] text-white px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-white text-[#F53003] rounded-full flex items-center justify-center font-bold text-lg">S</div>
                <h3 class="font-semibold text-sm">Sorgummi AI</h3>
            </div>
            <button id="sorgummi-close-btn" class="text-white hover:text-gray-200 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <!-- Chat Area -->
        <div id="sorgummi-messages" class="flex-1 overflow-y-auto p-4 flex flex-col gap-3 bg-gray-50 dark:bg-[#0a0a0a] text-sm">
            <div class="flex flex-col gap-1 items-start">
                <div class="bg-gray-200 dark:bg-[#3E3E3A] text-gray-800 dark:text-gray-200 px-3 py-2 rounded-lg rounded-tl-none max-w-[85%]">
                    Halo! Saya Sorgummi, asisten AI Anda. Ada yang bisa saya bantu tentang sorgum?
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-3 bg-white dark:bg-[#161615] border-t border-gray-200 dark:border-[#3E3E3A]">
            <form id="sorgummi-form" class="flex gap-2">
                <input type="text" id="sorgummi-input" placeholder="Tanya sesuatu..." class="flex-1 px-3 py-2 border border-gray-300 dark:border-[#3E3E3A] rounded-full focus:outline-none focus:border-[#F53003] dark:bg-gray-800 dark:text-white text-sm" required>
                <button type="submit" class="bg-[#F53003] hover:bg-[#d62700] text-white w-9 h-9 rounded-full flex items-center justify-center transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform rotate-90" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('sorgummi-toggle-btn');
    const closeBtn = document.getElementById('sorgummi-close-btn');
    const chatWindow = document.getElementById('sorgummi-chat-window');
    const form = document.getElementById('sorgummi-form');
    const input = document.getElementById('sorgummi-input');
    const messagesBox = document.getElementById('sorgummi-messages');

    // Toggle chat window
    toggleBtn.addEventListener('click', () => {
        chatWindow.classList.toggle('hidden');
        if (!chatWindow.classList.contains('hidden')) {
            input.focus();
        }
    });

    closeBtn.addEventListener('click', () => {
        chatWindow.classList.add('hidden');
    });

    // Helper to append message
    function appendMessage(sender, text) {
        const msgDiv = document.createElement('div');
        msgDiv.className = sender === 'user' 
            ? 'flex flex-col gap-1 items-end' 
            : 'flex flex-col gap-1 items-start';

        const bubble = document.createElement('div');
        bubble.className = sender === 'user'
            ? 'bg-[#F53003] text-white px-3 py-2 rounded-lg rounded-tr-none max-w-[85%]'
            : 'bg-gray-200 dark:bg-[#3E3E3A] text-gray-800 dark:text-gray-200 px-3 py-2 rounded-lg rounded-tl-none max-w-[85%]';
        
        // Handle basic markdown/line breaks if needed
        bubble.innerHTML = text.replace(/\n/g, '<br>');
        
        msgDiv.appendChild(bubble);
        messagesBox.appendChild(msgDiv);
        
        // Scroll to bottom
        messagesBox.scrollTop = messagesBox.scrollHeight;
    }

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const message = input.value.trim();
        if (!message) return;

        // Show user message
        appendMessage('user', message);
        input.value = '';
        input.disabled = true;

        // Show loading indicator
        const loadingId = 'loading-' + Date.now();
        const loadingDiv = document.createElement('div');
        loadingDiv.id = loadingId;
        loadingDiv.className = 'flex flex-col gap-1 items-start';
        loadingDiv.innerHTML = `<div class="bg-gray-200 dark:bg-[#3E3E3A] text-gray-500 dark:text-gray-400 px-3 py-2 rounded-lg rounded-tl-none flex gap-1">
            <span class="animate-bounce">.</span><span class="animate-bounce" style="animation-delay: 0.2s">.</span><span class="animate-bounce" style="animation-delay: 0.4s">.</span>
        </div>`;
        messagesBox.appendChild(loadingDiv);
        messagesBox.scrollTop = messagesBox.scrollHeight;

        try {
            const response = await fetch('{{ route("sorgummi.chat") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            
            // Remove loading
            document.getElementById(loadingId)?.remove();

            if (data.reply) {
                appendMessage('bot', data.reply);
            } else {
                appendMessage('bot', 'Maaf, terjadi kesalahan.');
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById(loadingId)?.remove();
            appendMessage('bot', 'Maaf, tidak dapat terhubung ke server.');
        } finally {
            input.disabled = false;
            input.focus();
        }
    });
});
</script>
