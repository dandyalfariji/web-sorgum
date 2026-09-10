# Spesifikasi & Arsitektur Sistem: Sorgummi AI (RAG Chatbot)

## 1. Ringkasan Sistem
Sorgummi AI adalah asisten virtual berbasis kecerdasan buatan yang bertindak sebagai pakar agronomi, pengolahan pangan, dan edukasi sorgum. Chatbot ini akan menggantikan atau ditambahkan pada elemen navigasi (navbar modal/widget chat) di portal web.

Sistem ini menggunakan arsitektur **RAG (Retrieval-Augmented Generation)**. Alih-alih hanya mengandalkan pengetahuan bawaan (pre-trained knowledge) dari LLM, AI akan "membaca" referensi dari kumpulan dokumen lokal terlebih dahulu sebelum menjawab. Hal ini bertujuan untuk memastikan jawaban sangat akurat, relevan, dan terhindar dari halusinasi, terutama untuk anjuran pertanian dan kesehatan.

## 2. Alur Kerja RAG (Retrieval-Augmented Generation)
1. **Penyiapan Dokumen (Ingestion Phase):**
   - Dokumen mentah (`.pdf`, `.txt`, `.md`) di folder `./data_sorgum_docs/` dibaca oleh sistem.
   - Teks dipecah menjadi bagian-bagian kecil (*Chunking*), dengan ukuran 600 karakter dan *overlap* 100 karakter agar konteks antarkalimat tidak terputus.
   - Potongan teks tersebut diubah menjadi vektor angka (Embedding) menggunakan model `sentence-transformers/all-MiniLM-L6-v2`.
   - Vektor-vektor ini disimpan ke dalam Vector Database **ChromaDB** secara lokal di direktori `./chroma_sorgum_db/`.

2. **Proses Tanya Jawab (Query Phase):**
   - **User Input:** Pengguna mengetikkan pertanyaan di antarmuka web.
   - **Embedding Pertanyaan:** Pertanyaan pengguna diubah menjadi vektor menggunakan model embedding yang sama.
   - **Retrieval:** Sistem mencari potongan teks di ChromaDB yang memiliki vektor paling mirip (relevan) dengan vektor pertanyaan pengguna.
   - **Prompting:** Potongan teks relevan (*Context*) digabungkan dengan pertanyaan pengguna dan **System Prompt** (Aturan main Sorgummi AI).
   - **Generation:** Gabungan *prompt* lengkap dikirimkan ke LLM (via 9router API Gateway) untuk menghasilkan jawaban akhir.
   - **Output:** Jawaban dikirim kembali ke pengguna di frontend.

## 3. Komponen & Teknologi yang Dibutuhkan
* **Frontend:**
  - UI/UX Chatbot (Modal/Widget) yang responsif.
  - Komunikasi AJAX/Fetch API untuk mengirim pesan ke backend tanpa *reload* halaman.
* **Backend Utama (Laravel):**
  - Menerima request dari frontend, melakukan validasi, lalu meneruskan request ke service AI.
* **Backend AI/RAG (Rekomendasi: Python Service):**
  - Mengelola *embedding* model dari HuggingFace (membutuhkan library Python seperti `sentence-transformers`).
  - Mengelola ChromaDB.
  - Menggunakan library orkestrasi seperti **LangChain** atau **LlamaIndex** untuk mengatur alur RAG.
  - Melakukan panggilan API ke gateway **9router** menggunakan kredensial (API Key, Model ID, param `temperature=0.2`, `max_tokens=1024`).

## 4. Aturan Perilaku AI (Guardrails)
* **Akurasi Faktual:** Selalu prioritaskan jawaban dari dokumen konteks (RAG).
* **Penanganan Jawaban Kosong:** Jika konteks dokumen tidak memuat informasi terkait, AI harus jujur menyatakan bahwa informasi spesifik tersebut belum ada di database lokal, baru kemudian menambahkan pengetahuan umumnya (dengan batasan).
* **Keamanan Medis & Pertanian:** Dilarang keras memberikan resep dosis kimia pertanian atau klaim pengobatan medis pasti tanpa menyarankan rujukan ke ahli terkait (penyuluh/medis).
