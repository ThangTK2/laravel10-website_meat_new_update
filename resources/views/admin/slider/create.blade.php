@extends('master.admin')
@section('title', 'Admin | Thêm Mới Slider')
@section('main')

<div class="row">
    <div class="col-md-4">
        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Tên slider</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="..." aria-describedby="helpId">
            </div>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Hình ảnh slider</label>
                <input type="file" name="image" class="form-control" placeholder="..." aria-describedby="helpId">
            </div>
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Position</label>
                <select class="form-control" name="position" id="">
                    <option value="">Chọn một</option>
                    @foreach ($sliders as $item)
                        <option>{{ $item->position }}</option>
                    @endforeach
                </select>
            </div>
            @error('position')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="description" class="form-control description" placeholder="...">{{ old('description') }}</textarea>
            </div>
            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="">Trạng thái</label>
                <div class="radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" value="0"> Ẩn
                    </label>
                </div>
                <div class="radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="status" value="1"> Hiện
                    </label>
                </div>
            </div>
            @error('status')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Thêm</button>
        </form>
    </div>
</div>

@endsection
