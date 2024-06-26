<div class="container">
    <h2>Inscription</h2>
    <p class="msg-error"></p>
    <form id="registerForm" action="" method="POST">
        <div class="form-group">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Adresse e-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirmer le mot de passe:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit">S'inscrire</button>
    </form>
</div>

<script>
    const form = document.getElementById('registerForm');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        fetch('/controllers/registerCtrl.php', {
            method: "POST",
            body: new FormData(form)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                const errorMessageElement = document.getElementsByClassName('msg-error')[0];
                errorMessageElement.textContent = data.message;
            }
        })
    })
</script>