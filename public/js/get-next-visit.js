const textArea_6 = document.getElementById('next_day_investigation');
//const boxLi= document.getElementById('investigationTable').children;
const boxLi_6 = $('#NinvestigationTable tr td');

for(let i = 0; i < boxLi_6.length; i++){ // Looping To All Children of Box.
  boxLi_6[i].addEventListener('click', () => {
    textArea_6.value += boxLi_6[i].textContent + '\n' // Hey JS, do that when I click on that very Li element which is adding text Content of Li Element in the Text Area Value.
  })
}
