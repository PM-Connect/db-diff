@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(config('queue.default') == 'sync')
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Warning
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p>You are using the <code>sync</code> queue driver. This is not optimal and diffs may be slow or fail if they take too long. Please try the <code>database</code> driver.</p>
                        <p>If you are running this on <code>docker</code>, you can ignore this message.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Databases</h3>

            <p>All database connection details are stored in local storage and will not be persisted into the database.</p>

            <database-list></database-list>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Diffs</h3>

            <p>All diff data is stored in the application database and will be persisted.</p>

            <diff-list></diff-list>
        </div>
    </div>
@endsection