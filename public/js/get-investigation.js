const textArea = document.getElementById('investigation_3');
//const boxLi= document.getElementById('investigationTable').children;
const boxLi = $('#investigationTable tr td');

for(let i = 0; i < boxLi.length; i++){ // Looping To All Children of Box.
  boxLi[i].addEventListener('click', () => {
    textArea.value += boxLi[i].textContent + '\n' // Hey JS, do that when I click on that very Li element which is adding text Content of Li Element in the Text Area Value.
  })
}
