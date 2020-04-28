<!@extends ('layouts.app')

@section('title', 'Categories')

@section('content')
    <table class="table">
        <tr>
            <td>Id</td>
            <td>Name</td>
        </tr>
        @foreach($categories as $category)
            <tr data-index="{{ $category->getId() }}">
                <td> {{ $category->getId() }} </td>
                <td> <a href="/category/{{ $category->getId() }}">{{ $category->getName() }} </a></td>
            </tr>
        @endforeach
    </table>
    <a class="btn btn-primary edit-btn" href="/category/create"> Add New Category </a>
@endsection