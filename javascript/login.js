window.onload = function() {
    var signup = document.getElementById("signup");
    var login = document.getElementById("login");
    var signuptab = document.getElementById("signuptab");
    var logintab = document.getElementById("logintab");
    var password_input = document.getElementById("password_input");
    var togglePassword = document.getElementById("togglePassword");
  
    signuptab.onclick = function() {
        signup.style.display = "block";
        login.style.display = "none";
        logintab.classList.remove("active");
        signuptab.classList.add("active");
    };
  
    logintab.onclick = function() {
      login.style.display = "block";
      signup.style.display = "none";
      signuptab.classList.remove("active");
      logintab.classList.add("active");
    };

    togglePassword.onclick = function() {
      // toggle the type attribute
      const type = password_input.getAttribute('type') === 'password' ? 'text' : 'password';
      password_input.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
      }
  };  

  