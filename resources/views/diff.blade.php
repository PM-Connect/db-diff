@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12"><h1>Diff: {{ $diff->name }} (<span class="text-success">{{ $successful }}</span>/<span class="text-danger">{{ $failures }}</span>)</h1></div>
        <div class="col-md-12">
            <h3>Logs</h3>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Database</th>
                        <th>Table</th>
                        <th>Column/Index/Key</th>
                        <th>Check</th>
                        <th>Result</th>
                        <th>Field</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr class="{{ $log->result ? 'success' : 'danger' }}">
                            <td>{{ $log->database }}</td>
                            <td>{{ $log->table }}</td>
                            <td>{{ $log->column }}</td>
                            <td>{{ $log->type }}</td>
                            <td class="text-center">
                                @if($log->result)
                                    <strong title="Failed" class="text-success"><i class="fa fa-fw fa-check"></i></strong>
                                @else
                                    <strong title="Successful" class="text-danger"><i class="fa fa-fw fa-exclamation-triangle"></i></strong>
                                @endif
                            </td>
                            <td>{{ $log->field }}</td>
                            <td>{{ $log->message }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection