@extends('layouts.web')

@section('title', 'Notifikasi')

@section('content')
@php
    $user = auth()->user();
@endphp

<div class="container py-5">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h4 class="fw-bold mb-0">Notifikasi</h4>

        @if($user->unreadNotifications()->count() > 0)
            <a href="{{ route('user.notification.readAll') }}"
               class="btn btn-sm btn-outline-primary">
                Tandai semua dibaca
            </a>
        @endif
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">

            @forelse($notifications as $notif)
                <div class="d-flex justify-content-between align-items-start
                            p-3 border-bottom
                            {{ $notif->read_at ? '' : 'bg-light' }}">

                    <a href="{{ route('user.notification.read', $notif->id) }}"
                       class="text-decoration-none text-dark flex-grow-1 me-3">
                        <div class="fw-semibold">
                            {{ $notif->data['judul'] ?? 'Notifikasi' }}
                        </div>
                        <div class="small text-muted">
                            {{ $notif->data['message'] ?? '-' }}
                        </div>
                    </a>

                    <div class="text-end">
                        <small class="text-muted d-block mb-1">
                            {{ $notif->created_at->diffForHumans() }}
                        </small>

                        <form action="{{ route('user.notification.destroy', $notif->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus notifikasi ini?')">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-outline-danger">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    Tidak ada notifikasi
                </div>
            @endforelse

        </div>
    </div>

    <div class="mt-2 my-5">
        {{ $notifications->links() }}
    </div>
</div>
@endsection


