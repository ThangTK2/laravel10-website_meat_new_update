@extends('master.admin')
@section('title', 'Admin | Danh Sách Danh Mục')
@section('main')

    <a href="{{ route('sliders.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i></a>
    <br>
<br>
    <table class="table table-striped table-inverse table-responsive table-bordered text-center">
        <thead class="thead-inverse">
            <tr>
                <th>STT</th>
                <th>Tên slider</th>
                <th>Hình ảnh</th>
                <th>Position</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $slider->name }}</td>
                    <td>
                        @if ($slider->position == 'gallery')
                            <img src="uploads/gallery/{{ $slider->image }}" width="100px" height="65px" alt="Hình ảnh">
                        @else
                            <img src="uploads/banner/{{ $slider->image }}" width="50px" height="65px" alt="Hình ảnh">
                        @endif
                    </td>
                    <td>{{ $slider->position }}</td>
                    <td>{{ $slider->status }}</td>
                    <td>
                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Bạn có muốn xóa slider này?')" type="submit" class="btn btn-sm btn-danger "><i class="fa fa-trash"></i> </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sliders->appends(request()->all())->links() }}
@endsection
