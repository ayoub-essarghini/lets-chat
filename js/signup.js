const form = document.querySelector(".signup form"),
continuBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continuBtn.onclick = ()=>{
        //ajax code
        let xhr = new XMLHttpRequest(); //creating xml object 
        xhr.open("POST","php/signup.php",true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if(data == "success"){
                           location.href = "users.php";
                    }else{
                        errorText.textContent = data;
                        errorText.style.display = "block";
               
                      
                    }
                }
            }
        }
        //send form data trought ajax to php
        let formData = new FormData(form); //creating new formData object
        xhr.send(formData); //send form data to php
}
