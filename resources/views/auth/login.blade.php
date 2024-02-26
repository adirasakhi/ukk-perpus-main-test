<!-- Ubah input 'email' menjadi 'username' di dalam formulir login -->
<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
