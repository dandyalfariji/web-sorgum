@extends('layouts.admin')

@section('title', 'Anggota Tim')

@section('header_action')
    <a href="{{ route('admin.team-members.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah Tim</a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="px-4">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan / Role</th>
                    <th>Sosial Media</th>
                    <th>Status</th>
                    <th class="text-center px-4" width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teamMembers as $member)
                <tr>
                    <td class="px-4">
                        @if($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;"><i class="bi bi-person text-secondary"></i></div>
                        @endif
                    </td>
                    <td><strong>{{ $member->name }}</strong></td>
                    <td>{{ $member->role ?? '-' }}</td>
                    <td>
                        @if($member->instagram_url)<a href="{{ $member->instagram_url }}" target="_blank" class="text-danger me-2"><i class="bi bi-instagram"></i></a>@endif
                        @if($member->linkedin_url)<a href="{{ $member->linkedin_url }}" target="_blank" class="text-primary"><i class="bi bi-linkedin"></i></a>@endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $member->is_active ? 'success' : 'secondary' }}">
                            {{ $member->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="text-center px-4">
                        <a href="{{ route('admin.team-members.edit', $member) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus anggota tim ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada anggota tim.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($teamMembers->hasPages())
    <div class="card-footer bg-white pt-3">{{ $teamMembers->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection
