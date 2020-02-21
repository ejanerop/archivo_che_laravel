@extends('layouts.app')

@section('content')

    <section class="content-header">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                    </div>
                    <form id="topic" method="POST" action="">
                        @csrf
                        <div class="box-body">
                            <div class="form-group {{$errors->has('research_topic')?"has-error":""}}">
                                <label for="research_topic">Tema de investigación</label>
                                <input type="text" id="research_topic" name="research_topic" class="form-control" value="{{$researchTopic->research_topic}}" style="display: inline-block" disabled>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="4" style="resize: none" placeholder="Descripción del tema">
                                    {{$researchTopic->description}}
                                </textarea>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                </thead>
                                <tbody>
                                    @foreach($subtopics as $subtopic)
                                    <tr>
                                        <td>{{$subtopic->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="box-footer">
                                <a href="{{route('subtopic.index')}}" class="btn btn-danger pull-left">
                                    <span class="fa fa-remove"></span>
                                    {{ __('Atrás') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </section>

    <script>
        $('li.li').removeClass('active');
        $('li#topic').addClass('active');
        $('li#topicCreate').addClass('active');
    </script>
@endsection
