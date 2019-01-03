@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Import
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($import, ['route' => ['imports.update', $import->id], 'method' => 'patch']) !!}

                        @include('imports.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection