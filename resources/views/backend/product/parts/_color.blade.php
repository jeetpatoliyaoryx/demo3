<table class="table">
@foreach($getcolorproduct as $value)
    <tr>
        <td style="font-size: 15px;">{{ $value->name }}</td>
        <td style="font-size: 15px;">{{ $value->color_code }}</td>
        <td><a href="{{ url('admin/color/delete/'.$value->id.'/'.$value->product_id) }}" class="btn btn-danger">Delete</a></td>
    </tr>
@endforeach
</table>