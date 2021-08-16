@extends('layouts.app')

@section('content')
    <h1>Role Information Page</h1>
    <table class="table mt-5 table-striped" border="solid" style="text-align: center">
        <caption class="card-title">ユーザーテーブル</caption>
        <tbody>
        <tr>
            @foreach(Auth::user()->first()->toArray() as $key => $value)
                <th>{{$key}}</th>
            @endforeach
        </tr>
        <tr>
            @foreach(Auth::user()->first()->toArray() as $key => $value)
                @if(in_array($value, \App\Enums\Roles::getValues(), true))
                    <td>({{\App\Enums\Roles::getLabel((int)$value)}})<br>{{$value}}</td>
                @else
                    <td><br>{{$value}}</td>
                @endif
            @endforeach
        </tr>
        </tbody>
    </table>
    <table class="table mt-5 table-striped" border="solid" style="text-align: center">
        <caption class="card-title">ユーザー id に紐づく権限テーブル</caption>
        <tbody>
        <tr>
            @foreach(Auth::user()->rolesOwnership()->first()->toArray() as $key => $value)
                @php($role = $key !== 'id' &&
                        (
                        $value === \App\Enums\RoleStatuses::DISABLED ||
                        $value === \App\Enums\RoleStatuses::ENABLED
                        )
                        )
                @if($role)
                    <th>({{\App\Enums\Roles::getLabel(\App\Enums\Roles::getValue(strtoupper($key)))}})<br>{{$key}}</th>
                @else
                    <th>
                        <br>{{$key}}
                    </th>
                @endif
            @endforeach
        </tr>
        <tr>
            @foreach(Auth::user()->rolesOwnership()->first()->toArray() as $key => $value)
                @php($role = $key !== 'id' &&
                        (
                        $value === \App\Enums\RoleStatuses::DISABLED ||
                        $value === \App\Enums\RoleStatuses::ENABLED
                        )
                        )
                @if($role)
                    <td>
                        ({{\App\Enums\RoleStatuses::getLabel($value)}})<br>{{$value}}
                    </td>
                @else
                    <td>
                        @if(!is_null($value))
                            <br>{{$value}}
                        @else()
                            ({{\App\Enums\RoleStatuses::getLabel($value)}})<br>null
                        @endif
                    </td>
                @endif
            @endforeach
        </tr>
        </tbody>
    </table>
@endsection
