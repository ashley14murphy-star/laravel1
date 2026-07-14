<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- DOCUMENTS MANAGEMENT ROW (As shown in image_7aed59.png) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Documents</h3>
                        
                        <!-- Create/Upload Document Button styled like edited-image.png -->
                        <form action="{{ route('documents.store') }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input type="text" name="title" placeholder="New Document Title..." required class="text-sm rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-emerald-500">
                            <button type="submit" style="background-color: #15803d;" class="text-white font-medium py-2 px-4 rounded inline-flex items-center gap-2 text-sm shadow hover:opacity-90 transition-opacity">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Add Document
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-left text-sm">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-900">
                                    <th class="px-6 py-3 font-bold text-gray-700 dark:text-gray-300">Document Title</th>
                                    <th class="px-6 py-3 font-bold text-gray-700 dark:text-gray-300 w-1/2">Content Notes</th>
                                    <th class="px-6 py-3 font-bold text-gray-700 dark:text-gray-300 text-center w-32">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($documents as $doc)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                            {{ $doc->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <form id="update-form-{{ $doc->id }}" action="{{ route('documents.update', $doc->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="content" rows="1" class="w-full text-xs rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:ring-blue-500" placeholder="Type document notes here...">{{ $doc->content }}</textarea>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="inline-flex items-center justify-center gap-2">
                                                <!-- Edit / Save Icon Button -->
                                                <button type="submit" form="update-form-{{ $doc->id }}" style="background-color: #00cae3;" class="p-2 rounded text-white shadow hover:opacity-90" title="Save Changes">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                    </svg>
                                                </button>
                                                
                                                <!-- Delete Icon Button -->
                                                <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Delete this document?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background-color: #ffebee;" class="p-2 rounded text-red-600 shadow-sm hover:bg-red-100" title="Delete">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-16v1m4 0a1 1 0 00-1-1h-4a1 1 0 00-1 1m5 0H4"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">No documents found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- CLOUD DRIVE FILES ROW (As shown in image_7af443.png) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Files</h3>
                        
                        <!-- Upload Button styled like edited-image.png -->
                        <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label style="background-color: #15803d;" class="cursor-pointer text-white font-medium py-2 px-4 rounded inline-flex items-center gap-2 text-sm shadow hover:opacity-90 transition-opacity">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16a3 3 0 013-3h12a3 3 0 013 3m-9-5l3-3m0 0l3 3m-3-3v12"></path>
                                </svg>
                                <span>Upload New Document</span>
                                <input type="file" name="file" class="hidden" onchange="this.form.submit()">
                            </label>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-left text-sm">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-900">
                                    <th class="px-6 py-3 font-bold text-gray-700 dark:text-gray-300">File Name</th>
                                    <th class="px-6 py-3 font-bold text-gray-700 dark:text-gray-300">Category</th>
                                    <th class="px-6 py-3 font-bold text-gray-700 dark:text-gray-300">Uploader</th>
                                    <th class="px-6 py-3 font-bold text-gray-700 dark:text-gray-300 text-center w-32">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($files as $file)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100 whitespace-nowrap">
                                            {{ $file->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                                General
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400 whitespace-nowrap">
                                            {{ auth()->user()->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="inline-flex items-center justify-center gap-2">
                                                <!-- Download / View Icon Button -->
                                                <a href="{{ route('files.download', $file->id) }}" style="border: 1px solid #00cae3; color: #00cae3;" class="p-2 rounded bg-white hover:bg-cyan-50 transition-colors" title="Download File">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>

                                                <!-- Delete Icon Button -->
                                                <form action="{{ route('files.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Delete this file?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background-color: #ffebee;" class="p-2 rounded text-red-600 shadow-sm hover:bg-red-100" title="Delete">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-16v1m4 0a1 1 0 00-1-1h-4a1 1 0 00-1 1m5 0H4"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">No files uploaded yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>