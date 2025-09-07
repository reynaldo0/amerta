@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-amerta-primary mb-2">Cerita Rakyat</h1>
            <p class="text-gray-600">Kumpulan cerita tradisional yang melestarikan warisan budaya nusantara</p>
        </div>

        {{-- Grid Cerita --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($story as $item)
                <div
                    class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                    {{-- Thumbnail or image --}}
                    @if (!empty($item->file))
                        <div class="h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                            <img src="{{$item->file}}" alt="{{ $item->title }}"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="h-48 bg-gradient-to-br from-amerta-primary to-amerta-secondary cultural-pattern"></div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-amerta-dark mb-2">{{ $item->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->description ?? $item->body), 100) }}
                        </p>

                        {{-- PDF link --}}
                        <div class="mb-2">
                            @if (!empty($item->file_url))
                                <a href="{{ $item->file_url }}" target="_blank"
                                    class="text-blue-600 underline text-sm">
                                    Download PDF
                                </a>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-amerta-secondary font-medium">
                                {{ $item->province->name ?? $item->region->name ?? 'Nusantara' }}
                            </span>
                            <div class="flex gap-2">
                                <button onclick="openEditModal({{ $item->id }})"
                                    class="bg-amerta-primary text-white px-3 py-1 rounded-md text-sm hover:bg-amerta-dark transition-colors">
                                    Edit
                                </button>
                                <button onclick="openViewModal({{ $item->id }})"
                                    class="bg-gray-100 text-gray-700 px-3 py-1 rounded-md text-sm hover:bg-gray-200 transition-colors">
                                    Lihat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Modal Form --}}
    <div id="editModal" class="fixed inset-0 z-50 hidden">
        <div class="modal-overlay absolute inset-0" onclick="closeEditModal()"></div>
        <div class="relative z-10 flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-2xl w-full max-w-3xl max-h-screen overflow-y-auto">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 id="modalTitle" class="text-2xl font-bold text-amerta-primary">Edit Cerita</h2>
                        <button onclick="closeEditModal()"
                            class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                    </div>
                </div>

                <form id="editForm" method="POST" action="" class="p-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="storyId">
                    <input type="hidden" name="category" value="cerita_rakyat">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Cerita</label>
                        <input type="text" name="title" id="storyTitle"
                            class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-amerta-primary">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                        <select id="item-province" name="province_id"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amerta-primary/20 focus:border-amerta-primary transition-colors"
                            required>
                            <option value="">Pilih provinsi...</option>
                            @foreach ($provinces as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Foto --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto (Thumbnail)</label>
                        <input type="file" name="file" id="editPhoto" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-200 rounded-xl">
                        <div id="photo-preview" class="mt-2"></div>
                    </div>

                    {{-- PDF --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dokumen PDF</label>
                        <input type="file" name="file_url" id="editPdf" accept=".pdf"
                            class="w-full px-4 py-2 border border-gray-200 rounded-xl">
                        <div id="pdf-preview" class="mt-2 text-sm text-gray-600"></div>
                    </div>

                    {{-- Quill Editor --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Cerita</label>
                        <div id="quillEditor" style="height:320px;" class="h-80 border border-gray-300 rounded-md"></div>
                        <input type="hidden" name="description" id="storyDescription">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-amerta-primary text-white rounded-md hover:bg-amerta-dark">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- QuillJS --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        let quill;

        function initQuill() {
            quill = new Quill('#quillEditor', {
                theme: 'snow',
                placeholder: 'Tulis isi cerita di sini...',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });
            document.getElementById('quillEditor').style.height = '320px';
        }

        function openEditModal(id) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');

            document.getElementById('modalTitle').textContent = 'Edit Cerita';
            loadStoryData(id);

            // Set form action with id
            form.action = '/item/' + id;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function loadStoryData(id) {
            const data = @json($story->keyBy('id'));
            const s = data[id];

            document.getElementById('storyId').value = s ? s.id : '';
            document.getElementById('storyTitle').value = s ? s.title : '';
            document.getElementById('item-province').value = s ? (s.province_id ?? '') : '';

            // Photo preview
            const photoPreview = document.getElementById('photo-preview');
            if (s && s.file) {
                photoPreview.innerHTML =
                    `<img src="${s.file}" class="w-32 h-32 object-cover rounded-lg">`;
            } else {
                photoPreview.innerHTML = '';
            }

            // PDF preview
            const pdfPreview = document.getElementById('pdf-preview');
            if (s && s.file_url) {
                pdfPreview.innerHTML =
                    `<a href="${s.file_url}" target="_blank">${s.file_url.split('/').pop()}</a>`;
            } else {
                pdfPreview.innerHTML = '';
            }

            if (quill) {
                quill.root.innerHTML = s ? (s.description ?? '') : '';
            }
        }

        // Preview new photo
        document.getElementById('editPhoto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('photo-preview');
            if (file) {
                preview.innerHTML =
                    `<img src="${URL.createObjectURL(file)}" class="w-32 h-32 object-cover rounded-lg">`;
            }
        });

        // Preview new pdf
        document.getElementById('editPdf').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('pdf-preview');
            if (file) {
                preview.innerHTML = `<span>${file.name}</span>`;
            }
        });

        document.getElementById('editForm').addEventListener('submit', function(e) {
            document.getElementById('storyDescription').value = quill.root.innerHTML;
        });

        document.addEventListener('DOMContentLoaded', initQuill);

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeEditModal();
        });
    </script>
@endsection
