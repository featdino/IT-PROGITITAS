// password toggle functionality for register and login pages
document.addEventListener("DOMContentLoaded", () => { 
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

    initPassToggle();
});
