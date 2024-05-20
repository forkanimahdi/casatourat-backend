<x-app-layout>
    <form action="{{ route('circuit.post') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="">name</label>
            <input type="text" placeholder="name" name="name">
        </div>
        <div>
            <label for="">alternative</label>
            <input type="text" placeholder="alternative" name="alternative">
        </div>
        <div>
            <label for="">description</label>
            <input type="text" placeholder="description" name="description">
        </div>
        <div>
            <label for="">image</label>
            <input type="file" placeholder="image" multiple name="image[]">
        </div>
        <div>
            <label for="">audio</label>
            <input type="text" placeholder="audio" name="audio">
        </div>
        <div>
            <label for="">headpoint</label>
            <input type="text" placeholder="headpoint" name="headpoint">
        </div>
        <div>
            <label for="">zoom</label>
            <input type="text" placeholder="zoom" name="zoom">
        </div>
        <button>submit</button>
    </form>
</x-app-layout>
