@extends('layouts.master')

@section('content')
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