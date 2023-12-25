const textArea9 = document.getElementById('letter_type');
//const boxLi= document.getElementById('investigationTable').children;
const boxLi9 = $('#typeTable tr td');

for(let i = 0; i < boxLi9.length; i++){ // Looping To All Children of Box.
  boxLi9[i].addEventListener('click', () => {
    textArea9.value += boxLi9[i].textContent + '\n' // Hey JS, do that when I click on that very Li element which is adding text Content of Li Element in the Text Area Value.
  })
}

