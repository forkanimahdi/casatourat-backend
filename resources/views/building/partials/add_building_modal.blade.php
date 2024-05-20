<!-- Button trigger modal -->
<button id="submit" type="button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    submit circuit
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('building.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="">name</label>
                        <input type="text" placeholder="name" name="name">
                    </div>
                    <div>
                        <label for="">description</label>
                        <input type="text" placeholder="description" name="description">
                    </div>
                    <div>
                        <label for="">audio</label>
                        <input type="text" placeholder="audio" name="audio">
                    </div>
                    <div>
                        <label for="">image</label>
                        <input type="file" placeholder="image" multiple name="image[]">
                    </div>
                    <div class="d-none">
                        <input type="text" id="latitude" placeholder="latitude" name="latitude">
                    </div>
                    <div class="d-none">
                        <input type="text" id="longitude" placeholder="longitude" name="longitude">
                    </div>
                    <button>submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
