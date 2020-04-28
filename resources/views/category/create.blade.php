@extends ('layouts.app')

@section('title', 'Create Category')

@section('content')
    <form id="create-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="group-name">Category Name</label>
            <input type="text" name="name" class="form-control" id="group-name">
        </div>
        <button type="submit" class="btn btn-primary" id="submit-btn">Submit</button>
    </form>
@endsection
@section('script')
    $("#submit-btn").click(function (){
            $.ajax({
            url: "/category",
            method: "post",
            data: $("#create-form").serialize(),
            dataType: "json",
            success: function(data){
                alert("The category has been added");
                window.location.replace("/category");
            },
            error: function(xhr){
                var data = JSON.parse(xhr.responseText);
                if(data.reason === "duplicated"){
                    alert("The category name already exists");
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