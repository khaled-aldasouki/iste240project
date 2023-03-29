


//function used to add a question when creating a survey
function addquestion(){
    
    let questions = document.getElementsByClassName("question");
    let n = questions.length + 1;
    let form = document.getElementById('newform');
    form.append(document.createElement('br'));

    //creating label
    const label = document.createElement('label');
    label.setAttribute('id','q'+n);
    label.setAttribute('for','q'+n);
    label.setAttribute('class','question');
    let node1 = document.createTextNode("Question " + n + ":");
    label.appendChild(node1);
    form.append(label);
    form.append(document.createElement('br'));

    //creating question box
    const question = document.createElement('textarea');
    question.setAttribute('name','q'+n);
    question.setAttribute('id','q'+n);
    form.append(question);
    form.append(document.createElement('br'));

    //creating type label
    const typelabel = document.createElement('label');
    typelabel.setAttribute('for','q'+n+'type');
    let node2 = document.createTextNode("Question " + n + " type:");
    typelabel.appendChild(node2);
    form.append(typelabel);
    form.append(document.createElement('br'));

    //creating select
    const select = document.createElement('select');
    select.setAttribute('name','q'+n+'type');
    select.setAttribute('id','q'+n+'type');
    select.setAttribute('onchange','changetype('+n+');');
    form.append(select);
    form.append(document.createElement('br'));
    
    
    const option0 = document.createElement('option');
    option0.setAttribute('value','none');
    option0.setAttribute('hidden','true')
    option0.setAttribute('disabled','true')
    option0.setAttribute('selected','true')
    option0.innerHTML = 'Select an Option';

    const option1 = document.createElement('option');
    option1.setAttribute('value','textarea');
    option1.innerHTML = 'Text Box';
    const option2 = document.createElement('option');
    option2.setAttribute('value','checkbox');
    option2.innerHTML = 'checkbox';
    const option3 = document.createElement('option');
    option3.setAttribute('value','radio');
    option3.innerHTML = 'radio';
        
    select.append(option0,option1,option2,option3);

    form.append(document.createElement('br'));

    //creating div for options
    const div = document.createElement('div');
    div.setAttribute('id','options' + n);
    form.append(div);
}

//function used to chang the type of answer a question uses
function changetype(n){
    let option = document.getElementById('q'+n+'type');
    let div = document.getElementById('options' + n);
    var val= option.value;
    while (div.firstChild) {
        div.removeChild(div.lastChild);
    }
    if (val == "textarea"){
        let node = document.createElement('textarea');
        div.appendChild(node);
    } 
    else{
        
        let node1 = document.createElement('textarea');
        node1.innerHTML = 'option 1';
        let node2 = document.createElement('textarea');
        node2.innerHTML = 'option 2';
        let node3 = document.createElement('textarea');
        node3.innerHTML = 'option 3';
        let node4 = document.createElement('textarea');
        node4.innerHTML = 'option 4';
        div.append(node1,node2,node3,node4);
    }
}   