const textArea_3 = document.getElementById('clinic_followup_3');
//const boxLi= document.getElementById('investigationTable').children;
const boxLi_3 = $('#clinicTable tr td');

for(let i = 0; i < boxLi_3.length; i++){ // Looping To All Children of Box.
  boxLi_3[i].addEventListener('click', () => {
    textArea_3.value += boxLi_3[i].textContent + '\n' // Hey JS, do that when I click on that very Li element which is adding text Content of Li Element in the Text Area Value.
  })
}
