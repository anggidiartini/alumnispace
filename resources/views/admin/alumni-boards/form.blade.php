@extends('admin.layout.index')

@section('page_title', isset($board) ? 'Edit Pengurus Alumni' : 'Tambah Pengurus Alumni')

@section('content')
<form action="{{ isset($board) ? route('admin.alumni-boards.update', $board->id) : route('admin.alumni-boards.store') }}" method="POST" style="max-width:760px;background:#fff;border:1px solid var(--border-color);border-radius:12px;padding:24px;">
    @csrf @if(isset($board)) @method('PUT') @endif
    @if($errors->any())<div style="margin-bottom:18px;color:#991b1b;">{{ $errors->first() }}</div>@endif
    <label>Nama Alumni</label><select name="alumni_profile_id" required style="width:100%;padding:10px;margin:6px 0 16px;"><option value="">Pilih alumni</option>@foreach($alumni as $person)<option value="{{ $person->id }}" @selected(old('alumni_profile_id', $board->alumni_profile_id ?? '') == $person->id)>{{ $person->name }}</option>@endforeach</select>
    <label>Jabatan</label><input name="position" value="{{ old('position', $board->position ?? '') }}" required style="width:100%;padding:10px;margin:6px 0 16px;">
    <label>Periode Kepengurusan</label><select name="committee_period_id" required style="width:100%;padding:10px;margin:6px 0 20px;"><option value="">Pilih periode</option>@foreach($periods as $period)<option value="{{ $period->id }}" @selected(old('committee_period_id', $board->committee_period_id ?? '') == $period->id)>{{ $period->period_name }}</option>@endforeach</select>
    <button type="submit" style="padding:10px 16px;border:0;border-radius:8px;background:var(--color-primary);color:#fff;cursor:pointer;">Simpan</button><a href="{{ route('admin.alumni-boards.index') }}" style="margin-left:12px;">Batal</a>
</form>
@endsection