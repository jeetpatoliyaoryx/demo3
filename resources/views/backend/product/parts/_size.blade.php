<table class="table">
@foreach($getsizeproduct as $value)
    <tr>
        <td style="font-size: 15px;">{{ $value->name }}</td>
        <td style="font-size: 15px;">{{ $value->price }}</td>
        <td><a href="{{ url('admin/size/delete/'.$value->id.'/'.$value->product_id) }}" class="btn btn-danger">Delete</a></td>
    </tr>
@endforeach
</table>