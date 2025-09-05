@extends('layouts.app')

@section('breadcrumb', 'Quiz')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-yellow-50 to-amber-50 cultural-pattern">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-amerta-dark mb-4">
                    Koleksi Quiz Budaya Nusantara
                </h2>
                <p class="text-amerta-primary text-lg mb-6">Jelajahi dan perkaya pengetahuan budaya Indonesia</p>

                <!-- Add New Quiz Button -->
                <button onclick="openAddQuizModal()"
                    class="bg-gradient-to-r from-amerta-primary to-amerta-secondary hover:from-amerta-dark hover:to-amerta-primary text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Quiz Baru
                </button>
            </div>

            <!-- Success/Error Alerts -->
            @if (session('success'))
                <div class="mb-8 max-w-2xl mx-auto">
                    <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-green-800 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-8 max-w-2xl mx-auto">
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <ul class="text-red-800 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li class="font-medium">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quiz Cards Grid -->
            <div class="grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($quizzes as $quiz)
                    <div class="group">
                        <!-- Main Quiz Card -->
                        <div
                            class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border-2 border-amerta-accent/20 hover:border-amerta-secondary/40">
                            <!-- Card Header -->
                            <div
                                class="bg-gradient-to-r from-amerta-primary to-amerta-secondary p-6 text-white relative overflow-hidden">
                                <div class="absolute inset-0 bg-black/10 cultural-pattern"></div>
                                <div class="relative z-10">
                                    <div class="flex items-center justify-between mb-2">
                                        <span
                                            class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 text-xs font-medium">
                                            Quiz Budaya
                                        </span>
                                        <span class="text-white/90 text-sm font-medium">{{ $quiz->questions->count() }}
                                            soal</span>
                                    </div>
                                    <h3 class="text-xl font-bold mb-2 leading-tight">{{ $quiz->title }}</h3>
                                    <p class="text-white/90 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $quiz->creator->name ?? 'Unknown' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-6">
                                <!-- Questions Summary -->
                                @if ($quiz->questions->count())
                                    <div class="mb-6">
                                        <h4 class="text-amerta-dark font-semibold mb-3 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-amerta-secondary" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Ringkasan Soal
                                        </h4>

                                        <div class="space-y-2">
                                            @foreach ($quiz->questions->take(3) as $index => $question)
                                                <div
                                                    class="bg-amerta-accent/10 rounded-lg p-3 border border-amerta-accent/20">
                                                    <div class="flex items-center justify-between">
                                                        <span
                                                            class="bg-amerta-accent text-amerta-dark text-xs font-semibold px-2 py-1 rounded-full">
                                                            Soal {{ $index + 1 }}
                                                        </span>
                                                    </div>
                                                    <p class="text-amerta-dark text-sm mt-2 line-clamp-2">
                                                        {{ Str::limit($question->question_text, 80) }}
                                                    </p>
                                                </div>
                                            @endforeach

                                            @if ($quiz->questions->count() > 3)
                                                <div class="text-center text-amerta-secondary text-sm font-medium">
                                                    +{{ $quiz->questions->count() - 3 }} soal lainnya
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-6">
                                        <svg class="w-16 h-16 mx-auto text-amerta-accent mb-3" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-amerta-primary font-medium mb-1">Belum ada soal</p>
                                        <p class="text-amerta-secondary text-sm">Tambahkan soal pertama untuk quiz ini</p>
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex gap-3">
                                    @if ($quiz->questions->count())
                                        <button onclick="openQuestionModal({{ $quiz->id }})"
                                            class="flex-1 bg-amerta-accent hover:bg-amerta-secondary text-amerta-dark hover:text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 flex items-center justify-center shadow-md hover:shadow-lg">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat Detail
                                        </button>
                                    @endif

                                    <button onclick="openAddQuestionModal({{ $quiz->id }}, '{{ $quiz->content_id }}')"
                                        class="flex-1 bg-gradient-to-r from-amerta-primary to-amerta-secondary hover:from-amerta-dark hover:to-amerta-primary text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 flex items-center justify-center shadow-md hover:shadow-lg">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Tambah Soal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Question Preview Modal for each quiz -->
                    <div id="questionModal-{{ $quiz->id }}"
                        class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
                        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                            <!-- Modal Header -->
                            <div class="bg-gradient-to-r from-amerta-primary to-amerta-secondary p-6 text-white">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-2xl font-bold">{{ $quiz->title }}</h3>
                                        <p class="text-white/90 mt-1">{{ $quiz->questions->count() }} soal tersedia</p>
                                    </div>
                                    <button onclick="closeQuestionModal({{ $quiz->id }})"
                                        class="text-white/80 hover:text-white transition-colors">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Body -->
                            <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)] custom-scrollbar">
                                @if ($quiz->questions->count())
                                    <div class="space-y-6">
                                        @foreach ($quiz->questions as $index => $question)
                                            <div
                                                class="bg-gradient-to-r from-amerta-accent/10 to-transparent rounded-xl p-6 border-l-4 border-amerta-secondary shadow-sm">
                                                <div class="flex items-center justify-between mb-4">
                                                    <span
                                                        class="bg-amerta-secondary text-white text-sm font-bold px-3 py-1 rounded-full">
                                                        Soal {{ $index + 1 }}
                                                    </span>
                                                    <span class="text-amerta-primary text-xs font-medium">
                                                        {{ is_array($question->options) ? count($question->options) : 0 }}
                                                        pilihan jawaban
                                                    </span>
                                                </div>

                                                <h4 class="text-amerta-dark font-semibold text-lg mb-4 leading-relaxed">
                                                    {{ $question->question_text }}
                                                </h4>

                                                @php
                                                    // Normalize options jadi array (handle string JSON / null / already-array)
                                                    $options = $question->options;
                                                    if (is_string($options)) {
                                                        $options = json_decode($options, true) ?: [];
                                                    }
                                                    if (!is_array($options)) {
                                                        $options = [];
                                                    }

                                                    // normalisasi correct answer ke integer/string agar perbandingan konsisten
                                                    $correctIndex = (string) $question->correct_answer;
                                                @endphp

                                                @if (!empty($options))
                                                    <div class="grid gap-3">
                                                        @foreach ($options as $optionIndex => $option)
                                                            @php $isCorrect = ((string) $optionIndex === $correctIndex); @endphp
                                                            <div
                                                                class="flex items-center p-4 rounded-xl transition-all {{ $isCorrect ? 'bg-green-100 border-2 border-green-400 shadow-md' : 'bg-white border border-amerta-accent/30 hover:border-amerta-secondary/50' }}">
                                                                <span
                                                                    class="w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold mr-4 {{ $isCorrect ? 'bg-green-500 text-white' : 'bg-amerta-accent text-amerta-dark' }}">
                                                                    {{ chr(65 + $optionIndex) }}
                                                                </span>
                                                                <span
                                                                    class="text-gray-700 {{ $isCorrect ? 'font-semibold text-green-800' : '' }}">
                                                                    {{ $option }}
                                                                </span>
                                                                @if ($isCorrect)
                                                                    <div class="ml-auto flex items-center text-green-600">
                                                                        <span class="text-xs font-medium mr-2">Jawaban
                                                                            Benar</span>
                                                                        <svg class="w-5 h-5" fill="currentColor"
                                                                            viewBox="0 0 20 20">
                                                                            <path fill-rule="evenodd"
                                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if ($quizzes->isEmpty())
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-amerta-accent mb-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-amerta-dark mb-2">Belum ada quiz tersedia</h3>
                    <p class="text-amerta-secondary mb-6">Mulai buat quiz budaya pertama Anda!</p>
                    <button onclick="openAddQuizModal()"
                        class="bg-gradient-to-r from-amerta-primary to-amerta-secondary text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300">
                        Buat Quiz Sekarang
                    </button>
                </div>
            @endif
        </div>

        <!-- Add Quiz Modal -->
        <div id="addQuizModal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-amerta-primary to-amerta-secondary p-6 text-white rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <div>
                                <h3 class="text-2xl font-bold">Buat Quiz Baru</h3>
                                <p class="text-white/90 text-sm">Tambahkan quiz budaya Indonesia</p>
                            </div>
                        </div>
                        <button onclick="closeAddQuizModal()" class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <form action="/create/quiz/new" method="POST" class="p-6 space-y-6">
                    @csrf
                    <div>
                        <label class="block text-amerta-dark font-semibold mb-2">Konten</label>
                        <select name="content_id" required
                            class="w-full border-2 border-amerta-accent/30 rounded-lg px-4 py-3 focus:border-amerta-secondary focus:ring-0 transition-colors">
                            <option value="">Pilih Konten</option>
                            @if(isset($contents) && is_iterable($contents))
                                @foreach ($contents as $content)
                                    @if(is_object($content) && isset($content->id) && $content->type === 'quiz')
                                        <option value="{{ $content->id }}">{{ $content->title }}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <button type="button" onclick="closeAddQuizModal()"
                            class="px-6 py-3 text-amerta-primary bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors font-medium">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-amerta-primary to-amerta-secondary hover:from-amerta-dark hover:to-amerta-primary text-white rounded-lg transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                            🎯 Buat Quiz
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Question Modal -->
        <div id="addQuestionModal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-amerta-primary to-amerta-secondary p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="text-2xl font-bold">Tambah Soal Baru</h3>
                                <p class="text-white/90 text-sm">Buat pertanyaan tentang budaya Indonesia</p>
                            </div>
                        </div>
                        <button onclick="closeAddQuestionModal()"
                            class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                    <form action="/create/quiz" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="content_id" id="modal-content-id">

                        <!-- Question Input -->
                        <div>
                            <label class="block text-amerta-dark font-semibold mb-3">Pertanyaan</label>
                            <textarea name="question_text" rows="3" required
                                class="w-full border-2 border-amerta-accent/30 rounded-lg px-4 py-3 focus:border-amerta-secondary focus:ring-0 transition-colors resize-none"
                                placeholder="Masukkan pertanyaan tentang budaya Indonesia..."></textarea>
                        </div>

                        <!-- Answer Options -->
                        <div>
                            <label class="block text-amerta-dark font-semibold mb-3">Pilihan Jawaban</label>
                            <p class="text-amerta-secondary text-sm mb-4">💡 Klik radio button untuk menandai jawaban yang
                                benar</p>

                            <div class="space-y-4">
                                @for ($i = 0; $i < 4; $i++)
                                    <div
                                        class="flex items-center space-x-4 p-4 bg-gradient-to-r from-amerta-accent/5 to-transparent rounded-xl border border-amerta-accent/20 hover:border-amerta-secondary/40 transition-colors">
                                        <input type="radio" name="correct_answer" value="{{ $i }}"
                                            id="correct-modal-{{ $i }}" required
                                            class="w-5 h-5 text-amerta-secondary border-2 border-amerta-accent focus:ring-amerta-secondary">
                                        <label for="correct-modal-{{ $i }}"
                                            class="w-10 h-10 flex items-center justify-center bg-amerta-accent text-amerta-dark rounded-full text-sm font-bold cursor-pointer hover:bg-amerta-secondary hover:text-white transition-colors">
                                            {{ chr(65 + $i) }}
                                        </label>
                                        <input type="text" name="options[]" required
                                            placeholder="Masukkan pilihan {{ chr(65 + $i) }}"
                                            class="flex-1 border-0 bg-transparent focus:ring-0 text-amerta-dark placeholder-amerta-secondary/60 font-medium">
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <button type="button" onclick="closeAddQuestionModal()"
                                class="px-6 py-3 text-amerta-primary bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors font-medium">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-lg transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                                💾 Simpan Soal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #D2691E;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #8B4513;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        function openQuestionModal(quizId) {
            document.getElementById('questionModal-' + quizId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeQuestionModal(quizId) {
            document.getElementById('questionModal-' + quizId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openAddQuizModal() {
            document.getElementById('addQuizModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeAddQuizModal() {
            document.getElementById('addQuizModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openAddQuestionModal(quizId, contentId) {
            document.getElementById('modal-content-id').value = contentId;
            document.getElementById('addQuestionModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeAddQuestionModal() {
            document.getElementById('addQuestionModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modals when clicking outside
        document.addEventListener('click', function(e) {
            // Close question modals
            if (e.target.classList.contains('fixed') && e.target.id && e.target.id.startsWith('questionModal-')) {
                e.target.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            // Close add quiz modal
            if (e.target.id === 'addQuizModal') {
                closeAddQuizModal();
            }

            // Close add question modal
            if (e.target.id === 'addQuestionModal') {
                closeAddQuestionModal();
            }
        });

        // Handle escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close all modals
                document.querySelectorAll('[id^="questionModal-"]').forEach(modal => {
                    modal.classList.add('hidden');
                });
                closeAddQuizModal();
                closeAddQuestionModal();
                document.body.style.overflow = 'auto';
            }
        });
    </script>
@endsection
