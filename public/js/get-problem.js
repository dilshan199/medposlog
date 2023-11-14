const textArea_1 = document.getElementById('problem_3');
//const boxLi= document.getElementById('investigationTable').children;
const boxLi_1 = $('#problemTable tr td');

for(let i = 0; i < boxLi_1.length; i++){ // Looping To All Children of Box.
  boxLi_1[i].addEventListener('click', () => {
    textArea_1.value += boxLi_1[i].textContent + '\n' // Hey JS, do that when I click on that very Li element which is adding text Content of Li Element in the Text Area Value.
  })
}
