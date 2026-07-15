<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 dark:bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm rounded-xl border border-slate-200 dark:border-slate-700">
                <div class="p-6">
                    
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 pb-5 border-b border-slate-100 dark:border-slate-700/50">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200">Files</h3>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Manage and download your uploaded document assets.</p>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <form action="{{ url()->current() }}" method="GET" class="relative block m-0 p-0">
                                <div class="relative w-64">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    
                                    <input 
                                        type="text" 
                                        name="search" 
                                        value="{{ request('search') }}" 
                                        placeholder="Search files by name..." 
                                        class="block w-full pl-10 pr-8 py-2 text-sm bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 placeholder-slate-400 dark:placeholder-slate-500 border border-slate-200 dark:border-slate-700/80 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-150"
                                    />

                                    @if(request('search'))
                                        <a href="{{ url()->current() }}" class="absolute inset-y-0 right-0 pr-2.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200" title="Clear search">
                                            <svg class="h-4 w-4 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 p-0.5 rounded-full transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </form>

                            <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="m-0 p-0">
                                @csrf
                                <label class="cursor-pointer bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center justify-center gap-2 text-sm shadow-sm hover:shadow transition-all duration-150 whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16a3 3 0 013-3h12a3 3 0 013 3m-9-5l3-3m0 0l3 3m-3-3v12"></path>
                                    </svg>
                                    <span>Upload New Document</span>
                                    <input type="file" name="file" class="hidden" onchange="this.form.submit()">
                                </label>
                            </form>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-slate-100 dark:border-slate-700/50">
                        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700 text-left text-sm">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-slate-900 text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider">
                                    <th class="px-6 py-3.5">File Name</th>
                                    <th class="px-6 py-3.5">Categoryy</th>
                                    <th class="px-6 py-3.5">Uploader</th>
                                    <th class="px-6 py-3.5 text-right w-32">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700 bg-white dark:bg-slate-800">
                                @forelse($files as $file)
                                    <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-900/40 transition-colors">
                                        <td class="px-6 py-4 align-middle font-medium text-slate-900 dark:text-slate-100 whitespace-nowrap">
                                            {{ $file->name }}
                                        </td>
                                        
                                        <td class="px-6 py-4 align-middle whitespace-nowrap">
                                            @php
                                                $ext = strtoupper(pathinfo($file->name, PATHINFO_EXTENSION));
                                                
                                                // Default gray styles
                                                $badgeClass = 'bg-slate-100 text-slate-700 border-slate-200 dark:bg-slate-700 dark:text-slate-300 dark:border-slate-600';
                                                
                                                if ($ext === 'SQL') {
                                                    $badgeClass = 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-950/30 dark:text-amber-400 dark:border-amber-900/50';
                                                } elseif (in_array($ext, ['PNG', 'JPG', 'JPEG', 'GIF'])) {
                                                    $badgeClass = 'bg-indigo-50 text-indigo-700 border-indigo-200 dark:bg-indigo-950/30 dark:text-indigo-400 dark:border-indigo-900/50';
                                                }
                                            @endphp
                                            
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold uppercase tracking-wider border {{ $badgeClass }}">
                                                {{ $ext ?: 'FILE' }}
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4 align-middle text-slate-600 dark:text-slate-400 whitespace-nowrap">
                                            {{ auth()->user()->name }}
                                        </td>
                                        
                                        <td class="px-6 py-4 align-middle whitespace-nowrap text-right">
                                            <div class="inline-flex items-center justify-end gap-2 w-full">
                                                <a href="{{ route('files.download', $file->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 text-slate-600 hover:text-blue-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-blue-900/30 dark:hover:text-blue-400 transition-colors" title="Download File">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('files.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Delete this file?');" class="inline m-0 p-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-rose-950/30 dark:hover:text-rose-400 transition-colors" title="Delete">
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
                                        <td colspan="4" class="px-6 py-10 text-center text-slate-400 dark:text-slate-500 italic bg-white dark:bg-slate-800">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <svg class="w-8 h-8 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                                <span>{{ request('search') ? 'No files match your search.' : 'No files uploaded yet.' }}</span>
                                            </div>
                                        </td>
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