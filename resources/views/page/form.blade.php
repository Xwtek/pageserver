@extends ('layouts.app')

@php
    if(!isset($obj)) {
        $obj = [];
        if(!isset($mode)){
            $mode = "add";
        }
    }else if(!isset($mode)){
        $mode = "edit";
    }
    if(!isset($obj["name"])) $obj["name"] = "";
    if(!isset($obj["contents"])) $obj["contents"] = "";
    if(!isset($obj["url"])) $obj["url"] = "";
    if(!isset($obj["category"])) $obj["category"] = 0;

    if(!isset($categories)) $categories = [];
    for($i = 0; $i < count($categories); $i++){
        $temp = [];
        if($obj["category"] = $categories[$i]["id"]){
            $temp["selected"] = "selected";
        }else{
            $temp["selected"] = "";
        }
        $temp["value"] = $categories[$i]["id"];
        $temp["display"] = $categories[$i]["name"];
        $categories[$i] = $temp;
    }
    if(!isset($window_title)) $window_title = $title . " - PageServer"
@endphp

@section('title', $title)

@section('windowTitle', $window_title)

@section('content')
    <form id="create-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if ($mode === "edit")
        <input type="hidden" name="id" value="{{ $obj['id'] }}">
        @endif
        <div class="form-group">
            <label for="group-name">Page Name</label>
            <input type="text" name="name" class="form-control" id="group-name" value="{{ $obj['name'] }}">
        </div>
        <div class="form-group">
            <label for="group-name">Content Address</label>
            <input type="text" name="contents" class="form-control" id="group-name" value="{{ $obj['contents'] }}">
        </div>
        <div class="form-group">
            <label for="group-name">URL</label>
            <input type="text" name="url" class="form-control" id="group-name" value="{{ $obj['url'] }}">
        </div>
        <div class="form-group">
            <label for="group-name">Category</label>
            <select name="category">
                @foreach($categories as $category)
                    <option {{ $category['selected'] }} value="{{ $category['value'] }}">{{ $category["display"] }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
    </form>
@endsection
@section('script')
    $("#submit-btn").click(function (){
            $.ajax({
            @if ($mode === "add")
                url: "/page",
                method: "post",
            @elseif ($mode === "edit")
                url: "/page/{{ $obj['id'] }}",
                method: "put",
            @endif
            data: $("#create-form").serialize(),
            dataType: "json",
            success: function(data){
                @if ($mode === "add")
                    alert("The page has been added");
                @elseif ($mode === "edit")
                    alert("The page has been edited");
                @endif
                window.location.replace("/page");
            },
            error: function(xhr){
                var data = JSON.parse(xhr.responseText);
                if(data.reason === "duplicated"){
                    alert("The page name already exists");
                }else if(data.reason ==="unknown"){
                    alert("Unknown error: \n"+data.message);
                }else{
                    alert("Server error.");
                }
            }
        });
        return false;
    })
@endsection