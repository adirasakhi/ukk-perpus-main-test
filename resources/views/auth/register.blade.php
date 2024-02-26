<form method="POST" action="{{ route('register') }}">
    @csrf

    <label for="nama_lengkap">Nama Lengkap:</label>
    <input type="text" name="nama_lengkap" required>

    <label for="alamat">Alamat:</label>
    <input type="text" name="alamat" required>

    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Register</button>
</form>
