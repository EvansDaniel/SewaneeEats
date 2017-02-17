@extends('admin.layout')

@section('head')
    <title>Update Accessory | {{ $menu_item->name }}</title>
@stop

@section('body')

    <h1>Update accessory for {{ $menu_item->name }}</h1>
    <form action="{{ route('updateAccessory',['id' => $accessory->id]) }}" method="post">
        {{ csrf_field() }}
        <input name="menu_item_id" type="hidden" value="{{ $menu_item->id }}">
        <input type="hidden" value="{{ $accessory->id }}" name="accessory_id">
        <div class="form-group">
            <label for="name">Accessory Name</label>
            <input type="text" class="form-control" name="name"
                   maxlength="100" value="{{ $accessory->name }}" required id="name">

            <label for="price" id="price-label">Price</label>
            <input type="number" min="0" step=".01" value="{{ $accessory->price }}" name="price" id="price"
                   class="form-control" required>

            <button type="submit" class="btn btn-primary" style="margin-top: 10px">Update Accessory</button>
        </div>
    </form>
@stop