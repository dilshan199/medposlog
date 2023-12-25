const textArea12 = document.getElementById('illness');
//const boxLi= document.getElementById('investigationTable').children;
const boxLi12 = $('#illnessTable tr td');

for(let i = 0; i < boxLi12.length; i++){ // Looping To All Children of Box.
  boxLi12[i].addEventListener('click', () => {
    textArea12.value += boxLi12[i].textContent  // Hey JS, do that when I click on that very Li element which is adding text Content of Li Element in the Text Area Value.
  })
}

