@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
@php
    $admin = auth()->user();
@endphp

<div class="container">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Notifikasi</h4>

        @if($admin->unreadNotifications()->count() > 0)
            <a href="{{ route('admin.notification.readAll') }}"
               class="btn btn-sm btn-outline-primary">
                Tandai semua dibaca
            </a>
        @endif
    </div>

    {{-- LIST --}}
    @forelse($notifications as $notif)
        <div class="card mb-2 {{ $notif->read_at ? '' : 'border-primary' }}">
            <div class="card-body d-flex justify-content-between align-items-start">

                <a href="{{ route('admin.notification.read', $notif->id) }}"
                   class="text-decoration-none text-dark flex-grow-1 me-3">
                    <strong>{{ $notif->data['judul'] ?? 'Notifikasi' }}</strong>
                    <div class="small text-muted">
                        {{ $notif->data['message'] ?? '-' }}
                    </div>
                </a>

                <div class="text-end">
                    <small class="text-muted d-block">
                        {{ $notif->created_at->diffForHumans() }}
                    </small>

                    <form action="{{ route('admin.notification.destroy', $notif->id) }}"
                          method="POST"
                          onsubmit="return confirm('Hapus notifikasi ini?')">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-outline-danger mt-1">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @empty
        <div class="text-center text-muted py-5">
            Tidak ada notifikasi
        </div>
    @endforelse

    <div class="mt-3">
        {{ $notifications->links() }}
    </div>

</div>
@endsection
