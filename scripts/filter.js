const dropdownList = document.getElementById('filter');

dropdownList.addEventListener('change', handleDropdownChange);

function handleDropdownChange(event) {
  const selectedValue = event.target.value;
  setPlaceHolder(selectedValue)
  console.log(selectedValue)
}


  function setPlaceHolder(ph){
    let inp = document.querySelector('.search-container');
    let field= document.getElementById('search');
    let val = "";
    if(ph!="difficulty")
      val = field.value;
    let bttn = document.getElementById('search-btn');
    inp.removeChild(field);
    inp.removeChild(bttn);
    if(ph!="difficulty"){
    
    const placeholders = {
        "ingredient" : "Eggs, Meat, Rice, etc.",
        "name":"Kitfo, Beef Burger etc.",
        "cusine":"Ethiopian, Italian, Jamaican etc.",
        "author":"Eg: Tigabu Desalgn, John Doe",
        "prep_time":"in minutes"
      };

    
    let textfield = document.createElement('input');
    textfield.setAttribute('type', 'text');
    textfield.setAttribute('id', 'search');
    textfield.setAttribute('name', 'input');
    if(val)
      textfield.value = val
    textfield.placeholder  = placeholders[ph];
    
    inp.appendChild(textfield);

    }
    else{
        let dropdown = document.createElement('select');
        dropdown.setAttribute('id', 'search');
        dropdown.setAttribute('class', 'filter');
        dropdown.setAttribute('style', "border:None; min-width:93%;");
        dropdown.setAttribute('name', 'input');
        easy_option = document.createElement('option');
        easy_option.setAttribute('value', 'Easy');
        easy_option.text = "Easy";

        med_option = document.createElement('option');
        med_option.setAttribute('value', 'Medium');
        med_option.text = "Medium"

        hard_option = document.createElement('option');
        hard_option.setAttribute('value', 'Hard');
        hard_option.text = "Hard"

        dropdown.appendChild(easy_option);
        dropdown.appendChild(med_option);
        dropdown.appendChild(hard_option);
        inp.appendChild(dropdown)
    }
    
    let btn = document.createElement('button');
    btn.setAttribute('type', 'submit');
    btn.setAttribute('class', "search-container button");
    btn.setAttribute('id', 'search-btn')
    // btn.addEventListener('click', callback_search);
    inp.appendChild(btn);
    

  }
