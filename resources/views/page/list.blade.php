@extends ('layouts.app')

@php
    if(!isset($window_title)) $window_title = $title . " - PageServer"
@endphp

@section('title', $title)
@section('windowTitle', $window_title)

@section('content')
    <table class="table">
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Category</td>
            <td>Contents</td>
            <td>Url</td>
            <td>Action</td>
        </tr>
        @foreach($pages as $page)
            <tr data-index="{{ $page['id'] }}">
                <td> {{ $page['id'] }} </td>
                <td> {{ $page['name'] }} </td>
                <td> <a href="/category/$page['catid'] }}">{{ $page['catname'] }} </a></td>
                <td> {{ $page['contents'] }} </td>
                <td> {{ $page['url'] }} </td>
                <td>
                    <a href="page/{{ $page['id'] }}/edit" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-primary delete">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
    <a class="btn btn-primary edit-btn" href="/page/create"> Add New Category </a>
@endsection
@section('script')
    $(".delete").click(function(){
        let owner =$(this).closest("tr");
        let id = owner.data("index");
            $.ajax({
            url: "/page/"+id,
            method: "delete",
            data: {id: id, _token: "{{ csrf_token() }}" },
            dataType: "json",
            success: function(data){
                alert("The page has been deleted");
                owner.remove();
            },
            error: function(xhr){
                var data = JSON.parse(xhr.responseText);
                if(data.reason ==="unknown"){
                    alert("Unknown error: \n"+data.message);
                }else{
                    alert("Server error.");
                }
            }
        });
        
    })
@endsection