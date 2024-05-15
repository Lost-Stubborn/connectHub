const form=document.querySelector('form')
const file=document.querySelector('.input')
form.addEventListener('submit',function(e){
   e.preventDefault();
   console.log(file.value)
})