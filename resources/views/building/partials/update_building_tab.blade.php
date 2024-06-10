<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="{{ $building->id }}home-tab" data-bs-toggle="tab"
            data-bs-target="#{{ $building->id }}home-tab-pane" type="button" role="tab"
            aria-controls="{{ $building->id }}home-tab-pane" aria-selected="true">update infos</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="{{ $building->id }}profile-tab" data-bs-toggle="tab"
            data-bs-target="#{{ $building->id }}profile-tab-pane" type="button" role="tab"
            aria-controls="{{ $building->id }}profile-tab-pane" aria-selected="false">update images</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="{{ $building->id }}home-tab-pane" role="tabpanel"
        aria-labelledby="{{ $building->id }}home-tab" tabindex="0">
        <form action="{{ route('building.update', $building) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="">name</label>
                <input type="text" required value="{{ $building->name }}" placeholder="name" name="name">
            </div>
            <div>
                <label for="">description</label>
                <input type="text" required value="{{ $building->description }}" placeholder="description"
                    name="description">
            </div>
            <div>
                <label for="">audio</label>
                <input type="file" placeholder="audio" name="audio">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">update</button>
            </div>
        </form>
    </div>
    <div class="tab-pane fade" id="{{ $building->id }}profile-tab-pane" role="tabpanel"
        aria-labelledby="{{ $building->id }}profile-tab" tabindex="0">
        <div>
            <form action="{{ route('building.store_image', $building) }}" enctype="multipart/form-data" method="post">
                @csrf
                <label for="">add image</label>
                <input multiple type="file" name="image[]">
                <button class="btn btn-primary">+</button>
            </form>
            @foreach ($building->images as $image)
                <div class="border border-blue-500">
                    <img src="{{ asset('storage/images/' . $image->path) }}" width="50" alt="">
                    <form action="{{ route('building.destory_image', $image) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">delete</button>
                    </form>
                    <form action="{{ route('building.update_image', $image) }}" enctype="multipart/form-data"
                        method="post">
                        @csrf
                        @method('PUT')
                        <input type="file" name="image">
                        <button class="btn btn-secondary">update</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

</div>
