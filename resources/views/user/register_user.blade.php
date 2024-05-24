<x-app-layout>
    <form action="{{ route('register_user.store') }}" method="post">
        @csrf
        <div>
            <label for="">first name</label>
            <input type="text" placeholder="first name" name="first_name">
        </div>
        <div>
            <label for="">last name</label>
            <input type="text" placeholder="last name" name="last_name">
        </div>
        <div>
            <label for="">username</label>
            <input type="text" placeholder="username" name="username">
        </div>
        <div>
            <label for="">email</label>
            <input type="text" placeholder="email" name="email">
        </div>
        <div>
            <label for="">gender</label>
            <select name="gender" id="">
                <option value="" selected disabled>select your gender</option>
                <option value="male">male</option>
                <option value="female">female</option>
            </select>
        </div>
        <button>submit</button>
    </form>
</x-app-layout>
