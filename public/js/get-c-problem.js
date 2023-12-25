const c_textArea = document.getElementById('problem_4');
//const boxLi= document.getElementById('investigationTable').children;
const boxLi_8 = $('#CproblemTable tr td');

for(let i = 0; i < boxLi_8.length; i++){ // Looping To All Children of Box.
  boxLi_8[i].addEventListener('click', () => {
    c_textArea.value += boxLi_8[i].textContent + '\n' // Hey JS, do that when I click on that very Li element which is adding text Content of Li Element in the Text Area Value.
  })
}
