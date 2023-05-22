const form = document.querySelector(".typing-area"),
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");

    form.onsubmit = (e)=>{
        e.preventDefault();
    }

sendBtn.onclick = () => {
     //ajax code
     let xhr = new XMLHttpRequest(); //creating xml object 
     xhr.open("POST","php/insert-chat.php",true);
     xhr.onload = ()=>{
         if(xhr.readyState === XMLHttpRequest.DONE){
             if(xhr.status === 200){
               inputField.value = "";
               scrollToBottom();
             }
         }
     }
     //send form data trought ajax to php
     let formData = new FormData(form); //creating new formData object
     xhr.send(formData); //send form data to php

}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}
setInterval(() => {
    //ajax code
    let xhr = new XMLHttpRequest(); //creating xml object 
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){ //if active class not contains in chat box the scroll to bottom
                    scrollToBottom();
                }
                

            }
        }
    }
     //send form data trought ajax to php
     let formData = new FormData(form); //creating new formData object
     xhr.send(formData); //send form data to php
 

}, 500); //this function will run frequently after 500ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}