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

    // for options in city input select, paconvert nalang into retrieval from db para pag nag-add/delete city
    const registerHTML = `
        <div class = "register">
            <h3>Register an account</h3>
            <p>Please enter your details</p>
            <form class = "register-form" autocomplete = "off">
                <input type = "text" name = "name" placeholder = "Enter name" required><br>
                <input type = "text" name = "email" placeholder = "Enter email address" required><br>

                <select name = "city" required>

                    <option value = "" disabled selected hidden>Select city</option>

                    <option value = "Manila">Manila</option>
                    <option value = "Angeles City">Angeles City</option>
                    <option value = "Antipolo">Antipolo</option>
                    <option value = "Bacolod">Bacolod</option>
                    <option value = "Baguio">Baguio</option>
                    <option value = "Batangas City">Batangas City</option>
                    <option value = "Biñan">Biñan</option>
                    <option value = "Butuan">Butuan</option>
                    <option value = "Cabuyao">Cabuyao</option>
                    <option value = "Cagayan de Oro">Cagayan de Oro</option>
                    <option value = "Cainta">Cainta</option>
                    <option value = "Calamba">Calamba</option>
                    <option value = "Calapan">Calapan</option>
                    <option value = "Cebu City">Cebu City</option>
                    <option value = "Clark Freeport Zone">Clark Freeport Zone</option>
                    <option value = "Cotabato City">Cotabato City</option>
                    <option value = "Daet">Daet</option>
                    <option value = "Davao City">Davao City</option>
                    <option value = "Dumaguete">Dumaguete</option>
                    <option value = "General Santos">General Santos</option>
                    <option value = "Iloilo City">Iloilo City</option>
                    <option value = "Kalibo">Kalibo</option>
                    <option value = "Laoag">Laoag</option>
                    <option value = "Lapu-Lapu City">Lapu-Lapu City</option>
                    <option value = "Legazpi">Legazpi</option>
                    <option value = "Lipa">Lipa</option>
                    <option value = "Lucena">Lucena</option>
                    <option value = "Makati">Makati</option>
                    <option value = "Mandaluyong">Mandaluyong</option>
                    <option value = "Mandaue">Mandaue</option>
                    <option value = "Marawi">Marawi</option>
                    <option value = "Marikina">Marikina</option>
                    <option value = "Muntinlupa">Muntinlupa</option>
                    <option value = "Naga">Naga</option>
                    <option value = "Olongapo">Olongapo</option>
                    <option value = "Ormoc">Ormoc</option>
                    <option value = "Pagadian">Pagadian</option>
                    <option value = "Parañaque">Parañaque</option>
                    <option value = "Pasay">Pasay</option>
                    <option value = "Pasig">Pasig</option>
                    <option value = "Puerto Princesa">Puerto Princesa</option>
                    <option value = "Roxas City">Roxas City</option>
                    <option value = "San Fernando">San Fernando</option>
                    <option value = "San Jose">San Jose</option>
                    <option value = "San Pablo">San Pablo</option>
                    <option value = "Santa Rosa">Santa Rosa</option>
                    <option value = "Surigao City">Surigao City</option>
                    <option value = "Tacloban">Tacloban</option>
                    <option value = "Tagbilaran">Tagbilaran</option>
                    <option value = "Taguig">Taguig</option>
                    <option value = "Tagum">Tagum</option>
                    <option value = "Tarlac City">Tarlac City</option>
                    <option value = "Quezon City">Quezon City</option>
                    <option value = "Vigan">Vigan</option>
                    <option value = "Zamboanga City">Zamboanga City</option>
                    <option value = "Outside Philippines">Outside Philippines</option>

                </select><br>

                <input type = "text" name = "username" placeholder = "Create username"  autocomplete = "off" required><br>
                <input type = "password" name = "password" id = "password" placeholder = "Create password" required>
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
