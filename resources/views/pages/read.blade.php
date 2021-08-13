@extends('layouts.app')

@section('content')
    <h1>Read Page</h1>
    <table class="table mt-5">
        <tbody>
        @foreach($arrays as $array)
            <tr>
                <td>{{ $array['id'] }}</td>
                <td>{{ $array['string'] }}</td>
                <td>{{ $array['integer'] }}</td>
                <td>{{ $array['text'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
