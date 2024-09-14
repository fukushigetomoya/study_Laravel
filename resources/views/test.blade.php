こんにちは
{{-- 一つずつレコードを取り出す --}}
@foreach ($users as $user)
    <p>
        {{-- name列のデータを取り出す --}}
        {{ $user->name }}
    </p>
@endforeach