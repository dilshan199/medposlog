const textArea_2 = document.getElementById('note_3');
//const boxLi= document.getElementById('investigationTable').children;
const boxLi_2 = $('#noteTable tr td');

for(let i = 0; i < boxLi_2.length; i++){ // Looping To All Children of Box.
  boxLi_2[i].addEventListener('click', () => {
    textArea_2.value += boxLi_2[i].textContent + '\n' // Hey JS, do that when I click on that very Li element which is adding text Content of Li Element in the Text Area Value.
  })
}
