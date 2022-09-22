const contain = document.querySelector(".contain"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");

    //   Show hide password
    pwShowHide.forEach(eyeIcon => {
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField => {
                if(pwField.type === "password") {
                    pwField.type = "text";

                    pwShowHide.forEach(icon => {
                        icon.classList.replace("uil-eye-slash", "uil-eye")
                    })
                } else {
                    pwField.type = "password";

                    pwShowHide.forEach(icon => {
                        icon.classList.replace("uil-eye", "uil-eye-slash")
                    })
                }
            })
        })
    })
    signUp.addEventListener('click', () => {
        contain.classList.add('active');
    })
    login.addEventListener('click', () => {
        contain.classList.remove('active');
    })