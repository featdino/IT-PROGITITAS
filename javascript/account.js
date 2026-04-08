document.addEventListener("DOMContentLoaded", () => { 
    const container = document.querySelector('.details-container');

    function initPassToggle() 
    {
        const togglePassBtn = document.getElementById("toggle-password");
        const passwordField = document.getElementById("password");
        const icon = togglePassBtn.querySelector("i");
        
        togglePassBtn.onclick = function()
        {
            if (passwordField.type === 'password')
            {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } 
            else 
            {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    }

    const loginHTML = `
        <div class = "login">
            <h3>Welcome back</h3>
            <p>Please enter your details</p>
            <form class = "login-form">
                <input type = "text" name = "username" placeholder = "Username"  autocomplete = "off"><br>
                <input type = "password" name = "password" id = "password" placeholder = "Password">
                <span id = "toggle-password" class = "toggle-icon">
                    <i class = "fas fa-eye-slash" id = "toggle-password-icon"></i>
                </span><br>
                <input type = "submit" class = "submit-btn" name = "submit" value = "Log In">
            </form>
            <p class = "ask">Don't have an account yet?</p>
            <button id = "to-register" class = "change-button">Sign Up</button>
        </div>
    `;

    const registerHTML = `
        <div class = "register">
            <h3>Register an account</h3>
            <p>Please enter your details</p>
            <form class = "register-form" autocomplete = "off">
                <input type = "text" name = "name" placeholder = "Enter name"><br>
                <input type = "text" name = "email" placeholder = "Enter email address"><br>
                <input type = "text" name = "username" placeholder = "Create username"  autocomplete = "off"><br>
                <input type = "password" name = "password" id = "password" placeholder = "Create password">
                <span id = "toggle-password" class = "toggle-icon">
                    <i class = "fas fa-eye-slash" id = "toggle-password-icon"></i>
                </span><br>
                <input type = "submit" class = "submit-btn" name = "submit" value = "Create account">
            </form>
            <p class = "ask">Already have an account?</p>
            <button id = "to-login" class = "change-button">Log In</button>
        </div>
    `;

    initPassToggle();

    container.addEventListener('click', (e) => {
        if (e.target.id === 'to-register') 
        {
            container.innerHTML = registerHTML;
            initPassToggle();
        } 
        else if (e.target.id === 'to-login') 
        {
            container.innerHTML = loginHTML;
            initPassToggle();
        }
    });
    
});
