<!-- Button trigger modal -->
<button type="button" class="bg-alpha text-white px-2 py-2 rounded-lg" data-bs-toggle="modal"
    data-bs-target="#exampleModal">
    Add Moderator
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Moderator</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="{{ route('register_user.store') }}" method="post">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <label for="">first name</label>
                            <input type="text" placeholder="first name" name="first_name">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="">last name</label>
                            <input type="text" placeholder="last name" name="last_name">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="">username</label>
                            <input type="text" placeholder="username" name="username">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="">email</label>
                            <input type="text" placeholder="email" name="email">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="">gender</label>
                            <select name="gender" id="">
                                <option value="" selected disabled>select your gender</option>
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="bg-alpha text-white px-2 py-2 rounded-lg">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
