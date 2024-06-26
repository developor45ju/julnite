<div class="container">
    <h2>Connexion</h2>
    <p class="msg-error"></p>
    <form id="login-form" action="" method="post">
        <div class="form-group">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</div>

<script>
    const form = document.getElementById('login-form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        fetch('/controllers/loginCtrl.php', {
            method: "POST",
            body: new FormData(form)
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    const errorMsg = document.getElementsByClassName('msg-error')[0];
                    errorMsg.textContent = data.message;
                }
            })
    })
</script>