<form method="POST" action="?page=handleRegister">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <select name="role" required>
        <option value="admin">Admin</option>
        <option value="teacher">Teacher</option>
        <option value="student">Student</option>
    </select><br>
    <button type="submit">S'inscrire</button>
</form>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>